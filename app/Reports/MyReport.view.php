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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Inventario</title>
</head>
<?php

use koolreport\widgets\google\BarChart;
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\PieChart;
use \koolreport\widgets\google\ColumnChart;
?>
<html>
<style>
    .row {
        display: flex;
        margin-right: auto;
        margin-left: auto;
        flex-wrap: wrap;
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

<body>
    <div class="container">
        <?php
        $data_query = $this->dataStore("stageDef");
        foreach ($data_query as $data) {
            echo "<h1 style='text-align:center'>Inventario del escenario " . (string) $data['name'] . "</h1>";
        }
        ?>
    </div>

    <br>

    <div class="warpper">
        <input style="display:none" id="one" name="group" type="radio" checked>
        <input style="display:none" id="two" name="group" type="radio">
        <div class="tabs">
            <label class="tab" id="one-tab" for="one">Recursos en el almacén</label>
            <label class="tab" id="two-tab" for="two">Recursos en uso</label>
        </div>
        <div class="panels">
            <div class="panel" id="one-panel">
                <div style="display: flex;
                        margin-right: auto;
                        margin-left: auto;
                        flex-wrap: wrap;">
                    <div class="col-5 center">
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
                    <div class="col-7">
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
                            <td>" . (string) $dataR['Almacén'] . "</td</tr>");
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
            </div>
            <div class="panel" id="two-panel">
                <div style="display: flex;
                        margin-right: auto;
                        margin-left: auto;
                        flex-wrap: wrap;">
                    <div class="col-5 center">
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
                    <div class="col-7">
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
                    </div>
                </div>
            </div>
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
                });
            });
        </script>
        <br>
    </div>
    <div class="warpper">
        <div class="panels">
            <div style="display: flex;
                        margin-right: auto;
                        margin-left: auto;
                        flex-wrap: wrap;">
                <div class="col-11">
                    <h3>Estado de los recursos</h3>
                    <div class="center">
                        <?php
                        BarChart::create(array(
                            "dataStore" => $this->dataStore('resourcesStates'),
                            "columns" => array(
                                "statesName" => array(
                                    "label" => "Estado"
                                ),
                                "idResource" => array(
                                    "type" => "number",
                                    "label" => "Cantidad de recursos"
                                )
                            ),
                            "options" => array(
                                "title" => "Estado de los recursos"
                            )
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="warpper">
        <div class="panels">
            <div style="display: flex;
                        margin-right: auto;
                        margin-left: auto;
                        flex-wrap: wrap;">
                <h3>Recursos por almacén</h3>
            </div>
            <div style="display: flex;
                        margin-right: auto;
                        margin-left: auto;
                        flex-wrap: wrap;">
                <br>
                <div class="col-6">
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
                <div class="col-6">
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
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
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

</html>