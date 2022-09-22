<?php

namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;
use App\Models\Understage;
use App\Models\warehouse;
use koolreport\processes\AggregatedColumn;
use \koolreport\processes\Group;

class ResourcesReport extends \koolreport\KoolReport
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
                    "connectionString" => "mysql:host=localhost;dbname=idrdsystem",
                    "username" => "root",
                    "password" => "1234",
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

        // query info recursos para la tabla
        $this->src("mysql")->query(
            Resources::select('idResource as Id','resourceName as Nombre del objeto', 'resourceCode as Código',
                'amount as Cantidad', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->where('warehouses.warehouseLocation', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('warehouses.locationCheck', '=', 1)
                ->orderBy('statesName', 'ASC')
        )->pipe($this->dataStore("resourcesByWhTable"));

        // query cantidad de recursos por estado
        $warehouses = $this->params["warehousesArr"];
        foreach ($warehouses as $warehouse){
            $this->src("mysql2")->query(
                "select statesName, amount, warehouseName from idrdsystem.resources
                join idrdsystem.misc_list_states
                on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
                join idrdsystem.warehouses
                on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
                where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation = 
                ". $this->params["id"] . " and idrdsystem.warehouses.locationCheck = 1 and
                idrdsystem.warehouses.warehouseId = ". $warehouse["warehouseId"] .";"
            )->pipe(new Group(array(
                "by" => "statesName",
                "sum" => "amount"
            )))->pipe($this->dataStore("resourcesByState"));

            $this->src("mysql2")->query(
                "select statesName, amountInUse, warehouseName from idrdsystem.resources
                join idrdsystem.misc_list_states
                on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
                join idrdsystem.warehouses
                on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
                where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation = 
                ". $this->params["id"] . " and idrdsystem.warehouses.locationCheck = 1 and
                idrdsystem.warehouses.warehouseId = ". $warehouse["warehouseId"] .";"
            )->pipe(new Group(array(
                "by" => "statesName",
                "sum" => "amountInUse"
            )))->pipe($this->dataStore("resourcesInUseByState"));
        }

        // query info recursos en USO
        $this->src("mysql")->query(
            Resources::select('resourceName', 'amountInUse', 'statesName', 'warehouseName')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->where('warehouses.warehouseLocation', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('warehouses.locationCheck', '=', 1)
        )->pipe($this->dataStore("resourcesInUseByWarehouse"));

        // query info recursos en USO para la tabla
        $this->src("mysql")->query(
            Resources::select('idResource as Id','resourceName as Nombre del objeto', 'resourceCode as Código',
                'amountInUse as Cantidad', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->where('warehouses.warehouseLocation', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('warehouses.locationCheck', '=', 1)
                ->where('amountInUse', '>', 0)
                ->orderBy('statesName', 'ASC')
        )->pipe($this->dataStore("resourcesInUseByWhTable"));
    }
}