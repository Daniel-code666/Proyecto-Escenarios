<?php
namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;
use App\Models\Understage;
use \koolreport\processes\Group;

class StageReport extends \koolreport\KoolReport
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
                    "connectionString"=>"mysql:host=localhost;dbname=idrdsystem",
                    "username"=>"root",
                    "password"=>"1234",
                    "charset"=>"utf8"
                )
            )
        );
    }

    function setup(){
        $this->src("mysql")->query(
            Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'stages.id_category')
                ->join('localities', 'localities.localityId', '=', 'stages.localityid')
                ->join('neighborhoods', 'neighborhoods.hoodId', '=', 'stages.neighborhoodid')
                ->where('stages.id', $this->params["id"])
                ->where('misc_list_states.tableParent', '=','stages')->limit(1)
        )
        ->pipe($this->dataStore("stageDef"));

        $this->src("mysql")->query(
            Understage::select('idUnderstage', 'name_understg', 'area_understg', 
            'address_understg', 'capacity_understg', 'statesName', 'discipline_name')
                ->join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'understages.id_category_understg')
                ->where('understages.idStage', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=','stages')
        )
        ->pipe($this->dataStore("subStage"));

        $this->src("mysql")->query(
            Resources::select('resourceName as Nombre del objeto', 'amount as Cantidad en almacén', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('stages.id', '=', $this->params["id"])
                ->where('misc_list_states.tableParent', '=', 'inventary')
                ->where('warehouses.locationCheck', '=', 1)
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

        $this->src("mysql")->query(
            Understage::select('resourceName as Nombre del objeto', 'amount as Cantidad en almacén', 'statesName as Estado', 'warehouseName as Almacén')
                ->join('warehouses', 'warehouses.warehouseLocation', '=', 'understages.idUnderstage')
                ->join('resources', 'resources.resources_warehouseId', '=', 'warehouses.warehouseId')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'understages.id_category_understg')
                ->where('understages.idStage', '=', $this->params["id"])
                ->where('warehouses.locationCheck', '=', 0)
        )
        ->pipe($this->dataStore("subResources"));

        $this->src("mysql2")->query(
            "select statesName, amount from idrdsystem.resources
            join idrdsystem.misc_list_states
            on idrdsystem.resources.id_category = idrdsystem.misc_list_states.statesId
            join idrdsystem.warehouses
            on idrdsystem.warehouses.warehouseId = idrdsystem.resources.resources_warehouseId
            where idrdsystem.misc_list_states.tableParent = 'inventary' and idrdsystem.warehouses.warehouseLocation =:id"
        )->params(array(
            ":id"=>$this->params["id"]
        ))->pipe(new Group(array(
            "sum"=>"amount",
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