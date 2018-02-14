<?php 
$urlBack = Route::routeServer();  
$urlFron = Route::urlFront();
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
					<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
					<li>|</li>
					<li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>
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
						<a href="<?php echo $urlFron ?>buscador">
							<button class="btn btn-default backColor" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</a>
					</span>	
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
				<a href="#">
					<button class="btn btn-default pull-left backColor">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</button>
				</a>
				<p>TU CESTA <span class="cantidadCesta">3</span><br>USD$<span class="sumaCesta"> 20</span></p>
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
					<a href="<?php echo $urlFron.$cat["ruta"] ?>" class="pixelCategorias"><?php echo $cat["categoria"] ?></a>
				</h4>
				<hr>
				<ul>

					<?php
					$item = 'id_categoria';
					$valor = $cat["id"];
					$subcategories = ProductController::showSubCategories($item, $valor); 
					foreach ($subcategories as $subcat) {
					?>
					<li><a href="<?php echo $urlFron.$subcat["ruta"] ?>" class="pixelSubCategorias"><?php echo $subcat["subcategoria"] ?></a></li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
		</div>
	</div>
</header>