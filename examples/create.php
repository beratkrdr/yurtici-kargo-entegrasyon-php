<?php
require_once "../src/class.php";

$yurtici = new yurticiKargo(array(
    'wsUserName'      => "{wsUserName}",
    'wsPassword'      => "{wsPassword}",
    'wsLanguage'      => "{wsLanguage}",    // Default: TR
    'cleanResult'     => true,              // Default: true [true/false]
    'testMode'        => true               // Default: false [true/false]
));

$response = $yurtici->createShipment(array(
    "cargoKey"          => "123456",
    'invoiceKey'        => "654321",
    'receiverCustName'  => "John Doe",
    'receiverAddress'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
    'cityName'          => "City",
    'townName'          => "Town",
    'receiverPhone1'    => "05554443322",
    'emailAddress'      => "johndoe@gmail.com",
    'orgReceiverCustId' => '9999'
));

echo "<pre>";
print_r($response);
echo "</pre>";

?>