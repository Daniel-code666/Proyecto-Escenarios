<?php

namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;
use App\Models\Understage;
use App\Models\warehouse;
use koolreport\processes\AggregatedColumn;
use \koolreport\processes\Group;

class ResupplyReport extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;

    use \koolreport\clients\Bootstrap;

    function settings()
    {
        return array(
            "dataSources" => array(
                "mysql" => array(
                    "class" => '\koolreport\laravel\Eloquent', // This is important
                ),
                "mysql2" => array(
                    "connectionString" => "mysql:host=idrdsystem.cjyd7vrf96n5.us-east-1.rds.amazonaws.com;dbname=idrdsystem",
                    "username" => "root",
                    "password" => "1234idrd",
                    "charset" => "utf8"
                )
            )
        );
    }

    function setup()
    {
        // query info escenario principal
        $this->src("mysql")->query(
            Stage::where('stages.id', $this->params["id"])->limit(1)
        )->pipe($this->dataStore("stageDef"));

        // query info sobre los reabastecimientos
        $this->src("mysql")->query(
            Resources::join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('resupply_records', 'resupply_records.idResourceFk', '=', 'resources.idResource')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->where('locationCheck', 1)
                ->where('tableParent', 'inventary')
        )->pipe($this->dataStore("resupplyData"));

        // query info reabastecimientos para gráfica
        $this->src("mysql")->query(
            Resources::select('idResource as Id', 'resourceName as Nom. obj', 'resourceCode as Cód',
                'amount as Qty alm', 'amountInUse as Qty USO', 'warehouseName as Alm', 'statesName as Estado',
                'resupplyAmount as Qty re-ingreso', 'resupply_records.updated_at as Ult. re-ingreso')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('resupply_records', 'resupply_records.idResourceFk', '=', 'resources.idResource')
                ->where('locationCheck', 1)
                ->where('tableParent', 'inventary')
        )->pipe($this->dataStore("resupplyDataGraph"));

        // query almacenes del escenario
        $this->src("mysql")->query(
            warehouse::where('warehouses.warehouseLocation', $this->params["id"])
        )->pipe($this->dataStore("warehouses"));

        // query info recursos
        $this->src("mysql")->query(
            Resources::select('resourceName', 'amount', 'statesName', 'warehouseName')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->where('warehouses.warehouseLocation', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('warehouses.locationCheck', '=', 1)
        )->pipe($this->dataStore("resourcesByWarehouse"));
    }
}