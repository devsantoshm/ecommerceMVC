<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximun-scale=1.0, user-scalable=no">
	
	<?php 
		session_start(); //Para inicializar variables de sesión en cualquiera de nuestras páginas
		$urlBack = Route::routeServer(); 
		$template = TemplateController::templateStyle();
	?>
	<link rel="icon" href="<?php echo $urlBack . $template["icono"]; ?>">
	<?php 
		$url = new Route(); 
		$route = $url->urlFront();
		//var_dump($route);

		//MARCADO DE CABECERA
		$rutas = array();
		if (isset($_GET["ruta"])) {
			$rutas = explode("/", $_GET["ruta"]);
			$ruta = $rutas[0];
		} else {
			$ruta = "inicio";
		}

		$cabeceras = TemplateController::getHeaders($ruta);

		if (!$cabeceras["ruta"]) { // si no tengo una ruta definida
			$ruta = "inicio";
			$cabeceras = TemplateController::getHeaders($ruta);
		}
		
	?>
	
	<meta name="title" content="<?php echo $cabeceras['titulo']; ?>">
	<meta name="description" content="<?php echo $cabeceras['descripcion']; ?>">
	<meta name="keyword" content="<?php echo $cabeceras['palabrasClave']; ?>">
	<title><?php echo $cabeceras['titulo']; ?></title>

	<!--=====================================
	Marcado de Open Graph FACEBOOK
	======================================-->

	<meta property="og:title"   content="<?php echo $cabeceras['titulo'];?>">
	<meta property="og:url" content="<?php echo $route.$cabeceras['ruta'];?>">
	<meta property="og:description" content="<?php echo $cabeceras['descripcion'];?>">
	<meta property="og:image"  content="<?php echo $urlBack.$cabeceras['portada'];?>">
	<meta property="og:type"  content="website">	
	<meta property="og:site_name" content="Tu logo">
	<meta property="og:locale" content="es_PE">

	<!--=====================================
	Marcado para DATOS ESTRUCTURADOS GOOGLE
	======================================-->
	
	<meta itemprop="name" content="<?php echo $cabeceras['titulo'];?>">
	<meta itemprop="url" content="<?php echo $route.$cabeceras['ruta'];?>">
	<meta itemprop="description" content="<?php echo $cabeceras['descripcion'];?>">
	<meta itemprop="image" content="<?php echo $urlBack.$cabeceras['portada'];?>">

	<!--=====================================
	Marcado de TWITTER
	======================================-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $cabeceras['titulo'];?>">
	<meta name="twitter:url" content="<?php echo $route.$cabeceras['ruta'];?>">
	<meta name="twitter:description" content="<?php echo $cabeceras['descripcion'];?>">
	<meta name="twitter:image" content="<?php echo $urlBack.$cabeceras['portada'];?>">
	<meta name="twitter:site" content="@tu-usuario">

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
	<link rel="stylesheet" type="text/css" href="<?php echo $route; ?>views/css/footer.css">
	<script src="<?php echo $route; ?>views/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/jquery.easing.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/jquery.scrollUp.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/jquery.flexslider.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/sweetalert.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/md5-min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/dscountdown.min.js"></script>
	<script src="<?php echo $route; ?>views/js/plugins/knob.jquery.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<!-- pixel de facebook -->
	<!-- <script> 	  
	 	!function(f,b,e,v,n,t,s) 	  
	 	{if(f.fbq)return;n=f.fbq=function(){n.callMethod? 	  
	 	n.callMethod.apply(n,arguments):n.queue.push(arguments)}; 	  
	 	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\'; 	  
	 	n.queue=[];t=b.createElement(e);t.async=!0; 	  
	 	t.src=v;s=b.getElementsByTagName(e)[0]; 	  
	 	s.parentNode.insertBefore(t,s)}(window, document,'script', 	  
	 	'https://connect.facebook.net/en_US/fbevents.js'); 	  
	 	fbq('init', '131737410786111'); 	  
	 	fbq('track', 'PageView'); 	
	 </script> 	
	 <noscript><img height="1" width="1" style="display:none" 	  
	 	src="https://www.facebook.com/tr?id=149877372404434&ev=PageView&noscript=1"/>
	 </noscript> --> 
	 <?php echo $template["pixelFacebook"]; ?>
	 
</head>
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
	if ($valor == $rutaCategorias['ruta'] && $rutaCategorias["estado"] == 1)//valida el estado activo 
		$ruta = $valor;

	$rutaSubCategorias = ProductController::showSubCategories($item, $valor);
	//var_dump($rutaSubCategorias[0]['ruta']);
	// este foreach se realiza por que estoy enviando un fetchAll
	foreach ($rutaSubCategorias as $subCat) {
		if ($valor == $subCat['ruta'] && $subCat["estado"] == 1) 
			$ruta = $valor;
	}

	$rutaProductos = ProductController::showInfoProduct($item, $valor);
	if ($rutas[0] == $rutaProductos['ruta'] && $rutaProductos["estado"] == 1) 
		//si ruta productos estado es 1, entonces que me permita capturar la ruta que viene en la url
		$infoProducto = $rutas[0];

	if ($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto") 
		include "modules/products.php";
	else if($infoProducto != null)
		include "modules/infoproduct.php";
	else if($rutas[0] == "buscador" || $rutas[0] == "verificar" || $rutas[0] == "salir" || $rutas[0] == "perfil" || $rutas[0] == "carrito-de-compras" || $rutas[0] == "error" || $rutas[0] == "finalizar-compra" || $rutas[0] == "curso" || $rutas[0] == "ofertas")
		include "modules/".$rutas[0].".php";
	else if($rutas[0] == "inicio"){
		include "modules/slide.php";
		include "modules/featured.php";
	}
	else
		include "modules/error404.php";	
}else{
	include "modules/slide.php";
	include "modules/featured.php";
	include "modules/visitas.php"; 
}

//lo incluye en todas las páginas
include "modules/footer.php";	

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
<script src="<?php echo $route; ?>views/js/visitas.js"></script>

<?php echo $template["apiFacebook"]; ?>

<script>
	$(".btnFacebook").click(function(){
	  	FB.ui({
	  		method: 'share',
	  		display: 'popup',
	  		href: '<?php echo $route.$cabeceras["ruta"]; ?>',
	  	}, function(response){});
  	})

	$(".btnGoogle").click(function(){
		window.open(
			'https://plus.google.com/share?url=<?php echo $route.$cabeceras["ruta"]; ?>',
			'',
			'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400'
		);

		return false;
	})

</script>

<?php echo $template["googleAnalytics"]; ?>
<!-- google analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-999999-1"></script>
<script> 	  
	window.dataLayer = window.dataLayer || []; 	  
	function gtag(){dataLayer.push(arguments);} 	  
	gtag('js', new Date());  	  
	gtag('config', 'UA-9999999-1');
</script> -->
</body>
</html>