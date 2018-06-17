<footer class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-6 col-xs-12 footerCategorias">
				<?php
				$urlFron = Route::urlFront();  
				$item = null;
				$valor = null;

				$categorias = ProductController::showCategories($item, $valor);

				foreach ($categorias as $key => $value) {
					echo '<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12">
							<h4><a href="'.$urlFron.$value["ruta"].'" class="pixelCategorias" titulo="'.$value["categoria"].'">'.$value["categoria"].'</a></h4>
							<hr>

							<ul>';

							$item = 'id_categoria';
							$valor = $value["id"];

							$subcategories = ProductController::showSubCategories($item, $valor); 
							foreach ($subcategories as $key => $value) {
								echo '<li><a href="'.$urlFron.$value["ruta"].'" class="pixelSubCategorias" titulo="'.$value["subcategoria"].'">'.$value["subcategoria"].'</a></li>';
							}
							echo '</ul>
						</div>';
				}
				?>
			</div>
			<!-- DATOS CONTACTO -->
			<div class="col-md-3 col-sm-6 col-xs-12 text-left infoContacto">
				<h5>Dudas e inquietudes, contáctenos en:</h5>
				<br>
				<h5>
					<i class="fa fa-phone-square" aria-hidden="true"></i> (555) 555-55-55
					<br><br>
					<i class="fa fa-envelope" aria-hidden="true"></i> soporte@tiendavirtual.com
					<br><br>
					<i class="fa fa-map-marker" aria-hidden="true"></i> Calle 45F B2 - 31 Local 102
					<br><br>
					Arequipa | Perú
				</h5>

				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.9882162702393!2d-71.53662228583514!3d-16.425419143165264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91424ae0be6a9fe1%3A0x9c27a62f97b53444!2sAv.+Andr%C3%A9s+Avelino+C%C3%A1ceres%2C+Jos%C3%A9+Luis+Bustamante+y+Rivero!5e0!3m2!1ses!2spe!4v1529189967694" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
				
			</div>

			<!-- FORMULARIO CONTACTO -->
			<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 formContacto">
				<h4>RESUELVA SU INQUIETUD</h4>
				<form role="form" method="POST">
					<input type="text" name="nombreContactenos" id="nombreContactenos" class="form-control" placeholder="Escriba su nombre" required>
					<br>
					<input type="email" name="emailContactenos" id="emailContactenos" class="form-control" placeholder="Escriba su correo electrónico" required>
					<br>
					<textarea type="text" name="mensajeContactenos" id="mensajeContactenos" class="form-control" placeholder="Escriba su mensaje" rows="5" required></textarea>
					<br>
					<input type="submit" value="Enviar" class="btn btn-default backColor pull-right" id="Enviar">
				</form>
			</div>
		</div>
	</div>	
</footer>
<div class="container-fluid final">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xs-12 text-left text-muted">
				<h5>&copy; 2017 Todos los derechos reservados. Sitio elaborado por las compañia</h5>
			</div>
			<div class="col-sm-6 col-xs-12 text-right social">
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
		</div>
	</div>
</div>