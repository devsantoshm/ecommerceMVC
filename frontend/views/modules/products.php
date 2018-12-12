<?php 
$urlBack = Route::routeServer(); 
$urlFron = Route::urlFront();
$ruta = $rutas[0];
$banner = ProductController::showBanner($ruta);

date_default_timezone_set('America/Lima');

$fecha = date('Y-m-d');
$hora = date('H:i:s');

$fechaActual = $fecha.' '.$hora;

if($banner != null){ 
	if ($banner["estado"] != 0) {
		echo '<figure class="banner">
			<img src="'.$urlBack.$banner["img"].'" class="img-responsive" width="100%">';
			if ($banner["ruta"] != "sin-categoria") {
				
				/*=============================================
				BANNER PARA CATEGORÍAS
				=============================================*/
				if($banner["tipo"] == "categorias"){

					$item = "ruta";
					$valor = $banner["ruta"];

					$ofertas = ProductController::showCategories($item, $valor);

					if($ofertas["oferta"] == 1){

						echo '<div class="textoBanner textoIzq">
							<h1 style="color:#fff" class="text-uppercase">'.$ofertas["categoria"].'</h1>
						</div>

						<div class="textoBanner textoDer">
							<h1 style="color:#fff">OFERTAS ESPECIALES</h1>';

							if($ofertas["precioOferta"] != 0){
								
								echo '<h2 style="color:#fff"><strong>Todos los productos a $ '.$ofertas["precioOferta"].'</strong></h2>';

							}

							if($ofertas["descuentoOferta"] != 0){
							
								echo '<h2 style="color:#fff"><strong>Todos los productos con '.$ofertas["descuentoOferta"].'% OFF</strong></h2>';
							}

						echo '<h3 class="col-md-0 col-sm-0 col-xs-0" style="color:#fff">
							
							La oferta termina en<br>

							<div class="countdown2" finOferta="'.$ofertas["finOferta"].'">

						</h3>';

						$datetime1 = new DateTime($ofertas["finOferta"]);
						$datetime2 = new DateTime($fechaActual);

						$interval = date_diff($datetime1, $datetime2);

						$finOferta = $interval->format('%a');

						if($finOferta == 0){

							echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina hoy</h3>';

						}else if($finOferta == 1){
	
							echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' día</h3>';
	
						}else{
	
							echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' días</h3>';
	
						}

						echo '</div>';
					}
				}

				/*=============================================
				BANNER PARA SUBCATEGORÍAS
				=============================================*/

				if($banner["tipo"] == "subcategorias"){

					$item = "ruta";
					$valor = $banner["ruta"];

					$ofertas = ProductController::showSubCategories($item, $valor);

					if($ofertas[0]["oferta"] == 1){

						echo '<div class="textoBanner textoIzq">

							<h1 style="color:#fff" class="text-uppercase">'.$ofertas[0]["subcategoria"].'</h1>

						</div>

						<div class="textoBanner textoDer">
						
							<h1 style="color:#fff">OFERTAS ESPECIALES</h1>';

							if($ofertas[0]["precioOferta"] != 0){
								
								echo '<h2 style="color:#fff"><strong>Todos los productos a $ '.$ofertas[0]["precioOferta"].'</strong></h2>';

							}

							if($ofertas[0]["descuentoOferta"] != 0){
							
								echo '<h2 style="color:#fff"><strong>Todos los productos con '.$ofertas[0]["descuentoOferta"].'% OFF</strong></h2>';
							}

						echo '<h3 class="col-md-0 col-sm-0 col-xs-0" style="color:#fff">
							
							La oferta termina en<br>

							<div class="countdown2" finOferta="'.$ofertas[0]["finOferta"].'">

						</h3>';

						$datetime1 = new DateTime($ofertas[0]["finOferta"]);
						$datetime2 = new DateTime($fechaActual);

						$interval = date_diff($datetime1, $datetime2);

						$finOferta = $interval->format('%a');

						if($finOferta == 0){

							echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina hoy</h3>';

						}else if($finOferta == 1){
	
							echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' día</h3>';
	
						}else{
	
							echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' días</h3>';
	
						}

						echo '</div>';

					}
					
				}
			}

		echo '</figure>';
	}
}
?>
<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<div class="btn-group">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ordenar Productos <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $urlFron.$rutas[0].'/1/recientes'; ?>">Más reciente</a></li>
							<li><a href="<?php echo $urlFron.$rutas[0].'/1/antiguos'; ?>">Más antiguo</a></li>
					  	</ul>
				</div>	
			</div>
			<div class="col-sm-6 col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-default btnGrid" id="btnGrid0">
						<!-- col-xs-0 se ocultarar en los dispositivos pequeños -->
						<i class="fa fa-th" aria-hidden="true"></i><span class="col-xs-0"> GRID</span>
					</button>
					<button type="button" class="btn btn-default btnList" id="btnList0">
						<!-- col-xs-0 se ocultarar en los dispositivos pequeños -->
						<i class="fa fa-list" aria-hidden="true"></i><span class="col-xs-0"> LIST</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid productos">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb text-uppercase fondoBreadcrumb">
				<li><a href="<?php echo $urlFron ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>
			</ul>
			<?php  
			//var_dump($rutas[1]);
			if (isset($rutas[1])) {
				//$_SESSION["ordenar"] = "DESC";
				if (isset($rutas[2])) {
					if ($rutas[2] == "antiguos") {
						$modo = "ASC";
						$_SESSION["ordenar"] = $modo;
					} else {
						$modo = "DESC";
						$_SESSION["ordenar"] = $modo;
					}
				} else {
					if(isset($_SESSION["ordenar"]))
						$modo = $_SESSION["ordenar"];
					else
						$modo = "DESC";
				}
				
				if (is_numeric($rutas[1])) {
					$base = ($rutas[1] - 1)*12;
					$tope = 12;	
				}else{
					$rutas[1] = 1;
					$base = 0;
					$tope = 12;
					$modo = "DESC";
					$_SESSION["ordenar"] = "DESC";
				}
			} else {
				$rutas[1] = 1;
				$base = 0;
				$tope = 12;
				$modo = "DESC";
				$_SESSION["ordenar"] = "DESC";
			}
			
			if ($rutas[0] == "articulos-gratis") {
				$item2 = "precio";
				$valor2 = 0;
				$ordenar = "id";
			}else if ($rutas[0] == "lo-mas-vendido") {
				$item2 = null;
				$valor2 = null;
				$ordenar = "ventas";
			}else if ($rutas[0] == "lo-mas-visto") {
				$item2 = null;
				$valor2 = null;
				$ordenar = "vistas";
			}else{
				$ordenar = 'id';
				$item = "ruta";
				$valor = $rutas[0];

				$category = ProductController::showCategories($item, $valor);
				//var_dump($category['id']); // trae un fetch
				if(!$category){
					$subCategory = ProductController::showSubCategories($item, $valor); //trae un fetchAll $subcategory[0]['id']
					$item2 = 'id_subcategoria';
					$valor2 = $subCategory[0]['id'];
				}else{
					$item2 = 'id_categoria';
					$valor2 = $category['id']; 
				}
			}
			//$modo = "ASC";
			$products = ProductController::showProducts($ordenar, $item2, $valor2, $base, $tope, $modo);
			$listProducts = ProductController::listProducts($ordenar, $item2, $valor2);

			if(!$products){
				echo '<div class="col-xs-12 text-center error404">
						<h1><small>¡Oops!</small></h1>
						<h2>Aún no hay productos en esta sección</h2>
					</div>';
			}else{ ?>
				<ul class="grid0">
					<!-- col-lg-3 no se pone por que el col-md-3 lo reemplaza -->
					<?php foreach ($products as $key => $value) { 
						if ($value['estado'] != 0) { ?>
						<li class="col-md-3 col-sm-6 col-xs-12">
							<figure>
								<a href="<?php echo $urlFron.$value['ruta'] ?>" class="pixelProducto">
									<img src="<?php echo $urlBack.$value['portada']; ?>" class="img-responsive">
								</a>	
							</figure>
							<?php echo $value['id'] ?>
							<h4><small>
								<a href="<?php echo $urlFron.$value['ruta'] ?>" class="pixelProducto"><?php echo $value['titulo'] ?>
									<br><span style="color: rgba(0,0,0,0);">-</span>
									<?php 
										$fecha = date('Y-m-d');
										$fechaActual = strtotime('-30 day', strtotime($fecha));
										$fechaNueva = date('Y-m-d', $fechaActual);

										if($fechaNueva < $value['fecha'])
											echo '<span class="label label-warning fontSize">Nuevo</span> ';
										if($value['oferta'] != 0 && $value['precio'] != 0)
										  	echo '<span class="label label-warning fontSize">'.$value["descuentoOferta"].'% off</span>';
									?>
								</a>
							</small></h4>
							<div class="col-xs-6 precio">
								<?php 
									if($value['precio'] == 0)
										echo '<h2><small>GRATIS</small></h2>';
									else{
										if($value['oferta'] != 0){
											echo '<h2>
													<small><strong class="oferta">USD $'.$value["precio"].'</strong></small>
													<small>$'.$value["precioOferta"].'</small>
												 </h2>';
										}else{
											echo '<h2><small>USD $'.$value['precio'].'</small></h2>';
										}
									}
								?>
							</div>
							<div class="col-xs-6 enlaces">
								<div class="btn-group pull-right">
									<button type="button" class="btn btn-default btn-xs deseos" idProductos="<?php echo $value['id'] ?>" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
									<?php 
										if ($value['tipo'] == 'virtual' && $value['precio'] != 0) {
											if ($value['oferta'] != 0) {
												echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$urlBack.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
														<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													</button>';
											} else {
												echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$urlBack.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
														<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													</button>';
											}
										}	
									?>
									<a href="<?php echo $urlFron.$value['ruta'] ?>" class="pixelProducto">
										<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
									</a>
								</div>
							</div>
						</li>
					<?php } } ?>
				</ul>
				<ul class="list0" style="display: none;">
					<!-- con solo poner col-xs-12 ya afecta al resto de pantallas-->
					<?php foreach ($products as $key => $value) {
						if ($value['estado'] != 0) { ?>
						<li class="col-xs-12">
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
								<figure>
									<a href="<?php echo $urlFron.$value['ruta'] ?>" class="pixelProducto"><img src="<?php echo $urlBack.$value['portada']; ?>" class="img-responsive"></a>
								</figure>
							</div>
							<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
								<h1><small>
									<a href="<?php echo $urlFron.$value['ruta'] ?>" class="pixelProducto">
										<?php 
											echo $value['titulo'].'<br>';
											$fecha = date('Y-m-d');
											$fechaActual = strtotime('-30 day', strtotime($fecha));
											$fechaNueva = date('Y-m-d', $fechaActual);

											if($fechaNueva < $value['fecha'])
												echo '<span class="label label-warning">Nuevo</span> ';
											if($value['oferta'] != 0 && $value['precio'] != 0)
											  	echo '<span class="label label-warning">'.$value["descuentoOferta"].'% off</span>';
										?>
									</a>
								</small></h1>
								<p class="text-muted"><?php echo $value['titular'] ?></p>
								<?php 
									if($value['precio'] == 0)
										echo '<h2><small>GRATIS</small></h2>';
									else{
										if($value['oferta'] != 0){
											echo '<h2>
													<small><strong class="oferta">USD $'.$value["precio"].'</strong></small>
													<small>$'.$value["precioOferta"].'</small>
												 </h2>';
										}else{
											echo '<h2><small>USD $'.$value['precio'].'</small></h2>';
										}
									}
								?>
								<div class="btn-group pull-left enlaces">
									<button type="button" class="btn btn-default btn-xs deseos" idProductos="<?php echo $value['id'] ?>" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
									<?php 
										if ($value['tipo'] == 'virtual' && $value['precio'] != 0) {
											if ($value['oferta'] != 0) {
												echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$urlBack.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
														<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													</button>';
											} else {
												echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$urlBack.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
														<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													</button>';
											}
										}	
									?>
									<a href="<?php echo $urlFron.$value['ruta'] ?>" class="pixelProducto">
										<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
									</a>
								</div>
							</div>
							<div class="col-xs-12"><hr></div>
						</li>
					<?php } } ?>
				</ul>
			<?php } ?>
			<!-- clearfix, permite formatear el float left y mantener la paginacion centrada -->
			<div class="clearfix"></div>
			<center>
			<?php 
			if (count($listProducts) != 0) {
				$pagProducts = ceil(count($listProducts)/12); //redondea de 23.333 a 24 páginas
				if ($pagProducts > 6) {
					if($rutas[1] == 1){
						echo '<ul class="pagination">';
						for ($i=1; $i <= 4; $i++) { 
							echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'">'.$i.'</a></li>';
						}
						echo '<li class="disabled"><a>...</a></li>
							  <li id="item'.$pagProducts.'"><a href="'.$urlFron.$rutas[0].'/'.$pagProducts.'">'.$pagProducts.'</a></li>
							  <li><a href="'.$urlFron.$rutas[0].'/2"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
							</ul>';
					} else if($rutas[1] == $pagProducts){
						echo '<ul class="pagination">
								<li><a href="'.$urlFron.$rutas[0].'/'.($pagProducts-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
								<li id="item1"><a href="'.$urlFron.$rutas[0].'/1">1</a></li>
								<li class="disabled"><a>...</a></li>';
						for ($i=($pagProducts-3); $i <= $pagProducts; $i++) { 
							echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'">'.$i.'</a></li>';
						}
						echo '</ul>';
					} else if($rutas[1] != $pagProducts && $rutas[1] != 1 
							  && $rutas[1] < ($pagProducts/2) && $rutas[1] < ($pagProducts-3)){
						
						$numPagActual = $rutas[1];

						echo '<ul class="pagination">
								<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>';
						for ($i=$numPagActual; $i <= ($numPagActual+3); $i++) { 
							echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'">'.$i.'</a></li>';
						}
						echo '<li class="disabled"><a>...</a></li>
							  <li id="item'.$pagProducts.'"><a href="'.$urlFron.$rutas[0].'/'.$pagProducts.'">'.$pagProducts.'</a></li>
							  <li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
							</ul>';
					} else if($rutas[1] != $pagProducts && $rutas[1] != 1 
							  && $rutas[1] >= ($pagProducts/2) && $rutas[1] < ($pagProducts-3)){
						
						$numPagActual = $rutas[1];

						echo '<ul class="pagination">
								<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
								<li id="item1"><a href="'.$urlFron.$rutas[0].'/1">1</a></li>
								<li class="disabled"><a>...</a></li>';
						for ($i=$numPagActual; $i <= ($numPagActual+3); $i++) { 
							echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'">'.$i.'</a></li>';
						}
						echo '<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
							</ul>';
					} else {
						
						$numPagActual = $rutas[1];

						echo '<ul class="pagination">
								<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
								<li id="item1"><a href="'.$urlFron.$rutas[0].'/1">1</a></li>
								<li class="disabled"><a>...</a></li>';
						for ($i=($pagProducts-3); $i <= $pagProducts; $i++) { 
							echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'">'.$i.'</a></li>';
						}
						echo '</ul>';
					}
				} else {
					echo '<ul class="pagination">';
					for ($i=1; $i <= $pagProducts; $i++) { 
						echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'">'.$i.'</a></li>';
					}
					echo '</ul>';
				}		
			}
			?>
			</center>
		</div>
	</div>
</div>
