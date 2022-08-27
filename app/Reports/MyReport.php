<?php
namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;

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
            Resources::select('resourceName as Nombre del objeto', 'amount as Cantidad en almacén')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->where('stages.id', '=', $this->params["id"])
        )
        ->pipe($this->dataStore("resources"));
    }

    // function setup()
    // {
    //     // Let say, you have "sale_database" is defined in Laravel's database settings.
    //     // Now you can use that database without any futher setitngs.
    //     $this->src("mysql")
    //     ->query("SELECT resourceName as 'Nombre', amount as 'Cantidad en almacén' FROM idrdsystem.stages JOIN idrdsystem.warehouses ON idrdsystem.stages.id = idrdsystem.warehouses.warehouseLocation JOIN idrdsystem.resources ON idrdsystem.resources.resources_warehouseId = idrdsystem.warehouses.warehouseId WHERE idrdsystem.stages.id =:id")
    //     ->params(array(":id"=>$this->params["id"]))
    //     ->pipe($this->dataStore("stages"));        
    // }
}