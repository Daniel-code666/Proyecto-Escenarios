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
    <title>Escenario</title>
</head>
<?php

use koolreport\widgets\google\BarChart;
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\PieChart;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\koolphp\Card;
?>
<html>

<body>
    <div class="container">
        <?php
        $data_query = $this->dataStore("stageDef");
        foreach ($data_query as $data) {
            echo "<h1 style='text-align:center'>Informe del escenario " . (string) $data['name'] . "</h1>";
        }
        ?>
    </div>

    <br>

    <div class="warpper">
        <div class="panels">
            <h2>Escenario principal</h2>
            <div class="row_fixed">
                <div class="table-responsive">
                    <table class="table align-items-center" id="stageTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Localidad</th>
                                <th>Barrio</th>
                                <th>Estado</th>
                                <th>Disciplina</th>
                                <th>Área</th>
                                <th>Capacidad</th>
                                <th>Cant. de subescenarios</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            foreach ($this->dataStore("stageDef") as $stageInfo) {
                                echo ("<tr><td>" . (string) $stageInfo['id'] . "</td>
                    <td>" . (string) $stageInfo['name'] . "</td>
                    <td>" . (string) $stageInfo['address'] . "</td>
                    <td>" . (string) $stageInfo['localityName'] . "</td>
                    <td>" . (string) $stageInfo['hoodName'] . "</td>
                    <td>" . (string) $stageInfo['statesName'] . "</td>
                    <td>" . (string) $stageInfo['discipline_name'] . "</td>
                    <td>" . (string) $stageInfo['area'] . "</td>
                    <td>" . (string) $stageInfo['capacity'] . "</td>
                    <td>" . (string) $stageInfo['underStagesQty'] . "</td></tr>"
                                );
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#stageTable').DataTable({
                            dom: 'Bfrtip',
                            buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                            language: {
                                lengthMenu: 'Mostrando _MENU_ registros por página',
                                zeroRecords: 'No hay registros para mostrar',
                                info: 'Mostrando página _PAGE_ de _PAGES_',
                                infoEmpty: 'No hay registros disponibles',
                                infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                sSearch: 'Buscar',
                                'paginate': {
                                    'previous': '<<',
                                    'next': '>>'
                                },
                                buttons: {
                                    pageLength: 'Mostrando %d filas'
                                },
                            }
                        });
                    });
                </script>
            </div>
            <div class="row_fixed">
                <h3>Recursos en los almacenes del escenario principal</h3>
            </div>
            <div class="row_fixed">
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Recursos totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                foreach ($this->dataStore("resources") as $obj) {
                                    $total += (int) $obj['Cantidad en almacén'];
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Almacenes totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                $warehouses = array();
                                foreach ($this->dataStore("resources") as $obj) {
                                    array_push($warehouses, $obj['Almacén']);
                                }
                                $wh = array_unique($warehouses);
                                foreach ($wh as $w) {
                                    $total += 1;
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row_fixed">
                <div class="col-12 center">
                    <?php
                    if ($this->dataStore("resources")->count() == 0) {
                        echo ("<h3>No hay datos para mostrar</h3>");
                    } else {
                        $tempArray = array();
                        $tempObj = $this->dataStore("resources");
                        foreach ($tempObj as $obj) {
                            array_pop($obj);
                            array_pop($obj);
                            array_push($tempArray, $obj);
                        }
                        PieChart::create(array(
                            "dataSource" => $tempArray
                        ));
                    }
                    ?>
                </div>
            </div>
            <div class="row_fixed">
                <div class="table-responsive">
                    <table class="table align-items-center" id="itemAmountTable">
                        <thead>
                            <tr>
                                <th>Nombre del objeto</th>
                                <th>Cantidad en el almacén</th>
                                <th>Estado</th>
                                <th>Almacén</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            foreach ($this->dataStore("resources") as $dataR) {
                                echo ("<tr><td>" . (string) $dataR['Nombre del objeto'] . "</td>
                            <td>" . (string) $dataR['Cantidad en almacén'] . "</td>
                            <td>" . (string) $dataR['Estado'] . "</td>
                            <td>" . (string) $dataR['Almacén'] . "</td></tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div style="display: flex;
                        margin-right: auto;
                        margin-left: auto;
                        flex-wrap: wrap;">
                    <?php
                    $data_query = $this->dataStore("stageDef");
                    foreach ($data_query as $data) {
                        echo ("<a type='button' class='btn btn-primary' href='" . route('testpdf', ['id' => $data['id']]) . "'>PDF</a>");
                    }
                    ?>
                </div> -->
            <div class="row_fixed">
                <h3>Recursos en uso del escenario principal</h3>
            </div>
            <div class="row_fixed">
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Recursos en uso totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                foreach ($this->dataStore("resourcesInUse") as $obj) {
                                    $total += (int) $obj['Cantidad en uso'];
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Almacenes totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                $warehouses = array();
                                foreach ($this->dataStore("resources") as $obj) {
                                    array_push($warehouses, $obj['Almacén']);
                                }
                                $wh = array_unique($warehouses);
                                foreach ($wh as $w) {
                                    $total += 1;
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row_fixed">
                <div class="col-12 center">
                    <?php
                    if ($this->dataStore("resourcesInUse")->count() == 0) {
                        echo ("<h3>No hay objetos en uso</h3>");
                    } else {
                        $tempArray = array();
                        $tempObj = $this->dataStore("resourcesInUse");
                        foreach ($tempObj as $obj) {
                            array_pop($obj);
                            array_pop($obj);
                            array_push($tempArray, $obj);
                        }
                        PieChart::create(array(
                            "dataSource" => $tempArray
                        ));
                    }
                    ?>
                </div>
            </div>
            <div class="row_fixed">
                <div class="table-responsive">
                    <table class="table align-items-center" id="itemInUseAmountTable">
                        <thead>
                            <tr>
                                <th>Nombre del objeto</th>
                                <th>Cantidad en uso</th>
                                <th>Estado</th>
                                <th>Almacén</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            foreach ($this->dataStore("resourcesInUse") as $dataR) {
                                echo ("<tr><td>" . (string) $dataR['Nombre del objeto'] . "</td>
                            <td>" . (string) $dataR['Cantidad en uso'] . "</td>
                            <td>" . (string) $dataR['Estado'] . "</td>
                            <td>" . (string) $dataR['Almacén'] . "</td></tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#itemAmountTable').DataTable({
                            dom: 'Bfrtip',
                            buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                            language: {
                                lengthMenu: 'Mostrando _MENU_ registros por página',
                                zeroRecords: 'No hay registros para mostrar',
                                info: 'Mostrando página _PAGE_ de _PAGES_',
                                infoEmpty: 'No hay registros disponibles',
                                infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                sSearch: 'Buscar',
                                'paginate': {
                                    'previous': '<<',
                                    'next': '>>'
                                },
                                buttons: {
                                    pageLength: 'Mostrando %d filas'
                                },
                            },
                            order: [
                                [3, 'asc']
                            ]
                        });
                        $('#itemInUseAmountTable').DataTable({
                            dom: 'Bfrtip',
                            buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                            language: {
                                lengthMenu: 'Mostrando _MENU_ registros por página',
                                zeroRecords: 'No hay registros para mostrar',
                                info: 'Mostrando página _PAGE_ de _PAGES_',
                                infoEmpty: 'No hay registros disponibles',
                                infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                sSearch: 'Buscar',
                                'paginate': {
                                    'previous': '<<',
                                    'next': '>>'
                                },
                                buttons: {
                                    pageLength: 'Mostrando %d filas'
                                },
                            },
                            order: [
                                [3, 'asc']
                            ]
                        });
                    });
                </script>
            </div>
            <div class="row_fixed">
                <div class="col-11">
                    <h3>Cantidad de recursos por estado en el escenario principal</h3>
                    <div class="center">
                        <?php
                        $resourcesByStates = array();

                        foreach ($this->dataStore('resourcesStates') as $info1) {
                            foreach ($this->dataStore('resourcesStates2') as $info2) {
                                if ($info1['statesName'] == $info2['statesName']) {
                                    $rByStates = array("statesName" => $info1['statesName'], "amount" => $info1['amount'], "amounInUse" => $info2['amountInUse']);
                                    array_push($resourcesByStates, $rByStates);
                                }
                            }
                        }

                        BarChart::create(array(
                            "title" => "Cantidad de recursos por estado",
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
                        ?>
                    </div>
                </div>
            </div>
            <div class="row_fixed">
                <h3>Cantidad de recursos por almacén del escenario</h3>
            </div>
            <div class="row_fixed">
                <div class="col-12">
                    <?php
                    $tempArray = array();
                    $tempObj = $this->dataStore("resourceWarehouse");
                    foreach ($tempObj as $obj) {
                        array_pop($obj);
                        array_push($tempArray, $obj);
                    }
                    ColumnChart::create(array(
                        "title" => "Recursos por almacén",
                        "dataStore" => $tempArray,
                        "columns" => array(
                            "warehouseName" => array(
                                "label" => "Almacén"
                            ),
                            "amount" => array(
                                "type" => "number",
                                "label" => "Cantidad de recursos"
                            )
                        )
                    ));
                    ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center" id="resourceWarehouseTable">
                    <thead>
                        <tr>
                            <th>Nombre del objeto</th>
                            <th>Cantidad</th>
                            <th>Almacén</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        foreach ($this->dataStore("rWTable") as $dataR) {
                            echo ("<tr><td>" . (string) $dataR['resourceName'] . "</td>
                            <td>" . (string) $dataR['amount'] . "</td>
                            <td>" . (string) $dataR['warehouseName'] . "</td></tr>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#resourceWarehouseTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                        language: {
                            lengthMenu: 'Mostrando _MENU_ registros por página',
                            zeroRecords: 'No hay registros para mostrar',
                            info: 'Mostrando página _PAGE_ de _PAGES_',
                            infoEmpty: 'No hay registros disponibles',
                            infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                            sSearch: 'Buscar',
                            'paginate': {
                                'previous': '<<',
                                'next': '>>'
                            },
                            buttons: {
                                pageLength: 'Mostrando %d filas'
                            },
                        },
                        order: [[2, 'asc']]
                    });
                });
            </script>
        </div>
    </div>
    <br>
    <br>
    <div class="warpper">
        <div class="panels">
            <h2>Sub escenarios</h2>
            <div class="row_fixed">
                <div class="table-responsive">
                    <table class="table align-items-center" id="subStageTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Estado</th>
                                <th>Disciplina</th>
                                <th>Área</th>
                                <th>Capacidad</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            foreach ($this->dataStore("subStageSimple") as $stageInfo) {
                                echo ("<tr><td>" . (string) $stageInfo['idUnderstage'] . "</td>
                    <td>" . (string) $stageInfo['name_understg'] . "</td>
                    <td>" . (string) $stageInfo['address_understg'] . "</td>
                    <td>" . (string) $stageInfo['statesName'] . "</td>
                    <td>" . (string) $stageInfo['discipline_name'] . "</td>
                    <td>" . (string) $stageInfo['area_understg'] . "</td>
                    <td>" . (string) $stageInfo['capacity_understg'] . "</td></tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#subStageTable').DataTable({
                            dom: 'Bfrtip',
                            buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                            language: {
                                lengthMenu: 'Mostrando _MENU_ registros por página',
                                zeroRecords: 'No hay registros para mostrar',
                                info: 'Mostrando página _PAGE_ de _PAGES_',
                                infoEmpty: 'No hay registros disponibles',
                                infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                sSearch: 'Buscar',
                                'paginate': {
                                    'previous': '<<',
                                    'next': '>>'
                                },
                                buttons: {
                                    pageLength: 'Mostrando %d filas'
                                },
                            },
                        });
                    });
                </script>
            </div>

            <br>
            <?php
            if ($this->dataStore("subResources")->count() == 0) {
                echo ("<h3>No hay datos para mostrar</h3>");
            } else {
                $warehouses = array();
                $secTempArr = array();
                $total = 0;
                $totalWh = 0;

                foreach ($this->dataStore("subStage") as $sub) {
                    foreach ($this->dataStore("subResources") as $temp) {
                        if ($sub['warehouseName'] == $temp['Almacén']) {
                            array_push($secTempArr, $temp);
                            array_push($warehouses, $temp['Almacén']);
                            $total += (int) $temp['Cantidad en almacén'];
                        }
                    }

                    $wh = array_unique($warehouses);
                    foreach ($wh as $w) {
                        $totalWh += 1;
                    }

                    echo ("<div class='row_fixed'><h3>Recursos en el sub escenario
                        <b>" . (string) $sub['name_understg'] . "</b></h3></div>");

                    echo ("<div class='row_fixed'><div class='col-4 card_center'><div class='card' 
                        style='width: 18rem;'><div class='card-body'><h5 class='card-title'>
                        Recursos totales en los almacenes del sub escenario <b>" . (string) $sub['name_understg'] .
                        "</b></h5><h6 class='card-subtitle mb-2 text-muted'>Cantidad</h6><p class='card-text'><h1>
                        " . $total . "</h1></p></div></div></div><div class='col-4'></div><div class='col-4 card_center'>" .
                        "<div class='card' style='width: 18rem;'><div class='card-body'><h5 class='card-title'>" .
                        "Almacenes totales en el sub escenario <b>" . (string) $sub['name_understg'] . "</b></h5>" .
                        "<h6 class='card-subtitle mb-2 text-muted'>Cantidad</h6><p class='card-text'><h1>" . $totalWh .
                        "</h1><p></div></div></div></div>");

                    PieChart::create(array(
                        "dataSource" => $secTempArr
                    ));

                    Table::create(array(
                        "dataStore" => $secTempArr,
                        "cssClass" => array(
                            "table" => "table table-striped table-bordered"
                        )
                    ));

                    $secTempArr = [];
                    $warehouses = [];
                    $total = 0;
                    $totalWh = 0;
                }
            }
            ?>
            <div class="row_fixed">
                <h3>Información <b>total</b> de los inventarios en los sub escenarios</h3>
            </div>
            <div class="row_fixed">
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Recursos totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                foreach ($this->dataStore("subResources") as $obj) {
                                    $total += (int) $obj['Cantidad en almacén'];
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Almacenes totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                $warehouses = array();
                                foreach ($this->dataStore("subResources") as $obj) {
                                    array_push($warehouses, $obj['Almacén']);
                                }
                                $wh = array_unique($warehouses);
                                foreach ($wh as $w) {
                                    $total += 1;
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row_fixed">
                <div class="col-12">
                    <?php
                    PieChart::create(array(
                        "dataSource" => $this->dataStore("subResources")
                    ));
                    ?>
                </div>
            </div>
            <div class="row_fixed">
                <div class="table-responsive">
                    <table class="table align-items-center" id="subStageResources">
                        <thead>
                            <tr>
                                <th>Nombre del objeto</th>
                                <th>Cantidad en almacén</th>
                                <th>Estado</th>
                                <th>Almacén</th>
                                <th>Sub escenario</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            foreach ($this->dataStore("subResources") as $dataR) {
                                echo ("<tr><td>" . (string) $dataR['Nombre del objeto'] . "</td>
                            <td>" . (string) $dataR['Cantidad en almacén'] . "</td>
                            <td>" . (string) $dataR['Estado'] . "</td>
                            <td>" . (string) $dataR['Almacén'] . "</td>
                            <td>" . (string) $dataR['Sub escenario'] . "</td></tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#subStageResources').DataTable({
                            dom: 'Bfrtip',
                            buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                            language: {
                                lengthMenu: 'Mostrando _MENU_ registros por página',
                                zeroRecords: 'No hay registros para mostrar',
                                info: 'Mostrando página _PAGE_ de _PAGES_',
                                infoEmpty: 'No hay registros disponibles',
                                infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                sSearch: 'Buscar',
                                'paginate': {
                                    'previous': '<<',
                                    'next': '>>'
                                },
                                buttons: {
                                    pageLength: 'Mostrando %d filas'
                                },
                            },
                            order: [
                                [4, 'desc']
                            ]
                        });
                    });
                </script>
            </div>

            <br>

            <?php
            if ($this->dataStore("subResourcesInUse")->count() == 0) {
                echo ("<h3>No hay datos para mostrar</h3>");
            } else {
                $warehouses = array();
                $secTempArr = array();
                $total = 0;
                $totalWh = 0;

                foreach ($this->dataStore("subStage") as $sub) {
                    foreach ($this->dataStore("subResourcesInUse") as $temp) {
                        if ($sub['warehouseName'] == $temp['Almacén']) {
                            array_push($secTempArr, $temp);
                            array_push($warehouses, $temp['Almacén']);
                            $total += (int) $temp['Cantidad en uso'];
                        }
                    }

                    $wh = array_unique($warehouses);
                    foreach ($wh as $w) {
                        $totalWh += 1;
                    }

                    echo ("<div class='row_fixed'><h3>Recursos en <b>uso</b> del sub escenario
                        <b>" . (string) $sub['name_understg'] . "</b></h3></div>");

                    echo ("<div class='row_fixed'><div class='col-4 card_center'><div class='card' 
                        style='width: 18rem;'><div class='card-body'><h5 class='card-title'>
                        Recursos totales en <b>uso</b> del sub escenario <b>" . (string) $sub['name_understg'] .
                        "</b></h5><h6 class='card-subtitle mb-2 text-muted'>Cantidad</h6><p class='card-text'><h1>
                        " . $total . "</h1></p></div></div></div><div class='col-4'></div><div class='col-4 card_center'>" .
                        "<div class='card' style='width: 18rem;'><div class='card-body'><h5 class='card-title'>" .
                        "Almacenes totales en el sub escenario <b>" . (string) $sub['name_understg'] . "</b></h5>" .
                        "<h6 class='card-subtitle mb-2 text-muted'>Cantidad</h6><p class='card-text'><h1>" . $totalWh .
                        "</h1><p></div></div></div></div>");

                    PieChart::create(array(
                        "dataSource" => $secTempArr
                    ));

                    Table::create(array(
                        "dataStore" => $secTempArr,
                        "cssClass" => array(
                            "table" => "table table-striped table-bordered"
                        )
                    ));

                    $secTempArr = [];
                    $warehouses = [];
                    $total = 0;
                    $totalWh = 0;
                }
            }
            ?>
            <div class="row_fixed">
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Recursos en <b>uso</b> totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                foreach ($this->dataStore("subResourcesInUse") as $obj) {
                                    $total += (int) $obj['Cantidad en uso'];
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-4 card_center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Almacenes totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Cantidad</h6>
                            <p class="card-text">
                            <h1 class="center">
                                <?php
                                $total = 0;
                                $warehouses = array();
                                foreach ($this->dataStore("subResources") as $obj) {
                                    array_push($warehouses, $obj['Almacén']);
                                }
                                $wh = array_unique($warehouses);
                                foreach ($wh as $w) {
                                    $total += 1;
                                }
                                echo ($total);
                                ?>
                            </h1>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row_fixed">
                <div class="col-12">
                    <?php
                    if ($this->dataStore("subResourcesInUse")->count() == 0) {
                        echo ("<h3>No hay datos para mostrar</h3>");
                    } else {
                        PieChart::create(array(
                            "dataSource" => $this->dataStore("subResourcesInUse")
                        ));
                    }
                    ?>
                </div>
            </div>
            <div class="row_fixed">
                <div class="table-responsive">
                    <table class="table align-items-center" id="subStageResourcesInUse">
                        <thead>
                            <tr>
                                <th>Nombre del objeto</th>
                                <th>Cantidad en uso</th>
                                <th>Estado</th>
                                <th>Almacén</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            foreach ($this->dataStore("subResourcesInUse") as $dataR) {
                                echo ("<tr><td>" . (string) $dataR['Nombre del objeto'] . "</td>
                            <td>" . (string) $dataR['Cantidad en uso'] . "</td>
                            <td>" . (string) $dataR['Estado'] . "</td>
                            <td>" . (string) $dataR['Almacén'] . "</td></tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#subStageResourcesInUse').DataTable({
                            dom: 'Bfrtip',
                            buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                            language: {
                                lengthMenu: 'Mostrando _MENU_ registros por página',
                                zeroRecords: 'No hay registros para mostrar',
                                info: 'Mostrando página _PAGE_ de _PAGES_',
                                infoEmpty: 'No hay registros disponibles',
                                infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                sSearch: 'Buscar',
                                'paginate': {
                                    'previous': '<<',
                                    'next': '>>'
                                },
                                buttons: {
                                    pageLength: 'Mostrando %d filas'
                                },
                            },
                            order: [
                                [3, 'asc']
                            ]
                        });
                    });
                </script>
            </div>
        </div>
    </div>
    <br>
    <br>
    <footer>
        <div class="align-items-center justify-content-xl-between" style="display: flex;
                        margin-right: auto;
                        margin-left: auto;
                        flex-wrap: wrap;">
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