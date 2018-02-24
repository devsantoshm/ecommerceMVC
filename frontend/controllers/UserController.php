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
								"modo" => "directo",
								"verificacion" => 1,
								"emailEncriptado" => $encriptarEmail
						);

				$tabla = "users";
				$respuesta = UserModel::registerUser($tabla, $datos);

				if ($respuesta == "ok") {
					//Verificación correo electrónico
					date_default_timezone_set("America/Lima");
					$urlFron = Route::urlFront();
					$mail = new PHPMailer;
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
}

?>