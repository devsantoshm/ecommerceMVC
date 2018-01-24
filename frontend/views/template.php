<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximun-scale=1.0, user-scalable=no">
	<meta name="title" content="Tienda Virtual">
	<?php  
		$icon = TemplateController::templateStyle();
	?>
	<link rel="icon" href="http://localhost/ecommerce/backend/<?php echo $icon["icono"] ?>">
	<?php 
		$url = new Route(); 
		$route = $url->route();
		//var_dump($route);
	?>
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua.">
	<meta name="keyword" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua.">
	<title>Tienda virtual</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/plugins/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/plugins/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/template.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/header.css">
	<script src="<?php echo $route; ?>views/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/bootstrap.min.js"></script>
<body>
<?php  
include 'modules/header.php';

$rutas = array();
$ruta = null;

if (isset($_GET["ruta"])) {
	$rutas = explode("/", $_GET["ruta"]);
	//var_dump($rutas[0]);
	$item = "ruta"; // es la columna de una tabla determinada en la BD
	$valor = $rutas[0]; //$valor = $_GET["ruta"];
	$rutaCategorias = ProductController::showCategories($item, $valor);
	//var_dump($rutaCategorias['ruta']);
	if ($valor == $rutaCategorias['ruta']) 
		$ruta = $valor;

	$rutaSubCategorias = ProductController::showSubCategories($item, $valor);
	//var_dump($rutaSubCategorias[0]['ruta']);
	// este foreach se realiza por que estoy enviando un fetchAll
	foreach ($rutaSubCategorias as $subCat) {
		if ($valor == $subCat['ruta']) 
			$ruta = $valor;
	}

	if ($ruta != null) 
		include "modules/products.php";
	else
		include "modules/error404.php";	
}	

?>
<script src="<?php echo $route; ?>views/js/header.js"></script>
<script src="<?php echo $route; ?>views/js/template.js"></script>
</body>
</html>