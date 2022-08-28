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
</head>
<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\PieChart;
?>
<html>

<head>
    <title>Inventario</title>
</head>

<body>
    <div class="container">
        <?php
        $data_query = $this->dataStore("stageDef");
        foreach ($data_query as $data) {
            echo "<h1 style='text-align:center'>Reporte sobre el inventario del escenario " . (string) $data['name'] . "</h1>";
        }
        ?>
    </div>

    <div class="container">
        <?php
        \koolreport\widgets\google\PieChart::create(array(
            "dataSource" => $this->dataStore("resources")
        ))
        ?>
    </div>


    <?php
    // Table::create([
    //     "dataSource" => $this->dataStore("resources")
    // ]);
    ?>

    <div class="container">
        <table class="table align-items-center" id="itemAmountTable">
            <thead>
                <tr>
                    <th>Nombre del objeto</th>
                    <th>Cantidad en el almacén</th>
                </tr>
            </thead>
            <tbody class="list">
                <?php
                $resourceData = $this->dataStore("resources");
                foreach ($resourceData as $dataR) {
                    echo ("<tr><td>" . (string) $dataR['Nombre del objeto'] . "</td><td>" . (string) $dataR['Cantidad en almacén'] . "</td></tr>");
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
            });
        });
    </script>
    <br>
</body>

</html>