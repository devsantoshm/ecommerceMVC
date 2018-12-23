<?php  
class UserController
{
	public function registerUser()
	{
		if (isset($_POST["regUsuario"])) {
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])) {

				$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$encriptarEmail = md5($_POST["regEmail"]);

				$datos = array("nombre" => $_POST["regUsuario"],
								"password" => $encriptar,
								"email" => $_POST["regEmail"],
								"foto" => "",
								"modo" => "directo",
								"verificacion" => 1,
								"emailEncriptado" => $encriptarEmail
						);

				$tabla = "users";
				$respuesta = UserModel::registerUser($tabla, $datos);

				if ($respuesta == "ok") {

					/*=============================================
					ACTUALIZAR NOTIFICACIONES NUEVOS USUARIOS
					=============================================*/
					$traerNotificaciones = NotificationsController::showNotifications();

					$nuevoUsuario = $traerNotificaciones["nuevosUsuarios"] + 1;

					NotificationsModel::updateNotifications("notifications", "nuevosUsuarios", $nuevoUsuario);


					//Verificación correo electrónico
					date_default_timezone_set("America/Lima");
					$urlFron = Route::urlFront();
					$mail = new PHPMailer;
					$mail->CharSet = 'UTF-8';
					$mail->isMail();
					$mail->setFrom('cursos@developerplus.com', 'Cursos virtuales');
					$mail->addReplyTo('cursos@developerplus.com', 'Cursos virtuales');
					$mail->Subject = "Por favor verifique su dirección de correo electrónico";
					$mail->addAddress($_POST["regEmail"]);
					$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
						<center>
							<img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">
						</center>
						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							<center>
								<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
								<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
								<hr style="border:1px solid #ccc; width:80%">
								<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>
								<a href="'.$urlFron.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">
									<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>
								</a>
								<br>
								<hr style="border:1px solid #ccc; width:80%">
								<h5 style="font-weight:100; color:#999">Si no se inscribiÃ³ en esta cuenta, puede ignorar este correo electrÃ³nico y la cuenta se eliminarÃ¡.</h5>
							</center>
						</div>
					</div>');

					$envio = $mail->Send();

					if (!$envio) {
						echo '<script>
								swal({
									  title:"¡ERROR!",
									  text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},
									function(isConfirm){
										if(isConfirm){
											history.back();
										}
									}
								);
							</script>';
					} else {
						
						echo '<script>
								swal({
									  title:"¡OK!",
									  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].' para verificar la cuenta!",
									  type: "success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},
									function(isConfirm){
										if(isConfirm){
											history.back();
										}
									}
								);
							</script>';
					}
				}

			} else {
				echo '<script>
					swal({
						  title:"¡ERROR!",
						  text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
						  type: "error",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						},
						function(isConfirm){
							if(isConfirm){
								history.back();
							}
						}
					);
				</script>';
			}
			
		}
	}

	static public function showUser($item, $valor)
	{
		$table = "users";
		$response = UserModel::showUser($table, $item, $valor);
		return $response;
	}

	static public function updateUser($id, $item, $valor)
	{
		$table = "users";
		$response = UserModel::updateUser($table, $id, $item, $valor);
		return $response;
	}

	public function loginUser()
	{
		if (isset($_POST["ingEmail"])) {
			if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "users";
				$item = "email";
				$valor = $_POST["ingEmail"];
				$respuesta = UserModel::showUser($tabla, $item, $valor);

				if ($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar) {
					
					if ($respuesta["verificacion"] == 1) {
						echo '<script>
								swal({
									  title:"¡ERROR!",
									  text: "¡Por favor revise la bandeja de entrada o spam, para verificar su correo electrónico '.$respuesta["email"].'!",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},
									function(isConfirm){
										if(isConfirm){
											history.back();
										}
									}
								);
							</script>';
					} else {
						$_SESSION["validarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["password"] = $respuesta["password"];
						$_SESSION["modo"] = $respuesta["modo"];

						echo '<script>
								window.location = localStorage.getItem("rutaActual");
						</script>';
					}

				} else {
					echo '<script>
						swal({
							  title:"¡ERROR AL INGRESAR!",
							  text: "¡Por favor revise que el email exista o la contraseña coincida con la registrada!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									window.location = localStorage.getItem("rutaActual");
								}
							}
						);
					</script>';
				}

			} else {
				echo '<script>
						swal({
							  title:"¡ERROR!",
							  text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							}
						);
					</script>';
			}
		}
	}

	public function forgetPassword()
	{
		if (isset($_POST["passEmail"])) {
			if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])) {
				
				function generarPassword($longitud){
					$key = "";
					$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
					$max = strlen($pattern) - 1;

					for ($i=0; $i < $longitud; $i++) { 
						$key .= $pattern{mt_rand(0, $max)};
					}

					return $key;
				}

				$nuevaPassword = generarPassword(11);
				$encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "users";
				$item1 = "email";
				$valor1 = $_POST["passEmail"];
				$respuesta1 = UserModel::showUser($tabla, $item1, $valor1);

				if ($respuesta1) {
					$id = $respuesta1["id"];
					$item2 = "password";
					$valor2 = $encriptar;

					$respuesta2 = UserModel::updateUser($tabla, $id, $item2, $valor2);

					if ($respuesta2 == "ok") {

						date_default_timezone_set("America/Lima");
						$urlFron = Route::urlFront();
						$mail = new PHPMailer;
						$mail->CharSet = 'UTF-8';
						$mail->isMail();
						$mail->setFrom('cursos@developerplus.com', 'Cursos virtuales');
						$mail->addReplyTo('cursos@developerplus.com', 'Cursos virtuales');
						$mail->Subject = "Solicitud de nueva contraseña";
						$mail->addAddress($_POST["passEmail"]);
						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
							<center>
								<img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">
							</center>
							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
								<center>
									<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">
									<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>
									<hr style="border:1px solid #ccc; width:80%">
									<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva Contraseña: </strong>'.$nuevaPassword.'</h4>
									<a href="'.$urlFron.'" target="_blank" style="text-decoration:none">
										<div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio</div>
									</a>
									<br>
									<hr style="border:1px solid #ccc; width:80%">
									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
								</center>
							</div>
						</div>');

						$envio = $mail->Send();

						if (!$envio) {
							echo '<script>
									swal({
										  title:"¡ERROR!",
										  text: "¡Ha ocurrido un problema enviando cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
										  type: "error",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										},
										function(isConfirm){
											if(isConfirm){
												history.back();
											}
										}
									);
								</script>';
						} else {
							
							echo '<script>
									swal({
										  title:"¡OK!",
										  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["passEmail"].' para su cambio de contraseña!",
										  type: "success",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										},
										function(isConfirm){
											if(isConfirm){
												history.back();
											}
										}
									);
								</script>';
						}
					}
				} else {
					echo '<script>
						swal({
							  title:"¡ERROR!",
							  text: "¡Error el correo electrónico no existe en el sistema!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							}
						);
					</script>';
				}
				

			} else {
				echo '<script>
						swal({
							  title:"¡ERROR!",
							  text: "¡Error al enviar el correo electrónico, está mal escrito!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							}
						);
					</script>';
			}
			
		}
	}

	static public function registerNetworkSocial($datos)
	{
		$table = "users";
		$item = "email";
		$valor = $datos["email"];
		$emailRepetido = false;

		$respuesta0 = UserModel::showUser($table, $item, $valor);

		if ($respuesta0) {
			if ($respuesta0["modo"] != $datos["modo"]) {
				echo '<script>
						swal({
							  title:"¡ERROR!",
							  text: "¡El correo electrónico '.$datos["email"].', ya está registrado en el sistema con un método diferente a Google!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							}
						);
					</script>';
				
				$emailRepetido = false;

				return;
			}

			$emailRepetido = true;

		} else {

			$response1 = UserModel::registerUser($table, $datos);

			/*=============================================
			ACTUALIZAR NOTIFICACIONES NUEVOS USUARIOS
			=============================================*/
			$traerNotificaciones = NotificationsController::showNotifications();

			$nuevoUsuario = $traerNotificaciones["nuevosUsuarios"] + 1;

			NotificationsModel::updateNotifications("notifications", "nuevosUsuarios", $nuevoUsuario);
		}
		
		if ($emailRepetido || $response1 == "ok") {

			$respuesta2 = UserModel::showUser($table, $item, $valor);

			if ($respuesta2["modo"] == "facebook") {
				session_start();// si necesitamos session_start() por que estamos traendo desde javascript
				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $respuesta2["id"];
				$_SESSION["nombre"] = $respuesta2["nombre"];
				$_SESSION["foto"] = $respuesta2["foto"];
				$_SESSION["email"] = $respuesta2["email"];
				$_SESSION["password"] = $respuesta2["password"];
				$_SESSION["modo"] = $respuesta2["modo"];

				echo "ok";

			} else if ($respuesta2["modo"] == "google") {
				// no necesitamos session_start() por que lo estamos haciendo desde php
				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $respuesta2["id"];
				$_SESSION["nombre"] = $respuesta2["nombre"];
				$_SESSION["foto"] = $respuesta2["foto"];
				$_SESSION["email"] = $respuesta2["email"];
				$_SESSION["password"] = $respuesta2["password"];
				$_SESSION["modo"] = $respuesta2["modo"];

				echo "<span style='display:none'>ok</span>";

			} else {
				
				echo "";
			}
		}

	}

	public function updatePerfil()
	{
		if (isset($_POST["editarNombre"])) {
			//calidar imagen
			$ruta = "";
			if (isset(($_FILES["datosImagen"]["tmp_name"]))) {
				//si existe una imagen en la BD
				$directorio = "views/img/usuarios/".$_POST["idUsuario"];
				if (!empty($_POST["fotoUsuario"])) {
					unlink($_POST["fotoUsuario"]);// borra un fichero
				}else{
					mkdir($directorio, 0755);//crear carpeta con permisos de escritura y lectura
				}
				//Guardamos la imagen en el directorio
				//produce números aleatorios cuatro veces más rápido que el promedio proporcionado por la libc rand().
				$aleatorio = mt_rand(100, 999);
				$ruta = "views/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".jpg";

				//Modificamos tamaño de la foto
				/*$info = array('café', 'marrón', 'cafeína');
				// Enumerar todas las variables
				list($bebida, $color, $energía) = $info;
				echo "El $bebida es $color y la $energía lo hace especial.\n";*/
				list($ancho, $alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]); //Obtener el tamaño de una imagen
				$nuevoAncho = 500;
				$nuevoAlto = 500;
				//Crea una nueva imagen a partir de un fichero o de una URL
				$origen = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);
				//Crear una nueva imagen de color verdadero
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				//Copia y cambia el tamaño de parte de una imagen copia una porción de una imagen a otra imagen, devuelve true
				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				//imprimir la imagen
				imagejpeg($destino, $ruta);

			}
			if ($_POST["editarPassword"] == "") {
				$password = $_POST["passUsuario"];
			} else {
				$password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			}

			$datos = array("nombre" => $_POST["editarNombre"],
							"email" => $_POST["editarEmail"],
							"password" => $password,
							"foto" => $ruta,
							"id" => $_POST["idUsuario"]);
			$tabla = "users";
			$respuesta = UserModel::updatePerfil($tabla, $datos);

			if ($respuesta == "ok") {

				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $datos["id"];
				$_SESSION["nombre"] = $datos["nombre"];
				$_SESSION["foto"] = $datos["foto"];
				$_SESSION["email"] = $datos["email"];
				$_SESSION["password"] = $datos["password"];
				$_SESSION["modo"] = $_POST["modoUsuario"];

				echo '<script>
						swal({
							  title:"¡OK!",
							  text: "¡Su cuenta ha sido actualizada correctamente!",
							  type: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							}
						);
					</script>';
			}
			
		}
	}

	static public function showShopping($item, $valor)
	{
		$table = "shopping";
		$response = UserModel::showShopping($table, $item, $valor);
		return $response;
	}

	static public function showCommentsProfile($data)
	{
		$table = "comments";
		$response = UserModel::showCommentsProfile($table, $data);
		return $response;
	}

	public function updateCommentary()
	{
		if (isset($_POST["idComentario"])) {
			//Realiza una comparación con una expresión regular
			//preg_match() devuelve 1 si pattern coincide con el subject dado, 0 si no, o FALSE si ocurrió un error.
			if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["comentario"])) {
				if ($_POST["comentario"] != "") {
					$tabla = "comments";
					$datos = array("id" => $_POST["idComentario"],
									"calificacion" => $_POST["puntaje"],
									"comentario" => $_POST["comentario"]);
					$respuesta = UserModel::updateCommentary($tabla, $datos);
					if ($respuesta == "ok") {
						echo '<script>
								swal({
									  title:"¡GRACIAS POR COMPARTIR SU OPINIÓN!",
									  text: "¡Su calificación y opinión ha sido guardado!",
									  type: "success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},
									function(isConfirm){
										if(isConfirm){
											history.back();
										}
									}
								);
							</script>';
					}
				} else {
					echo '<script>
						swal({
							  title:"¡ERROR AL ENVIAR SU CALIFICACIÓN!",
							  text: "¡El comentario no puede estar vacio!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							}
						);
					</script>';
				}
				
			} else {
				echo '<script>
						swal({
							  title:"¡ERROR AL ENVIAR SU CALIFICACIÓN!",
							  text: "¡El comentario no puede llevar caracteres especiales!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							}
						);
					</script>';
			}
			
		}
	}

	static public function addWish($data)
	{
		$table = "wishes";
		$response = UserModel::addWish($table, $data);

		return $response;
	}

	static public function showWishes($item)
	{
		$table = "wishes";
		$response = UserModel::showWishes($table, $item);

		return $response;
	}

	static public function removeWish($data)
	{
		$table = "wishes";
		$response = UserModel::removeWish($table, $data);

		return $response;
	}

	static public function deleteUser()
	{
		if (isset($_GET["id"])) {
			$table1 = "users";
			$table2 = "comments";
			$table3 = "shopping";
			$table4 = "wishes";		

			$id = $_GET["id"];

			if ($_GET["foto"] != "") {
				unlink($_GET["foto"]); // elimina la foto
				rmdir('views/img/usuarios/'.$_GET["id"]); //elimina la carpeta
			}

			$response = UserModel::deleteUser($table1, $id);
			UserModel::deleteComments($table2, $id);
			UserModel::deleteShopping($table3, $id);
			UserModel::deleteListWishes($table4, $id);

			if ($response == "ok") {
				$urlFron = Route::urlFront();
				echo '<script>
						swal({
							  title:"¡SU CUENTA HA SIDO BORRADA!",
							  text: "¡Debe registrarse nuevamente si desea ingresar!",
							  type: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									window.location = "'.$urlFron.'salir";
								}
							}
						);
					</script>';
			}
		}
	}

	public function formContact()
	{
		if (isset($_POST["mensajeContactenos"])) {

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreContactenos"]) &&
			preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["mensajeContactenos"]) &&
			preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailContactenos"])){

				date_default_timezone_set("America/Lima");
				$urlFron = Route::urlFront();
				$mail = new PHPMailer;
				$mail->CharSet = 'UTF-8';
				$mail->isMail();
				$mail->setFrom('cursos@developerplus.com', 'Cursos virtuales');
				$mail->addReplyTo('cursos@developerplus.com', 'Cursos virtuales');
				$mail->Subject = "Ha recibido una consulta";
				$mail->addAddress("contacto@tiendaenlinea.com");
				
				$mail->msgHTML('

						<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

						<center><img style="padding:20px; width:10%" src="http://www.tutorialesatualcance.com/tienda/logo.png"></center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding-bottom:20px">

							<center>

							<img style="padding-top:20px; width:15%" src="http://www.tutorialesatualcance.com/tienda/icon-email.png">


							<h3 style="font-weight:100; color:#999;">HA RECIBIDO UNA CONSULTA</h3>

							<hr style="width:80%; border:1px solid #ccc">

							<h4 style="font-weight:100; color:#999; padding:0px 20px; text-transform:uppercase">'.$_POST["nombreContactenos"].'</h4>

							<h4 style="font-weight:100; color:#999; padding:0px 20px;">De: '.$_POST["emailContactenos"].'</h4>

							<h4 style="font-weight:100; color:#999; padding:0px 20px">'.$_POST["mensajeContactenos"].'</h4>

							<hr style="width:80%; border:1px solid #ccc">

							</center>

						</div>

					</div>');

				$envio = $mail->Send();

				if (!$envio) {
					echo '<script>
							swal({
								  title:"¡ERROR!",
								  text: "¡Ha ocurrido un problema enviando el mensaje",
								  type: "error",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},
								function(isConfirm){
									if(isConfirm){
										history.back();
									}
								}
							);
						</script>';
				} else {
					
					echo '<script>
							swal({
								  title:"¡OK!",
								  text: "¡Su mensaje ha sido enviado, muy pronto le responderemos!",
								  type: "success",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},
								function(isConfirm){
									if(isConfirm){
										history.back();
									}
								}
							);
						</script>';
				}

			}else{

            	echo '<script> 
						swal({
						  title: "¡OK!",
						  text: "¡Su mensaje ha sido enviado, muy pronto le responderemos!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						},
						function(isConfirm){
								 if (isConfirm) {	  
										history.back();
									}
						});
					</script>';
			}

		}
	}	
}
?>