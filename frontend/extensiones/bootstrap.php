<?php  

require __DIR__ . '/vendor/autoload.php';

use Paypal\Rest\ApiContext;
use Paypal\Auth\OAuthTokenCredential;

$respuesta = CarModel::showRates($table); //de la tabla commerce

$clienteIdPaypal = $respuesta["clienteIdPaypal"];
$llaveSecretaPaypal = $respuesta["llaveSecretaPaypal"];
$modoPaypal = $respuesta["modoPaypal"];

$ApiContext = new ApiContext(
	new OAuthTokenCredential(
		$clienteIdPaypal,
		$llaveSecretaPaypal
	)
);

$ApiContext->setConfig(
	array(
		'mode' => $modoPaypal,
		'log.LogEnabled' => true,
		'log.FileName' => '../Paypal.log',
		'log.LogLevel' => 'DEBUG',
		'http.CURLOPT_CONNECTTIMEOUT' => 30
	)
);

?>