<?php
namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;

class MyReportPDF extends \koolreport\KoolReport
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

        $this->src("mysql")->query(
            Resources::select('resourceName as Nombre del objeto', 'amountInUse as Cantidad en uso')
                ->join('warehouses', 'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
                ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
                ->where('stages.id', '=', $this->params["id"])
                ->where('amountInUse', '>', 0)
        )->pipe($this->dataStore("resourcesInUse"));
    }
}