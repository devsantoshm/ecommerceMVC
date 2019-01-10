<?php  

require_once "../extensiones/PaypalController.php";

require_once "../controllers/CarController.php";
require_once "../models/CarModel.php";

require_once "../controllers/ProductController.php";
require_once "../models/ProductModel.php";

class AjaxCar
{
	public $divisa;
	public $total;
	public $totalEncriptado;
	public $impuesto;
	public $envio;
	public $subtotal;
	public $tituloArray;
	public $cantidadArray;
	public $valorItemArray;
	public $idProductoArray;

	public function ajaxSendPaypal()
	{
		if (md5($this->total) == $this->totalEncriptado) {
		
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

	$idProductos = explode("," , $_POST["idProductoArray"]);
	$cantidadProductos = explode("," , $_POST["cantidadArray"]);
	$precioProductos = explode("," , $_POST["valorItemArray"]);

	$item = "id";

	for($i = 0; $i < count($idProductos); $i ++){

		$valor = $idProductos[$i];
		$verificarProductos = ProductController::showInfoProduct($item, $valor);

		$divisa = file_get_contents("http://free.currencyconverterapi.com/api/v3/convert?q=USD_".$_POST["divisa"]."&compact=y");

		$jsonDivisa = json_decode($divisa, true);

		$conversion = number_format($jsonDivisa["USD_".$_POST["divisa"]]["val"],2);

		if($verificarProductos["precioOferta"] == 0){

			$precio = number_format($verificarProductos["precio"]*$conversion, 2);
		
		}else{

			$precio = number_format($verificarProductos["precioOferta"]*$conversion, 2);

		}

		$verificarSubTotal = $cantidadProductos[$i]*$precio;

		if(number_format($verificarSubTotal,2) != number_format($precioProductos[$i],2)){

			echo "carrito-de-compras";

			return;

		}

	}


	$paypal = new AjaxCar();
	$paypal->divisa = $_POST["divisa"];
	$paypal->total = $_POST["total"];
	$paypal->totalEncriptado = $_POST["totalEncriptado"];
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