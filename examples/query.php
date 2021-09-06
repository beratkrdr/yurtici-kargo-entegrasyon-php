<?php
require_once "../src/class.php";

$yurtici = new yurticiKargo();

$response = $yurtici->queryShipment('123456', 0, false, true);

echo "<pre>";
print_r($response);
echo "</pre>";

?>