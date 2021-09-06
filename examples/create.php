<?php
require_once "../src/class.php";

$yurtici = new yurticiKargo();

$response = $yurtici->createShipment(array(
    "cargoKey" => "123456",
    'invoiceKey'=>"DENEME",
    'receiverCustName'=>"DENEME DENEME",
    'receiverAddress'=>"DENEME DENEME",
    'cityName'=>"DENEME",
    'townName'=>"DENEME",
    'receiverPhone1'=>"DENEME",
    'emailAddress'=>"info@umitkatmer.com.tr",
    'orgReceiverCustId'=>'9999'
));

echo "<pre>";
print_r($response);
echo "</pre>";

?>