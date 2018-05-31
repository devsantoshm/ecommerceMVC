<?php  

require __DIR__ . '/bootstrap.php';
require_once "../models/routes.php";

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
		$tituloArray = explode(",", $datos["tituloArray"]);
		//var_dump($tituloArray);
		$cantidadArray = explode(",", $datos["cantidadArray"]);
		$valorItemArray = explode(",", $datos["valorItemArray"]);
		$idProductoArray = explode(",", $datos["idProductoArray"]);

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
		$urlFron = Route::urlFront();
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("$urlFron")
		    ->setCancelUrl("$urlFron");
	}
}

?>