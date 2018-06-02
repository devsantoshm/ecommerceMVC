<?php  

$urlFron = Route::urlFront();

if (!isset($_SESSION["validarSesion"])) {
	echo '<script>
		window.location = "'.$urlFron.'";
	</script>';

	exit();
}

//requerimos las credenciales de paypal
require 'extensiones/bootstrap.php';
require_once "models/CarModel.php"; //sin dos puntos por que estamos en la raiz

//importamos libreria del sdk
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

//PAGO Paypal

//evaluamos si la compra está aprobada
if (isset($_GET['paypal']) && $_GET['paypal'] === 'true') {
	//recibo los productos comprados
	$productos = explode("-", $_GET['productos']);

	//Capturamos el id del pago que arroja paypal
	$paymentId = $_GET['paymentId'];

	//Creamos un objeto de payment para confirmar que las credenciales si tengan el id de pago resuelto
	$payment = Payment::get($paymentId, $apiContext);

	//creamos la ejecución de pago, invocando la clase PaymentExecution() y extraemos el id del pagador
	$execution = new PaymentExecution();
	$execution->setPayerId($_GET['PayerID']);

	//validamos con las credenciales que el id del pagador si coincide
	$payment->execute($execution, $apiContext);

	//Actualizamos la base de datos
	for($i = 0; $i < count($productos); $i++)
	{
		$datos = array("idUsuario" => $_SESSION["id"],
						"idProducto" => $productos[$i]);

		$respuesta = CarController::newShopping($datos);
	}
}

?>