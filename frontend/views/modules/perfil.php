<?php  
//Valiar sesión
$urlBack = Route::routeServer();
$urlFron = Route::urlFront();

if (!isset($_SESSION["validarSesion"])) {
	echo '<script>
		window.location = "'.$urlFron.'";
	</script>';

	exit();
}
?>

<div class="container-fluid well well-sm">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb fondoBreadcrumb text-uppercase ">
				<li><a href="<?php echo $urlFron ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="container">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#compras" data-toggle="tab"><i class="fa fa-list-ul"></i> MIS COMPRAS</a></li>
			<li><a href="#deseos" data-toggle="tab"><i class="fa fa-gift"></i> MI LISTA DE DESEOS</a></li>
			<li><a href="#perfil" data-toggle="tab"><i class="fa fa-user"></i> EDITAR PERFIL</a></li>
			<li><a href="<?php echo $urlFron ?>ofertas"><i class="fa fa-star"></i> VER OFERTAS</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="compras">...</div>
			<div class="tab-pane fade" id="deseos">...</div>
			<div class="tab-pane fade" id="perfil">
				<div class="row">
					<form method="post" enctype="multipart/form-data">
						<div class="col-md-3 col-sm-4 col-xs-12 text-center">
							<br>
							<figure id="imgPerfil">
							<?php
								echo '<input type="hidden" name="idUsuario" value="'.$_SESSION["id"].'">
									<input type="hidden" name="passUsuario" value="'.$_SESSION["password"].'">
									<input type="hidden" name="fotoUsuario" value="'.$_SESSION["foto"].'">
									<input type="hidden" name="modoUsuario" value="'.$_SESSION["modo"].'">';

								if ($_SESSION["modo"] == "directo") {
								 	if ($_SESSION["foto"] != "") {
								 		echo '<img src="'.$url.$_SESSION["foto"].'" class="img-thumbnail">';
								 	}else{
								 		echo '<img src="'.$urlBack.'views/img/usuarios/default/anonymous.png" class="img-thumbnail">';
								 	}
								 }else{
								 	echo '<img src="'.$_SESSION["foto"].'" class="img-thumbnail">';
								 }
							?>
							</figure>
							<br>
							<?php 
							if ($_SESSION["modo"] == "directo") {
								echo '<button class="btn btn-default" id="btnCambiarFoto">
										Cambiar foto de perfil
									</button>';
							}	
							?>
						</div>
						<div class="col-md-9 col-sm-8 col-xs-12">
						<br>
						<?php 
						if ($_SESSION["modo"] != "directo") {
							echo '<label class="control-label text-muted text-uppercase">Nombre:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" name="regUsuario" class="form-control" value="'.$_SESSION["nombre"].'" readonly>
								</div>
								<br>
								<label class="control-label text-muted text-uppercase">Correo Electrónico:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" name="regUsuario" class="form-control" value="'.$_SESSION["email"].'" readonly>
								</div>
								<br>
								<label class="control-label text-muted text-uppercase">Modo de registro en el sistema:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-'.$_SESSION["modo"].'"></i></span>
									<input type="text" name="regUsuario" class="form-control text-uppercase" value="'.$_SESSION["modo"].'" readonly>
								</div>
								<br>';
						}else{
							echo '<label class="control-label text-muted text-uppercase" for="editarNombre">Cambiar Nombre:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" id="editarNombre" name="editarNombre" class="form-control" value="'.$_SESSION["nombre"].'">
								</div>
								<br>
								<label class="control-label text-muted text-uppercase" for="editarEmail">Cambiar Correo Electrónico:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input type="text" id="editarEmail" name="editarEmail" class="form-control" value="'.$_SESSION["email"].'">
								</div>
								<br>
								<label class="control-label text-muted text-uppercase" for="editarPassword">Cambiar Contraseña:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="text" id="editarPassword" name="editarPassword" class="form-control" placeholder="Escribe la nueva contraseña">
								</div>
								<br>
								<button type="submit" class="btn btn-default backColor btn-md pull-left">Actualizar Datos</button>';
						}	
						?>
						</div>
						<?php  
						$actualizarPerfil = new UserController();
						$actualizarPerfil->updatePerfil();
						?>
					</form>
					<button class="btn btn-danger btn-md pull-right" id="eliminarUsuario">Eliminar cuenta</button>
				</div>
			</div>
		</div>
	</div>
</div>