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
			<div class="tab-pane fade in active" id="compras">
				<div class="panel-group">
					<?php  
					$item = "id_usuario";
					$valor = $_SESSION["id"];

					$compras = UserController::showShopping($item, $valor);

					if (!$compras) { // si no tiene compras
						echo '<div class="col-xs-12 text-center error404">
								<h1><small>¡Oops!</small></h1>
								<h2>Aún no tienes compras realizadas en esta tienda</h2>
							</div>';						
					} else {
						foreach ($compras as $key => $value1) {
							$ordenar = "id";
							$item = "id";
							$valor = $value1["id_producto"];

							$productos = ProductController::listProducts($ordenar, $item, $valor);

							foreach ($productos as $key => $value2) {
								echo '<div class="panel panel-default">
										<div class="panel-body">
											<div class="col-md-2 col-sm-6 col-xs-12">
												<figure>
													<img class="img-thumbnail" src="'.$urlBack.$value2["portada"].'">
												</figure>
											</div>
											<div class="col-sm-6 col-xs-12">
												<h1><small>'.$value2["titulo"].'</small></h1>
												<p>'.$value2["titular"].'</p>';
												if ($value2["tipo"] == "virtual") {
													echo '<a href="'.$urlFron.'/curso">
															<button class="btn btn-default pull-left">Ir al curso</button>
														</a>';
												}else{
													echo '<h6>Proceso de entrega: '.$value2["entrega"].' días hábiles</h6>';
													if ($value1["envio"] == 0) {
														echo '<div class="progress">
																<div class="progress-bar progress-bar-info" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-check"></i> Despachado
																</div>
																<div class="progress-bar progress-bar-default" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-clock-o"></i> Enviando
																</div>
																<div class="progress-bar progress-bar-success" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-clock-o"></i> Entregado
																</div>
															</div>';
													}

													if ($value1["envio"] == 1) {
														echo '<div class="progress">
																<div class="progress-bar progress-bar-info" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-check"></i> Despachado
																</div>
																<div class="progress-bar progress-bar-default" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-check"></i> Enviando
																</div>
																<div class="progress-bar progress-bar-success" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-clock-o"></i> Entregado
																</div>
															</div>';
													}

													if ($value1["envio"] == 2) {
														echo '<div class="progress">
																<div class="progress-bar progress-bar-info" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-check"></i> Despachado
																</div>
																<div class="progress-bar progress-bar-default" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-check"></i> Enviando
																</div>
																<div class="progress-bar progress-bar-success" role="progressbar" style="width: 33.33%">
																	<i class="fa fa-check"></i> Entregado
																</div>
															</div>';
													}
												}
											echo '<h4 class="pull-right"><small>Comprado el '.substr($value1["fecha"], 0, 10).'</small></h4>
										</div>
										<div class="col-md-4 col-xs-12">
											<div class="pull-right">
												<a href="#modalComentarios" data-toggle="modal" idComentario="">
													<button class="btn btn-default backColor">Calificar Productos</button>
												</a>
											</div>
											<br><br>
											<div class="pull-right">
												<h3 class="text-right">
													<i class="fa fa-star text-success" aria-hidden="true"></i>
													<i class="fa fa-star text-success" aria-hidden="true"></i>
													<i class="fa fa-star text-success" aria-hidden="true"></i>
													<i class="fa fa-star text-success" aria-hidden="true"></i>
													<i class="fa fa-star text-success" aria-hidden="true"></i>
												</h3>
												<p class="panel panel-default" style="padding:5px">
													<small>
														Lorem ipsum dolor sit amet, consectetur adipisicingelit. Cupiditate minus, consectetur beatae fugit odio iure repudiandae quia distinctio, id ducimus molestiae. Obcaecati, unde. Illo molestiae dolorum, saepe nisi enim iusto.
													</small>
												</p>
											</div>
										</div>
									</div>
								</div>';
							}
						}
					}
					?>
				</div>
			</div>
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
								 		echo '<img src="'.$urlFron.$_SESSION["foto"].'" class="img-thumbnail">';
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
								echo '<button type="button" class="btn btn-default" id="btnCambiarFoto">
										Cambiar foto de perfil
									</button>';
							}	
							?>
							<div id="subirImagen">
								<input type="file" name="datosImagen" id="datosImagen" class="form-control">
								<img class="previsualizar"></img>
							</div>
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

<div class="modal fade modalFormulario" id="modalComentarios">
	<div class="modal-dialog modal-content">	
		<div class="modal-body modalTitulo">
			<h3 class="backColor">CALIFICA ESTE PRODUCTO</h3>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<form method="post">
				<h1 class="text-center" id="estrellas">
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
				</h1>
				<div class="form-group text-center">
					<label class="radio-inline"><input type="radio" name="puntaje" value="0.5">0.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1.0">1.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1.5">1.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2.0">2.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2.5">2.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3.0">3.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3.5">3.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4.0">4.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4.5">4.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="5.0" checked>5.0</label>
				</div>
				<div class="form-group">
					<label for="comment" class="text-muted">Tu opinión acerca de este producto: <span><small>(máximo 300 caracteres)</small></span></label>
					<textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>
					<br>
					<input type="submit" class="btn btn-default btn-block backColor" value="ENVIAR">
				</div>
			</form>
		</div>
		<div class="modal-footer">
		</div>
	</div>
</div>