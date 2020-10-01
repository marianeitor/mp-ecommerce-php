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
$item->id = "1234";
$item->title = $_POST['title'];
$item->quantity = 1;
$item->unit_price = $_POST['price'];
$item->picture_url = "https://marianeitor-mp-commerce-php.herokuapp.com".substr($_POST['img'],1);
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
    "success" => "https://marianeitor-mp-commerce-php.herokuapp.com/success.php",
    "failure" => "https://marianeitor-mp-commerce-php.herokuapp.com/failure.php",
    "pending" => "https://marianeitor-mp-commerce-php.herokuapp.com/pending.php"
);

$preference->external_reference = "mariano1colombo@hotmail.com";
$preference->auto_return = "approved";
$preference->notification_url = "https://marianeitor-mp-commerce-php.herokuapp.com/ipn.php";

print_r ($preference);
$preference->save();

echo $item->picture_url;
die();

header("Location: ". $preference->init_point);

?>