<?php
require_once "../src/class.php";

$yurtici = new yurticiKargo();

$response = $yurtici->cancelShipment('123456');

echo "<pre>";
print_r($response);
echo "</pre>";
?>