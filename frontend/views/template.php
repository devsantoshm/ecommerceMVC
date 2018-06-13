<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximun-scale=1.0, user-scalable=no">
	<meta name="title" content="Tienda Virtual">
	<?php 
		session_start(); //Para inicializar variables de sesión en cualquiera de nuestras páginas
		$urlBack = Route::routeServer(); 
		$icon = TemplateController::templateStyle();
	?>
	<link rel="icon" href="<?php echo $urlBack . $icon["icono"]; ?>">
	<?php 
		$url = new Route(); 
		$route = $url->urlFront();
		//var_dump($route);
	?>
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua.">
	<meta name="keyword" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua.">
	<title>Tienda virtual</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/plugins/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/plugins/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/plugins/flexslider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/plugins/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/plugins/dscountdown.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/template.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/slide.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/products.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/infoproduct.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/perfil.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/carrito-de-compras.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/ofertas.css">
	<script src="<?php echo $route; ?>views/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/jquery.easing.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/jquery.scrollUp.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/jquery.flexslider.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/sweetalert.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/dscountdown.min.js"></script>
<body>
<?php  
include 'modules/header.php';

$rutas = array();
$ruta = null;
$infoProducto = null;

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

	$rutaProductos = ProductController::showInfoProduct($item, $valor);
	if ($rutas[0] == $rutaProductos['ruta']) 
		$infoProducto = $rutas[0];

	if ($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto") 
		include "modules/products.php";
	else if($infoProducto != null)
		include "modules/infoproduct.php";
	else if($rutas[0] == "buscador" || $rutas[0] == "verificar" || $rutas[0] == "salir" || $rutas[0] == "perfil" || $rutas[0] == "carrito-de-compras" || $rutas[0] == "error" || $rutas[0] == "finalizar-compra" || $rutas[0] == "curso" || $rutas[0] == "ofertas")
		include "modules/".$rutas[0].".php";
	else
		include "modules/error404.php";	
}else{
	include "modules/slide.php";
	include "modules/featured.php";
}	

?>

<input type="hidden" value="<?php echo $route; ?>" id="rutaFron">

<script src="<?php echo $route; ?>views/js/header.js"></script>
<script src="<?php echo $route; ?>views/js/template.js"></script>
<script src="<?php echo $route; ?>views/js/slide.js"></script>
<script src="<?php echo $route; ?>views/js/search.js"></script>
<script src="<?php echo $route; ?>views/js/infoproduct.js"></script>
<script src="<?php echo $route; ?>views/js/users.js"></script>
<script src="<?php echo $route; ?>views/js/registroFacebook.js"></script>
<script src="<?php echo $route; ?>views/js/carrito-de-compras.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '599927650349517',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.12'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>