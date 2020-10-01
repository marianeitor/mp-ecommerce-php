<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

//Seteo de integrator ID
MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

$merchant_order = null;

switch($_GET["topic"]) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
        // Get the payment and the corresponding merchant_order reported by the IPN.
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
        file_put_contents("response3.txt", $_GET["id"]);
        $payment = array_map('utf8_encode', $payment);
        echo json_encode($payment);
        break;
    case "merchant_order":
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
        file_put_contents("response2.json", json_encode($merchant_order));
        break;
}
?>