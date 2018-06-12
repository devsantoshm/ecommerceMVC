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
	$cantidad = explode("-", $_GET['cantidad']);

	//Capturamos el id del pago que arroja paypal
	$paymentId = $_GET['paymentId'];

	//Creamos un objeto de payment para confirmar que las credenciales si tengan el id de pago resuelto
	$payment = Payment::get($paymentId, $apiContext);

	//creamos la ejecución de pago, invocando la clase PaymentExecution() y extraemos el id del pagador
	$execution = new PaymentExecution();
	$execution->setPayerId($_GET['PayerID']);

	//validamos con las credenciales que el id del pagador si coincide
	$payment->execute($execution, $apiContext);
	$datosTransaccion = $payment->toJSON();

	//var_dump($datosTransaccion);

	/*$datosTransaccion = '{"id":"PAY-8UL69754JE4975125LMI6F2Y","intent":"sale","state":"approved","cart":"5SN161781V640500A","payer":{"payment_method":"paypal","status":"VERIFIED","payer_info":{"email":"developerh69-buyer@gmail.com","first_name":"test","last_name":"buyer","payer_id":"HMF3TE5QT7MRN","shipping_address":{"recipient_name":"test buyer","line1":"1 Main St","city":"San Jose","state":"CA","postal_code":"95131","country_code":"US"},"country_code":"US"}},"transactions":[{"amount":{"total":"926.15","currency":"MXN","details":{"subtotal":"527.35","tax":"100.30","shipping":"298.50"}},"payee":{"merchant_id":"P3FSA9QMG5GZ4","email":"developerh69-facilitator@gmail.com"},"description":"Payment description","invoice_number":"5b11e2e80ef40","item_list":{"items":[{"name":"Tennis Verde-36-negro","price":"328.35","currency":"MXN","quantity":1},{"name":"Curso de jQuery","price":"199.00","currency":"MXN","quantity":1}],"shipping_address":{"recipient_name":"test buyer","line1":"1 Main St","city":"San Jose","state":"CA","postal_code":"95131","country_code":"US"}},"related_resources":[{"sale":{"id":"1XN143230X700333B","state":"pending","amount":{"total":"926.15","currency":"MXN","details":{"subtotal":"527.35","tax":"100.30","shipping":"298.50"}},"payment_mode":"INSTANT_TRANSFER","reason_code":"RECEIVING_PREFERENCE_MANDATES_MANUAL_ACTION","protection_eligibility":"ELIGIBLE","protection_eligibility_type":"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE","parent_payment":"PAY-8UL69754JE4975125LMI6F2Y","create_time":"2018-06-02T00:21:40Z","update_time":"2018-06-02T00:21:40Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/sale/1XN143230X700333B","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/payments/sale/1XN143230X700333B/refund","rel":"refund","method":"POST"},{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-8UL69754JE4975125LMI6F2Y","rel":"parent_payment","method":"GET"}]}}]}],"redirect_urls":{"return_url":"http://localhost/ecommerce/frontend/index.php?ruta=finalizar-compra&paypal=true&productos=464-498&paymentId=PAY-8UL69754JE4975125LMI6F2Y","cancel_url":"http://localhost/ecommerce/frontend/carrito-de-compras"},"create_time":"2018-06-02T00:21:41Z","update_time":"2018-06-02T00:21:39Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-8UL69754JE4975125LMI6F2Y","rel":"self","method":"GET"}]}';*/

	$datosUsuario = json_decode($datosTransaccion);//Convierte un string codificado en JSON a una variable de PHP
	//print_r($datosUsuario->payer->payer_info);

	$emailComprador = $datosUsuario->payer->payer_info->email;
	$dir = $datosUsuario->payer->payer_info->shipping_address->line1;
	$ciudad = $datosUsuario->payer->payer_info->shipping_address->city;
	$estado = $datosUsuario->payer->payer_info->shipping_address->state;
	$codigoPostal = $datosUsuario->payer->payer_info->shipping_address->postal_code;
	$pais = $datosUsuario->payer->payer_info->shipping_address->country_code;

	$direccion = $dir.", ".$ciudad.", ".$estado.", ".$codigoPostal;

	//Actualizamos la base de datos
	for($i = 0; $i < count($productos); $i++)
	{
		$datos = array("idUsuario" => $_SESSION["id"],
						"idProducto" => $productos[$i],
						"metodo" => "paypal",
						"email" => $emailComprador,
						"direccion" => $direccion,
						"pais" => $pais);

		$respuesta = CarController::newShopping($datos);

		$ordenar = "id";
		$item = "id";
		$valor = $productos[$i];

		$productosCompra = ProductController::listProducts($ordenar, $item, $valor);

		foreach ($productosCompra as $key => $value) {
			
			$item1 = "ventas";
			$valor1 = $value["ventas"] + $cantidad[$i];
			$item2 = "id";
			$valor2 = $value["id"];

			$actualizarCompra = ProductController::updateProduct($item1, $valor1, $item2, $valor2);
		}

		if ($respuesta == "ok" && $actualizarCompra == "ok") {

			// ENVIAR UN CORREO AL USUARIO QUE REALIZO LA COMPRA DE LOS PRODUCTOS
			echo '<script>
				localStorage.removeItem("listaProductos");
				localStorage.removeItem("cantidadCesta");
				localStorage.removeItem("sumaCesta");
				window.location = "'.$urlFron.'perfil";
			</script>';
		}
	}
} else if (isset($_GET['gratis']) && $_GET['gratis'] === 'true') { //ADQUISICIONES GRATUITAS
	
	$producto = $_GET['producto'];
	$titulo = $_GET['titulo']; //todavia no trabajado

	$datos = array("id_usuario" => $_SESSION["id"],
					"id_producto" => $producto,
					"metodo" => "gratis",
					"email" => $_SESSION["email"],
					"direccion" => "",
					"pais" => ""
			);

	$respuesta = CarController::newShopping($datos);

	$ordenar = "id";
	$item = "id";
	$valor = $producto;

	$productosGratis = ProductController::listProducts($ordenar, $item, $valor);

	foreach ($productosGratis as $key => $value) {
		
		$item1 = "ventasGratis";
		$valor1 = $value["ventasGratis"] + 1;
		$item2 = "id";
		$valor2 = $value["id"];

		$actualizarSolicitud = ProductController::updateProduct($item1, $valor1, $item2, $valor2);
	}

	if ($respuesta == "ok" && $actualizarSolicitud == "ok") {
		//enviar al correo de la persona con la información del producto adquirido o almacenar en la bd
		echo '<script>
			window.location = "'.$urlFron.'ofertas/aviso";
		</script>';
	}

} else{

	echo '<script>window.location = "'.$urlFron.'cancelado"</script>';
}

?>