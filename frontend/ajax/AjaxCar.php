<?php  

class AjaxCar
{
	private $divisa;
	private $total;
	private $impuesto;
	private $envio;
	private $subtotal;
	private $tituloArray;
	private $cantidadArray;
	private $valorItemArray;
	private $idProductoArray;

	public function ajaxSendPaypal()
	{
		$datos = array(
			"divisa"=>$this->divisa,
			"total"=>$this->total,
			"impuesto"=>$this->impuesto,
			"envio"=>$this->envio,
			"subtotal"=>$this->subtotal,
			"tituloArray"=>$this->tituloArray,
			"cantidadArray"=>$this->cantidadArray,
			"valorItemArray"=>$this->valorItemArray,
			"idProductoArray"=>$this->idProductoArray
		);

		$respuesta = Paypal::paymentPaypalModel($datos);

		echo $respuesta;
	}
}

if (isset($_POST["divisa"])) {
	$paypal = new AjaxCar();
	$paypal->divisa = $_POST["divisa"];
	$paypal->total = $_POST["total"];
	$paypal->impuesto = $_POST["impuesto"];
	$paypal->envio = $_POST["envio"];
	$paypal->subtotal = $_POST["subtotal"];
	$paypal->tituloArray = $_POST["tituloArray"];
	$paypal->cantidadArray = $_POST["cantidadArray"];
	$paypal->valorItemArray = $_POST["valorItemArray"];
	$paypal->idProductoArray = $_POST["idProductoArray"];
	$paypal->ajaxSendPaypal();
}

?>