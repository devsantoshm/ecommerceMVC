<?php  

require_once "../extensiones/PaypalController.php";

class AjaxCar
{
	public $divisa;
	public $total;
	public $impuesto;
	public $envio;
	public $subtotal;
	public $tituloArray;
	public $cantidadArray;
	public $valorItemArray;
	public $idProductoArray;

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

		$respuesta = PaypalController::paymentPaypal($datos);

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