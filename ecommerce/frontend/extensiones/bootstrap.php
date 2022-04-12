<?php

require __DIR__  . '/vendor/autoload.php';



use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$tabla = "comercio";

$respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);

$clienteIdPaypal = $respuesta["clienteIdPaypal"];
$llaveSecretaPaypal = $respuesta["llaveSecretaPaypal"];
$modoPaypal = $respuesta["modoPaypal"];

$apiContext = new ApiContext(
    
    new OAuthTokenCredential(
        
        $clienteIdPaypal,
        $llaveSecretaPaypal
    
    )
);

 $apiContext->setConfig(
    array(
        'mode' => $modoPaypal,
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'DEBUG', 
        'http.CURLOPT_CONNECTTIMEOUT' => 30

    )
);
