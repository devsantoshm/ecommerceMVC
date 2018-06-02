<?php  

require __DIR__ . '/vendor/autoload.php';


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$table = "commerce";

$respuesta = CarModel::showRates($table); //de la tabla commerce

$clienteIdPaypal = $respuesta["clienteIdPaypal"];
$llaveSecretaPaypal = $respuesta["llaveSecretaPaypal"];
$modoPaypal = $respuesta["modoPaypal"];

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
		$clienteIdPaypal,
		$llaveSecretaPaypal
	)
);

$apiContext->setConfig(
	array(
		'mode' => $modoPaypal,
		'log.LogEnabled' => true,
		'log.FileName' => '../Paypal.log',
		'log.LogLevel' => 'DEBUG',
		'http.CURLOPT_CONNECTTIMEOUT' => 30
	)
);

?>