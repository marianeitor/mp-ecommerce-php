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
$item->title = $_POST['title'];
$item->quantity = 1;
$item->unit_price = "https://marianeitor-mp-commerce-php.herokuapp.com" . $_POST['price'];
$item->picture_url = $_POST['img'];
$item->description = "Dispositivo móvil de Tienda e-commerce";


$preference->items = array($item);

$preference->payment_methods = array(
    "excluded_payment_methods" => array(
        array("id" => "amex")
    ),
    "installments" => 6
);

$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_63274575@testuser.com";
$payer->phone = array(
    "area_code" => "11",
    "number" => "22223333"
);

$payer->identification = array(
    "type" => "DNI",
    "number" => "12345678"
);

$payer->address = array(
    "street_name" => "False",
    "street_number" => 123,
    "zip_code" => "1111"
);

$preference->back_urls = array(
    "success" => "https://www.tu-sitio/success",
    "failure" => "http://www.tu-sitio/failure",
    "pending" => "http://www.tu-sitio/pending"
);
$preference->auto_return = "approved";

print_r ($preference);
$preference->save();

header("Location: ". $preference->init_point);

?>