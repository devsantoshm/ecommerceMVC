<?php 

$urlFron = Route::urlFront();
$item = "emailEncriptado";
$valor = $rutas[1];
$response = UserController::showUser($item, $valor);

$id = $response["id"];
$item2 = "verificacion";
$valor2 = 0;
$response2 = UserController::updateUser($id, $item2, $valor2); 
$usuarioVerificado = false;

if($response2 == "ok")
	$usuarioVerificado = true;

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center verificar">
			<?php 
			if ($usuarioVerificado) {
				echo '<h3>Gracias</h3>
					<h2><small>¡Hemos verificado su correo electrónico, ya puede ingresar al sistema!</small></h2>
					<br>
					<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default btn-lg backColor">INGRESAR</button></a>';
			} else {
				echo '<h3>Error</h3>
					<h2><small>¡No se ha podido verificar el correo electrónico, vuelva a registrarse!</small></h2>
					<br>
					<a href="#modalRegistro" data-toggle="modal"><button class="btn btn-default btn-lg backColor">REGISTRO</button></a>';
			}
			
			?>
		</div>
	</div>
</div>
