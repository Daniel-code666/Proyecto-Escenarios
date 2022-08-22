<?php
use \koolreport\widgets\koolphp\Table;
?>
<html>
    <head>
    <title>Inventario</title>
    </head>
    <body>
        <?php
            $data_query = $this->dataStore("stageDef");  
            foreach($data_query as $data){
                echo "<h1>Reporte sobre el inventario del escenario ".(string) $data['name']."</h1>";
            }
        ?>
        
        <?php
        \koolreport\widgets\google\BarChart::create(array(
            "dataSource"=>$this->dataStore("resources")
        ))
        ?>


        <?php
        Table::create([
            "dataSource"=>$this->dataStore("resources")
        ]);
        ?>
    </body>
</html>