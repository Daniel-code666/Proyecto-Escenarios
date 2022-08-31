
<?php

use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\google\BarChart;
$tempArray = array();

$tempObj = $this->dataStore("stageResources");

foreach($tempObj as $obj){
    array_pop($obj);
    array_push($tempArray, $obj);
}

ColumnChart::create(array(
    "title"=>"Cantidad de recursos por escenario",
    "dataStore"=>$tempArray,
    "columns"=>array(
        "name"=>array(
            "label"=>"Escenario"
        ),
        "amount"=>array(
            "type"=>"number",
            "label"=>"Cantidad"
        )
    )
));

?>