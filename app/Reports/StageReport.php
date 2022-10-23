<?php

namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;
use App\Models\Understage;
use koolreport\processes\AggregatedColumn;
use \koolreport\processes\Group;

class StageReport extends \koolreport\KoolReport
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
            Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'stages.id_category')
                ->join('localities', 'localities.localityId', '=', 'stages.localityid')
                ->join('neighborhoods', 'neighborhoods.hoodId', '=', 'stages.neighborhoodid')
                ->where('stages.id', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'stages')->limit(1)
        )->pipe($this->dataStore("stageDef"));

        // query recursos por estado escenario principal
        $this->src("mysql2")->query(
            "select statesName, amount from idrdsystem.resources
            join idrdsystem.misc_list_states
            on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation =:id and idrdsystem.warehouses.locationCheck = 1"
        )->params(array(
            ":id" => $this->params["id"]
        ))->pipe(new Group(array(
            "by" => "statesName",
            "sum" => "amount"
        )))->pipe($this->dataStore("resourcesStates"));

        $this->src("mysql2")->query(
            "select statesName, amountInUse from idrdsystem.resources
            join idrdsystem.misc_list_states
            on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation =:id and idrdsystem.warehouses.locationCheck = 1"
        )->params(array(
            ":id" => $this->params["id"]
        ))->pipe(new Group(array(
            "by" => "statesName",
            "sum" => "amountInUse"
        )))->pipe($this->dataStore("resourcesStates2"));

        // query info recursos escenario principal
        $this->src("mysql")->query(
            Resources::select('resourceName as Nombre del objeto', 'amount as Cantidad en almacén', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('stages.id', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('warehouses.locationCheck', '=', 1)
        )->pipe($this->dataStore("resources"));

        // query info recursos con mensaje del estado, escenario principal
        $this->src("mysql")->query(
            Resources::select('resourceName as Nombre del objeto', 'amount as Cantidad en almacén', 'statesName as Estado', 'resourceMsgState as Condición', 'warehouseName as Almacén')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('stages.id', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('warehouses.locationCheck', '=', 1)
        )->pipe($this->dataStore("resourcesStateMsg"));

        // query info recursos en uso escenario principal
        $this->src("mysql")->query(
            Resources::select('resourceName as Nombre del objeto', 'amountInUse as Cantidad en uso', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('stages.id', '=', $this->params["id"])
                ->where('amountInUse', '>', 0)
                ->where('misc_list_states.tableParent', '=', 'inventary')
        )->pipe($this->dataStore("resourcesInUse"));

        // recursos por almacén en el escenario principal
        $this->src("mysql2")->query(
            "select warehouseName, amount, warehouseId from idrdsystem.resources
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.warehouses.warehouseLocation =:id and idrdsystem.warehouses.locationCheck = 1"
        )->params(array(
            ":id" => $this->params["id"]
        ))->pipe(new Group(array(
            "sum" => "amount",
            "by" => "warehouseId"
        )))->pipe($this->dataStore("resourceWarehouse"));

        $this->src("mysql2")->query(
            "select warehouseName, resourceName, amount from idrdsystem.resources
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.warehouses.warehouseLocation =:id and idrdsystem.warehouses.locationCheck = 1"
        )->params(array(
            ":id" => $this->params["id"]
        ))->pipe($this->dataStore("rWTable"));

        // query info recursos subescenarios
        $this->src("mysql")->query(
            Resources::select(
                'resourceName as Nombre del objeto',
                'amount as Cantidad en almacén',
                'statesName as Estado',
                'warehouseName as Almacén',
                'name_understg as Sub escenario'
            )
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('understages', 'understages.idUnderstage', '=', 'warehouses.warehouseLocation')
                ->where('understages.idStage', '=', $this->params["id"])
                ->where('warehouses.locationCheck', '=', 0)
                ->where('misc_list_states.tableParent', '=', 'inventary')
        )->pipe($this->dataStore("subResources"));

        // query info recursos en uso subescenarios
        $this->src("mysql")->query(
            Resources::select(
                'resourceName as Nombre del objeto',
                'amountInUse as Cantidad en uso',
                'statesName as Estado',
                'warehouseName as Almacén'
            )
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('understages', 'understages.idUnderstage', '=', 'warehouses.warehouseLocation')
                ->where('understages.idStage', '=', $this->params["id"])
                ->where('warehouses.locationCheck', '=', 0)
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('amountInUse', '>', 0)
        )->pipe($this->dataStore("subResourcesInUse"));

        // query info sub escenario con almacenes
        $this->src("mysql")->query(
            Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'understages.id_category_understg')
                ->join('warehouses', 'warehouses.warehouseLocation', '=', 'understages.idUnderstage')
                ->where('understages.idStage', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'stages')
                ->where('warehouses.locationCheck', '=', 0)
        )->pipe($this->dataStore("subStage"));

        // query recursos por estado sub escenarios
        $subStages = $this->params["subStages"];
        foreach($subStages as $subStage){
            $this->src("mysql2")->query(
                "select statesName, amount, warehouseName from idrdsystem.resources
                join idrdsystem.misc_list_states
                on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
                join idrdsystem.warehouses
                on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
                where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation = 
                ". $subStage['idUnderstage'] . " and idrdsystem.warehouses.locationCheck = 0;"
            )->pipe(new Group(array(
                "by" => "statesName",
                "sum" => "amount"
            )))->pipe($this->dataStore("subResourcesStates"));
        }

        foreach($subStages as $subStage){
            $this->src("mysql2")->query(
                "select statesName, amountInUse, warehouseName from idrdsystem.resources
                join idrdsystem.misc_list_states
                on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
                join idrdsystem.warehouses
                on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
                where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation = 
                ". $subStage['idUnderstage'] . " and idrdsystem.warehouses.locationCheck = 0;"
            )->pipe(new Group(array(
                "by" => "statesName",
                "sum" => "amountInUse"
            )))->pipe($this->dataStore("subResourcesStates2"));
        }

        // query info sub escenario SIN almacenes
        $this->src("mysql")->query(
            Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'understages.id_category_understg')
                ->where('understages.idStage', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'stages')
        )->pipe($this->dataStore("subStageSimple"));

        // query info total de recursos por estado en sub escenarios
        $this->src("mysql2")->query(
            "select statesName, amount from idrdsystem.resources
            join idrdsystem.misc_list_states
            on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.misc_list_states.tableParent = 'inventary' 
            and idrdsystem.warehouses.locationCheck = 0"
        )->pipe(new Group(array(
            "by" => "statesName",
            "sum" => "amount"
        )))->pipe($this->dataStore("subResourceStatesTot"));

        $this->src("mysql2")->query(
            "select statesName, amountInUse from idrdsystem.resources
            join idrdsystem.misc_list_states
            on idrdsystem.misc_list_states.statesId = idrdsystem.resources.id_category
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.misc_list_states.tableParent = 'inventary' 
            and idrdsystem.warehouses.locationCheck = 0"
        )->pipe(new Group(array(
            "by" => "statesName",
            "sum" => "amountInUse"
        )))->pipe($this->dataStore("subResourceInUseStatesTot"));

        // query cantidad de recursos por almacén
        foreach ($subStages as $subStage){
            $this->src("mysql2")->query(
                "select warehouseName, amount, warehouseId from idrdsystem.resources
                join idrdsystem.warehouses
                on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
                where idrdsystem.warehouses.warehouseLocation =". $subStage['idUnderstage'] ." and idrdsystem.warehouses.locationCheck = 0"
            )->params(array(
                ":id" => $this->params["id"]
            ))->pipe(new Group(array(
                "sum" => "amount",
                "by" => "warehouseId"
            )))->pipe($this->dataStore("subResourceWarehouse"));
        }
    }
}
