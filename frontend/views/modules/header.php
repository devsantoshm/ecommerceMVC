<?php 
$urlBack = Route::routeServer();  
$urlFron = Route::urlFront();

if (isset($_SESSION["validarSesion"])) {
	if ($_SESSION["validarSesion"] == "ok") {
		echo '<script>
			localStorage.setItem("usuario", "'.$_SESSION["id"].'");
		</script>';
	}
}

//Crear el objeto de la API GOOGLE
$cliente = new Google_Client();
$cliente->setAuthConfig('models/credencia.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile', 'email']);

$rutaGoogle = $cliente->createAuthUrl();

if (isset($_GET["code"])) {
	$token = $cliente->authenticate($_GET["code"]); //generar un token de autenticacion
	$_SESSION['id_token_google'] = $token;
	$cliente->setAccessToken($token);
}

if ($cliente->getAccessToken()) {
	$item = $cliente->verifyIdToken();
	//var_dump($item);
	$datos = array("nombre" => $item["name"],
					"email" => $item["email"],
					"foto" => $item["picture"],
					"password" => "null",
					"modo" => "google",
					"verificacion" => 0,
					"emailEncriptado" => "null");

	$respuesta = UserController::registerNetworkSocial($datos);

	echo '<script>
	setTimeout(function(){
		window.location = localStorage.getItem("rutaActual");
	}, 1000);
	</script>';
}
?>
<div class="container-fluid barraSuperior" id="top">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
				<ul>
					<?php  
					$social = TemplateController::templateStyle();
					$jsonRedesSociales = json_decode($social["redesSociales"], true); // convierte el string en un array
					foreach ($jsonRedesSociales as $item) {
						echo '<li>
								<a href="'.$item["url"].'" target="_blank">
									<i class="fa '.$item["red"].' redSocial '.$item["estilo"].'" aria-hidden="true"></i>
								</a>
							</li>';
					}
					?>
				</ul>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
				<ul>
					<?php  
					if (isset($_SESSION["validarSesion"])) {
						if ($_SESSION["validarSesion"] == "ok") {
							if ($_SESSION["modo"] == "directo") {
								if ($_SESSION["foto"] != "") {
									echo '<li>
											<img class="img-circle" src="'.$urlFron.$_SESSION["foto"].'" width="10%">
										</li>';
								} else {
									echo '<li>
											<img class="img-circle" src="'.$urlBack.'views/img/usuarios/default/anonymous.png" width="10%">
										</li>';
								}
								echo '<li>|</li>
									<li><a href="'.$urlFron.'perfil">Ver Perfil</a></li>
									<li>|</li>
									<li><a href="'.$urlFron.'salir">Salir</a></li>';

							} 

							if ($_SESSION["modo"] == "facebook") {
								echo '<li>
										<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
									</li>
									<li>|</li>
									<li><a href="'.$urlFron.'perfil">Ver Perfil</a></li>
									<li>|</li>
									<li><a href="'.$urlFron.'salir" class="salir">Salir</a></li>';	
							}

							if ($_SESSION["modo"] == "google") {
								echo '<li>
										<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
									</li>
									<li>|</li>
									<li><a href="'.$urlFron.'perfil">Ver Perfil</a></li>
									<li>|</li>
									<li><a href="'.$urlFron.'salir">Salir</a></li>';	
							}
						}
					} else {
						echo '<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
							<li>|</li>
							<li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<header class="container-fluid">
	<div class="container">
		<div class="row" id="cabezote">
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
				<a href="<?php echo $urlFron ?>">
					<img src="<?php echo $urlBack.$social["logo"] ?>" class="img-responsive">
				</a>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
					<p>CATEGORÍAS
						<span class="pull-right"><i class="fa fa-bars" aria-hidden="true"></i></span>
					</p>
				</div>
				<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
					<input type="search" name="buscar" class="form-control" placeholder="Buscar...">
					<span class="input-group-btn">
						<a href="<?php echo $urlFron ?>buscador/1/recientes">
							<button class="btn btn-default backColor" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</a>
					</span>	
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
				<a href="<?php echo $urlFron ?>carrito-de-compras">
					<button class="btn btn-default pull-left backColor">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</button>
				</a>
				<p>TU CESTA <span class="cantidadCesta"></span><br>USD$ <span class="sumaCesta"></span></p>
			</div>
		</div>
		<div class="col-xs-12 backColor" id="categorias">
			<?php  
			$item = null;
			$valor = null;
			$categories = ProductController::showCategories($item, $valor);
			foreach ($categories as $cat) {
			?>
			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
				<h4>
					<a href="<?php echo $urlFron.$cat["ruta"] ?>" class="pixelCategorias" titulo="<?php echo $cat["categoria"] ?>"><?php echo $cat["categoria"] ?></a>
				</h4>
				<hr>
				<ul>

					<?php
					$item = 'id_categoria';
					$valor = $cat["id"];
					$subcategories = ProductController::showSubCategories($item, $valor); 
					foreach ($subcategories as $subcat) {
					?>
					<li><a href="<?php echo $urlFron.$subcat["ruta"] ?>" class="pixelSubCategorias" titulo="<?php echo $subcat["subcategoria"] ?>"><?php echo $subcat["subcategoria"] ?></a></li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
		</div>
	</div>
</header>

<div class="modal fade modalFormulario" id="modalRegistro">
	<div class="modal-dialog modal-content">	
		<div class="modal-body modalTitulo">
			<h3 class="backColor">REGISTRARSE</h3>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<div class="col-sm-6 col-xs-12 facebook">
				<p><i class="fa fa-facebook"></i> Registro con Facebook</p>
			</div>
			<a href="<?php echo $rutaGoogle ?>">
				<div class="col-sm-6 col-xs-12 google">
					<p><i class="fa fa-google"></i> Registro con Google</p>
				</div>
			</a>
			<form method="post" onsubmit="return registroUsuario()">
				<hr>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="regUsuario" id="regUsuario" class="form-control" placeholder="Nombre Completo" required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="regEmail" id="regEmail" class="form-control" placeholder="Correo Electrónico" required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="regPassword" id="regPassword" class="form-control" placeholder="Contraseña" required>
					</div>
				</div>
				<!-- iubenda condiciones de uso y politicas de privacidad -->
				<div class="checkBox">
					<label>
						<input type="checkbox" id="regPoliticas">
						<small>
							Acepta nuestras condiciones de uso y políticas de privacidad 
							<a href="//www.iubenda.com/privacy-policy/37220716" class="iubenda-white iubenda-embed" title="Condiciones de uso y políticas de privacidad">Leer más</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
						</small>
					</label>
				</div>
				<?php  
				$registro = new UserController();
				$registro->registerUser();
				?>
				<input type="submit" class="btn btn-default btn-block backColor" value="ENVIAR">
			</form>
		</div>
		<div class="modal-footer">
			¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>
		</div>
	</div>
</div>

<div class="modal fade modalFormulario" id="modalIngreso">
	<div class="modal-dialog modal-content">	
		<div class="modal-body modalTitulo">
			<h3 class="backColor">INGRESAR</h3>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<div class="col-sm-6 col-xs-12 facebook">
				<p><i class="fa fa-facebook"></i> Ingreso con Facebook</p>
			</div>
			<a href="<?php echo $rutaGoogle ?>">
				<div class="col-sm-6 col-xs-12 google">
					<p><i class="fa fa-google"></i> Ingreso con Google</p>
				</div>
			</a>
			<form method="post">
				<hr>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="ingEmail" id="ingEmail" class="form-control" placeholder="Correo Electrónico" required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="ingPassword" id="ingPassword" class="form-control" placeholder="Contraseña" required>
					</div>
				</div>
				<?php  
				$ingreso = new UserController();
				$ingreso->loginUser();
				?>
				<input type="submit" class="btn btn-default btn-block backColor btnIngreso" value="ENVIAR">
				<br>
				<center>
					<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu Contraseña?</a>
				</center>
			</form>
		</div>
		<div class="modal-footer">
			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
		</div>
	</div>
</div>

<div class="modal fade modalFormulario" id="modalPassword">
	<div class="modal-dialog modal-content">	
		<div class="modal-body modalTitulo">
			<h3 class="backColor">SOLICITUD DE NUEVA CONTRASEÑA</h3>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<form method="post">
				<label>Escribe el correo Electrónico con el que estás registrado y te enviaremos una nueva Contraseña:</label>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="passEmail" id="passEmail" class="form-control" placeholder="Correo Electrónico" required>
					</div>
				</div>
				<?php  
				$password = new UserController();
				$password->forgetPassword();
				?>
				<input type="submit" class="btn btn-default btn-block backColor" value="ENVIAR">
			</form>
		</div>
		<div class="modal-footer">
			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
		</div>
	</div>
</div>