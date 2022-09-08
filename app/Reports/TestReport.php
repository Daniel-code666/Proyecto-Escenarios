<?php
namespace App\Reports;

use App\Models\Stage;
use App\Models\Resources;
use App\Models\Understage;
use \koolreport\processes\Group;

class TestReport extends \koolreport\KoolReport
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
        // query info escenario principal
        
    }
}