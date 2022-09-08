<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<?php
use \koolreport\widgets\koolphp\Card;
Card::create(array(
    "value" => 1000,
    "title" => "Cantidad total de recursos en los almacenes",
    "cssClass" => array(
        "card" => "bg-info",
        "title" => "text-white",
        "value" => "text-white"
    )
))
?>