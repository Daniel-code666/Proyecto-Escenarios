<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/fonts/Roboto.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<?php

use koolreport\widgets\google\BarChart;
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\PieChart;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\koolphp\Card;

use function PHPUnit\Framework\isEmpty;

?>
<html>

<body>
    <div class="container">
        <?php
        foreach ($this->dataStore("stageDef") as $data) {
            echo ("<title>" . (string) $data['name'] . "</title>");
            echo ("<h1 style='text-align:center'>Informe del inventario del escenario " . (string) $data['name'] . "</h1>");
        }
        ?>
    </div>

    <br>

    <div class="warpper">
        <div class="panels">
            <?php
            $cont = 0;
            foreach ($this->dataStore("warehouses") as $checkArr) {
                if ($checkArr != null) {
                    $cont++;
                }
            }

            if ($cont == 0) {
                echo ("<h4 style='text-align: center'>Este escenario no tiene almacenes</h4>");
            } else {
                $resources = array();
                $resourcesTable = array();
                $resourcesInUse = array();
                $resourcesInUseTable = array();
                $resourcesByStates = array();
                $total = 0;
                $totalInUse = 0;

                foreach ($this->dataStore("warehouses") as $data1) {
                    // sección de recursos en almacén
                    // datos para el gráfico de torta
                    foreach ($this->dataStore("resourcesByWarehouse") as $data2) {
                        if ($data1['warehouseName'] == $data2['warehouseName']) {
                            array_push($resources, $data2);
                        }
                    }

                    // datos para la tabla
                    foreach ($this->dataStore("resourcesByWhTable") as $r) {
                        if ($data1["warehouseName"] == $r['Almacén']) {
                            array_push($resourcesTable, $r);
                        }
                    }

                    // suma la cantidad de cada recurso por almacén
                    foreach ($this->dataStore("resourcesByWarehouse") as $temp) {
                        if ($data1['warehouseName'] == $temp['warehouseName']) {
                            $total += (int) $temp['amount'];
                        }
                    }

                    // suma la cantidad de cada recurso en USO por almacén
                    foreach ($this->dataStore("resourcesInUseByWarehouse") as $temp){
                        if ($data1['warehouseName'] == $temp['warehouseName']) {
                            $totalInUse += (int) $temp['amountInUse'];
                        }
                    }

                    echo ("<h3>Recursos en el almacén <b>" . $data1['warehouseName'] . "</b></h3>");

                    if (count($resources) == 0) {
                        echo ("<h4 style='text-align:center'>No hay recursos en este almacén</h4>");
                    } else {
                        echo ("<div class='row_fixed'><div class='col-4'></div><div class='col-4 card_center'><div class='card' 
                        style='width: 18rem;'><div class='card-body'><h5 class='card-title'>
                        Recursos totales del almacén <b>" . (string) $data1['warehouseName'] .
                            "</b></h5><h6 class='card-subtitle mb-2 text-muted'>Cantidad</h6><p class='card-text'><h1>
                        " . $total . "</h1></p></div></div></div></div>");

                        PieChart::create(array(
                            "dataSource" => $resources
                        ));

                        Table::create(array(
                            "dataStore" => $resourcesTable,
                            "cssClass" => array(
                                "table" => "table table-striped table-bordered"
                            ),
                            "paging" => array(
                                "pageSize" => 10,
                                "pageIndex" => 0
                            )
                        ));
                    }

                    echo ("<h3>Recursos en <b>uso</b> del almacén <b>" . $data1['warehouseName'] . "</b></h3>");

                    if (count($resources) == 0) {
                        echo ("<h4>No hay recursos en USO de este almacén</h4>");
                    } else {
                        echo ("<div class='row_fixed'><div class='col-4'></div><div class='col-4 card_center'><div class='card' 
                        style='width: 18rem;'><div class='card-body'><h5 class='card-title'>
                        Recursos totales en <b>USO</b> del almacén <b>" . (string) $data1['warehouseName'] .
                            "</b></h5><h6 class='card-subtitle mb-2 text-muted'>Cantidad</h6><p class='card-text'><h1>
                        " . $totalInUse . "</h1></p></div></div></div></div>");

                        // sección de recursos EN USO del almacén
                        // datos para el gráfico de torta de recursos EN USO
                        foreach ($this->dataStore("resourcesInUseByWarehouse") as $dataInUse) {
                            if ($data1['warehouseName'] == $dataInUse['warehouseName']) {
                                array_push($resourcesInUse, $dataInUse);
                            }
                        }

                        // datos para la tabla de recursos EN USO
                        foreach ($this->dataStore("resourcesInUseByWhTable") as $rInUse) {
                            if ($data1["warehouseName"] == $rInUse['Almacén']) {
                                array_push($resourcesInUseTable, $rInUse);
                            }
                        }

                        PieChart::create(array(
                            "dataSource" => $resourcesInUse
                        ));

                        Table::create(array(
                            "dataStore" => $resourcesInUseTable,
                            "cssClass" => array(
                                "table" => "table table-striped table-bordered"
                            ),
                            "paging" => array(
                                "pageSize" => 10,
                                "pageIndex" => 0
                            )
                        ));

                        // sección de cantidad de recursos por estado
                        foreach ($this->dataStore('resourcesByState') as $resource1) {
                            foreach ($this->dataStore('resourcesInUseByState') as $resource2) {
                                if (
                                    $resource1['warehouseName'] == $data1['warehouseName'] and
                                    $resource2['warehouseName'] == $data1['warehouseName'] and
                                    $resource1['warehouseName'] == $resource2['warehouseName'] and
                                    $resource1['statesName'] == $resource2['statesName']
                                ) {
                                    $tempArr1 = $resource1;
                                    $tempArr2 = $resource2;
                                    array_pop($tempArr1);
                                    array_pop($tempArr2);
                                    $resByState = array("statesName" => $tempArr1['statesName'], "amount" => $tempArr1['amount'], "amounInUse" => $tempArr2['amountInUse']);
                                    array_push($resourcesByStates, $resByState);
                                }
                            }
                        }

                        BarChart::create(array(
                            "title" => "Cantidad de recursos por estado en el almacén " . (string) $data1['warehouseName'],
                            "dataSource" => $resourcesByStates,
                            "columns" => array(
                                "statesName" => array(
                                    "label" => "Estado"
                                ),
                                "amount" => array(
                                    "label" => "Cantidad en almacén",
                                    "type" => "number"
                                ),
                                "amounInUse" => array(
                                    "label" => "Cantidad en uso",
                                    "type" => "number"
                                )
                            )
                        ));
                    }

                    // reinicio de arreglos para el siguiente ciclo
                    $resources = [];
                    $resourcesTable = [];
                    $resourcesInUse = [];
                    $resourcesInUseTable = [];
                    $resourcesByStates = [];
                    $total = 0;
                    $totalInUse = 0;
                }
            }
            ?>
        </div>
    </div>

    <br>

    <footer>
        <div class="align-items-center justify-content-xl-between row_fixed">
            <div class="col-6">
                <div style="padding-left: 5%">
                    &copy; <?php echo (date("Y")); ?> <a href="https://www.idrd.gov.co" class="font-weight-bold ml-1" target="_blank">IDRD</a> &amp;
                    <a href="https://www.ucundinamarca.edu.co" class="font-weight-bold ml-1" target="_blank">Universidad de Cundinamarca</a>
                </div>
            </div>
            <div class="col-6">
                <ul class="nav nav-footer" style="padding-left: 79%">
                    <li class="nav-item">
                        <a href="https://www.idrd.gov.co" class="nav-link" target="_blank">Sobre nosotros</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
<style>
    .row_fixed {
        display: flex;
        margin-right: auto;
        margin-left: auto;
        flex-wrap: wrap;
    }

    .card_center {
        padding-left: 110px;
    }

    .col {
        max-width: 100%;
        flex-basis: 0;
        flex-grow: 1;
    }

    .col-1 {
        max-width: 8.33333%;
        flex: 0 0 8.33333%;
    }

    .col-2 {
        max-width: 16.66667%;
        flex: 0 0 16.66667%;
    }

    .col-3 {
        max-width: 25%;
        flex: 0 0 25%;
    }

    .col-4 {
        max-width: 33.33333%;
        flex: 0 0 33.33333%;
    }

    .col-5 {
        max-width: 41.66667%;
        flex: 0 0 41.66667%;
    }

    .col-6 {
        max-width: 50%;
        flex: 0 0 50%;
    }

    .col-7 {
        max-width: 58.33333%;
        flex: 0 0 58.33333%;
    }

    .col-8 {
        max-width: 66.66667%;
        flex: 0 0 66.66667%;
    }

    .col-9 {
        max-width: 75%;
        flex: 0 0 75%;
    }

    .col-10 {
        max-width: 83.33333%;
        flex: 0 0 83.33333%;
    }

    .col-11 {
        max-width: 91.66667%;
        flex: 0 0 91.66667%;
    }

    .col-12 {
        max-width: 100%;
        flex: 0 0 100%;
    }

    .table-responsive {
        display: block;
        overflow-x: auto;
        width: 100%;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .warpper {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .radio {
        display: none;
    }

    .panel-title {
        font-size: 1.5em;
        font-weight: bold
    }

    .tab {
        cursor: pointer;
        padding: 10px 20px;
        margin: 0px 2px;
        background: #542c86;
        display: inline-block;
        color: #fff;
        border-radius: 3px 3px 0px 0px;
        box-shadow: 0 0.5rem 0.8rem #00000080;
    }

    .panels {
        background: #fffffff6;
        box-shadow: 0 1rem 1rem #00000080;
        min-height: 200px;
        width: 100%;
        max-width: 1250px;
        border-radius: 3px;
        overflow: hidden;
        padding: 20px;
    }

    .panel {
        display: none;
        animation: fadein .8s;
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    #one:checked~.panels #one-panel,
    #two:checked~.panels #two-panel,
    #three:checked~.panels #three-panel,
    #four:checked~.panels #four-panel {
        display: block
    }

    #one:checked~.tabs #one-tab,
    #two:checked~.tabs #two-tab,
    #three:checked~.tabs #three-tab,
    #four:checked~.tabs #four-tab {
        background: #fffffff6;
        color: #542c86;
        border-top: 3px solid #542c86;
    }

    hr {
        overflow: visible;
        box-sizing: content-box;
        height: 0;
    }

    .center {
        text-align: center;
    }
</style>

</html>