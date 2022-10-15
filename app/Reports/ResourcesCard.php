<?php
namespace App\Reports;

use \koolreport\processes\Group;

class ResourcesCard extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;

    use \koolreport\clients\Bootstrap;

    function settings()
    {
        return array(
            "dataSources"=>array(
                "mysql"=>array(
                    "connectionString" => "mysql:host=idrdsystem.cjyd7vrf96n5.us-east-1.rds.amazonaws.com;dbname=idrdsystem",
                    "username" => "root",
                    "password" => "1234idrd",
                    "charset" => "utf8"
                )
            )
        );
    }

    function setup(){
        $this->src('mysql')->query("
            select name, amount, warehouseLocation from idrdsystem.resources
            join idrdsystem.warehouses
            on idrdsystem.resources.resources_warehouseId = idrdsystem.warehouses.warehouseId
            join idrdsystem.stages
            on idrdsystem.stages.id = idrdsystem.warehouses.warehouseLocation
            where idrdsystem.warehouses.locationCheck = 1;
        ")->pipe(new Group(array(
            "by"=>"warehouseLocation",
            "sum"=>"amount"
        )))->pipe($this->dataStore("stageResources"));
    }
}