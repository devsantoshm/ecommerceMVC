<?php  

require_once "../models/routes.php";
require_once "../models/CarModel.php";

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PaypalController
{
	static public function paymentPaypal($datos)
	{
		require __DIR__ . '/bootstrap.php';
		
		$tituloArray = explode(",", $datos["tituloArray"]);
		//var_dump($tituloArray);
		$cantidadArray = explode(",", $datos["cantidadArray"]);
		$valorItemArray = explode(",", $datos["valorItemArray"]);
		//Reemplaza todas las apariciones del string buscado con el string de reemplazo y devuelve string o array
		$idProductos = str_replace(",", "-", $datos["idProductoArray"]); // 34-55
		$cantidadProductos = str_replace(",", "-", $datos["cantidadArray"]); // cantidad de cada producto
		$pagoProductos = str_replace(",", "-", $datos["valorItemArray"]);

		//Seleccionamos el método de pago
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item = array();
		$variosItem = array();

		for($i = 0; $i < count($tituloArray); $i++){
			$item[$i] = new Item();
			$item[$i]->setName($tituloArray[$i])
					->setCurrency($datos["divisa"])
					->setQuantity($cantidadArray[$i])
					->setPrice($valorItemArray[$i]/$cantidadArray[$i]);

			array_push($variosItem, $item[$i]); //array_push — Inserta uno o más elementos al final de un array
		}

		//Agrupamos los items en una lista de items
		$itemList = new ItemList();
		$itemList->setItems($variosItem);

		//Agregamos los detalles del pago: impuesto, envios, etc
		$details = new Details();
		$details->setShipping($datos["envio"])
		    ->setTax($datos["impuesto"])
		    ->setSubtotal($datos["subtotal"]);

		//Definimos el pago total con sus detalles
		$amount = new Amount();
		$amount->setCurrency($datos["divisa"])
		    ->setTotal($datos["total"])
		    ->setDetails($details);

		//Agregamos las características de la transacción
		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setItemList($itemList)
		    ->setDescription("Payment description")
		    ->setInvoiceNumber(uniqid());

		//Agregamos las URLs después de realizar el pago, o cuando el pago es cancelado
		//importante agregar la url principal en la API developers de Paypal
		$urlFron = Route::urlFronPaypal();

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("$urlFron/index.php?ruta=finalizar-compra&paypal=true&productos=".$idProductos."&cantidad=".$cantidadProductos."&pago=".$pagoProductos)
		    ->setCancelUrl("$urlFron/carrito-de-compras");

		//Agregamos todas las características del pago
		$payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));

		//Tratar de ejecutar un proceso y si falla ejecutar una rutina de error
		try {
		    $payment->create($apiContext);
		    //var_dump($payment);

		} catch (Paypal\Exception\PaypalConnectionException $ex) {
		    echo $ex->getCode(); //Prints the Error getCode
		    echo $ex->getData(); //Prints the detailed error message
		    die($ex);
		    return "$url/error";
		}

		#utilizamos un foreach para iterar sobre $payment, utilizamos el método llamado getLinks() para obtener todos los enlaces que aparecen en el array $payment  y caso de que $link->getRel() coincide con 'approval_url' extraemos dicho enlace, finalmente enviamos al usuario a esa dirección que guardamos en la variable $redirectUrl con el método getHref()	

		foreach ($payment->getLinks() as $link) {
			if ($link->getRel() == "approval_url") {
				$redirectUrl = $link->getHref();
			}
		}
		// retorna la url paypal para realizar el pago 
		return $redirectUrl;
	}
}

?>