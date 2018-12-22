<?php  

class ManagersController
{
	public function loginManager()
	{
		if (isset($_POST["ingEmail"])) {
			if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {
				//$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$table = "managers";
				$item = "email";
				$valor = $_POST["ingEmail"];

				$respuesta = ManagersModel::loginManager($table, $item, $valor);

				if ($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $_POST["ingPassword"]) {

					if ($respuesta["estado"] == 1) {
						
					
						$_SESSION["validarSesionBackend"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["password"] = $respuesta["password"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						echo '<script>
								window.location = "inicio";
							</script>';

					} else {

						echo '<br>
						<div class="alert alert-warning">Este usuario aún no está activado</div>';

					}

				} else {

					echo '<br>
						<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
				}
				
			}
		}
	}

	/*=============================================
	MOSTRAR ADMINISTRADORES
	=============================================*/
	static public function showManagers($item, $valor){

		$tabla = "managers";

		$respuesta = ManagersModel::loginManager($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	REGISTRO DE PERFIL
	=============================================*/
	static public function createProfile(){

		if(isset($_POST["nuevoPerfil"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/
				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/perfiles/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/perfiles/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "managers";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "email" => $_POST["nuevoEmail"],
					           "password" => $encriptar,
					           "perfil" => $_POST["nuevoPerfil"],			       
					           "foto"=>$ruta,
					           "estado" => 1);

				$respuesta = ManagersModel::createProfile($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El perfil ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "perfiles";

						}

					});
				

					</script>';

				}	

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El perfil no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "perfiles";

						}

					});
				

				</script>';

			}

		}

	}

}

?>