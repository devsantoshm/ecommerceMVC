<?php  

require_once "../extensiones/PaypalController.php";
require_once "../controllers/CarController.php";
require_once "../models/CarModel.php";

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

	//VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
	public $idUsuario;
	public $idProducto;

	public function ajaxVerifyProduct()
	{
		$datos = array("idUsuario" => $this->idUsuario,
						"idProducto" => $this->idProducto);

		$respuesta = CarController::verifyProduct($datos);

		echo json_encode($respuesta); // por que me devuelve un array
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

if (isset($_POST["idProducto"])) {
	$producto = new AjaxCar();
	$producto->idUsuario = $_POST["idUsuario"];
	$producto->idProducto = $_POST["idProducto"];
	$producto->ajaxVerifyProduct();
}

?>