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

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);

$preference->payment_methods = array(
    "excluded_payment_methods" => array(
        array("id" => "amex")
    ),
    "installments" => 6
);

$payer = new MercadoPago\Payer();
$payer->name = "Charles";
$payer->surname = "Luevano";
$payer->email = "charles@hotmail.com";
$payer->date_created = "2018-06-02T12:58:41.425-04:00";
$payer->phone = array(
    "area_code" => "",
    "number" => "949 128 866"
);

$payer->identification = array(
    "type" => "DNI",
    "number" => "12345678"
);

$payer->address = array(
    "street_name" => "Cuesta Miguel Armendáriz",
    "street_number" => 1004,
    "zip_code" => "11020"
);

$preference->back_urls = array(
    "success" => "https://www.tu-sitio/success",
    "failure" => "http://www.tu-sitio/failure",
    "pending" => "http://www.tu-sitio/pending"
);
$preference->auto_return = "approved";

echo json_encode($preference);
//$preference->save();
?>