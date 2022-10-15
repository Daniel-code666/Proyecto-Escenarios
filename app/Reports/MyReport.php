<?php
namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;
use \koolreport\processes\Group;

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;

    use \koolreport\clients\Bootstrap;

    function settings()
    {
        return array(
            "dataSources"=>array(
                "mysql"=>array(
                    "class"=>'\koolreport\laravel\Eloquent', // This is important
                ),
                "mysql2"=>array(
                    "connectionString" => "mysql:host=idrdsystem.cjyd7vrf96n5.us-east-1.rds.amazonaws.com;dbname=idrdsystem",
                    "username" => "root",
                    "password" => "1234idrd",
                    "charset" => "utf8"
                )
            )
        );
    }

    function setup(){
        $this->src("mysql")->query(
            Stage::where('stages.id', $this->params["id"])->limit(1)
        )
        ->pipe($this->dataStore("stageDef"));

        $this->src("mysql")->query(
            Resources::select('resourceName as Nombre del objeto', 'amount as Cantidad en almacén', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('stages.id', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
        )
        ->pipe($this->dataStore("resources"));

        $this->src("mysql")->query(
            Resources::select('resourceName as Nombre del objeto', 'amountInUse as Cantidad en uso', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('stages.id', '=', $this->params["id"])
                ->where('amountInUse', '>', 0)
                ->where('misc_list_states.tableParent', '=', 'inventary')
        )->pipe($this->dataStore("resourcesInUse"));

        $this->src("mysql2")->query(
            "select statesName, idResource from idrdsystem.resources
            join idrdsystem.misc_list_states
            on idrdsystem.resources.id_category = idrdsystem.misc_list_states.statesId
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation =:id"
        )->params(array(
            ":id"=>$this->params["id"]
        ))->pipe(new Group(array(
            "count"=>"idResource",
            "by"=>"statesName"
        )))->pipe($this->dataStore("resourcesStates"));

        $this->src("mysql2")->query(
            "select warehouseName, amount, warehouseId from idrdsystem.resources
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.warehouses.warehouseLocation =:id and idrdsystem.warehouses.locationCheck = 1"
        )->params(array(
            ":id"=>$this->params["id"]
        ))->pipe(new Group(array(
            "sum"=>"amount",
            "by"=>"warehouseId"
        )))->pipe($this->dataStore("resourceWarehouse"));

        $this->src("mysql2")->query(
            "select warehouseName, resourceName, amount from idrdsystem.resources
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.warehouses.warehouseLocation =:id and idrdsystem.warehouses.locationCheck = 1"
        )->params(array(
            ":id"=>$this->params["id"]
        ))->pipe($this->dataStore("rWTable"));
    }
}