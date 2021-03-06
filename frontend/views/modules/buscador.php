<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<div class="btn-group">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ordenar Productos <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $urlFron.$rutas[0].'/1/recientes/'.$rutas[3]; ?>">Más reciente</a></li>
							<li><a href="<?php echo $urlFron.$rutas[0].'/1/antiguos/'.$rutas[3]; ?>">Más antiguo</a></li>
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

			$products = null;
			$listProducts = null;
			$estado = 1;
			$ordenar = "id";

			if (isset($rutas[3])) {
				$busqueda = $rutas[3];
				$products = ProductController::searchProducts($busqueda, $ordenar, $modo, $base, $tope);
				$listProducts = ProductController::listProductsSearch($busqueda);
			}

			if(!$products){
				$estado = null;
				echo '<div class="col-xs-12 text-center error404">
						<h1><small>¡Oops!</small></h1>
						<h2>Aún no hay productos en esta sección</h2>
					</div>';
			}else{ ?>
				<ul class="grid0">
					<!-- col-lg-3 no se pone por que el col-md-3 lo reemplaza -->
					<?php foreach ($products as $key => $value) { 
						if ($value["estado"] != 0) {	
						?>
					<li class="col-md-3 col-sm-6 col-xs-12">
						<figure>
							<a href="<?php echo $value['ruta'] ?>" class="pixelProducto">
								<img src="<?php echo $urlBack.$value['portada']; ?>" class="img-responsive">
							</a>	
						</figure>
						<?php echo $value['id'] ?>
						<h4><small>
							<a href="<?php echo $value['ruta'] ?>" class="pixelProducto"><?php echo $value['titulo'] ?>
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
								<a href="<?php echo $value['ruta'] ?>" class="pixelProducto">
									<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
								</a>
							</div>
						</div>
					</li>
					<?php }else{
							$estado = 0;
						} 
					} 

					if ($estado == 0) {
						echo '<div class="col-xs-12 text-center error404">
							<h1><small>¡Oops!</small></h1>
							<h2>Aún no hay productos en esta sección</h2>
						</div>';
					}
					?>
				</ul>
				<ul class="list0" style="display: none;">
					<!-- con solo poner col-xs-12 ya afecta al resto de pantallas-->
					<?php foreach ($products as $key => $value) { 
						if ($value["estado"] != 0) { ?>
					<li class="col-xs-12">
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<figure>
								<a href="<?php echo $value['ruta'] ?>" class="pixelProducto"><img src="<?php echo $urlBack.$value['portada']; ?>" class="img-responsive"></a>
							</figure>
						</div>
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							<h1><small>
								<a href="<?php echo $value['ruta'] ?>" class="pixelProducto">
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
								<a href="<?php echo $value['ruta'] ?>" class="pixelProducto">
									<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
								</a>
							</div>
						</div>
						<div class="col-xs-12"><hr></div>
					</li>
					<?php }else{
							$estado = 0;
						} 
					} 

					if ($estado == 0) {
						echo '<div class="col-xs-12 text-center error404">
							<h1><small>¡Oops!</small></h1>
							<h2>Aún no hay productos en esta sección</h2>
						</div>';
					}
					?>
				</ul>
			<?php } ?>
			<!-- clearfix, permite formatear el float left y mantener la paginacion centrada -->
			<div class="clearfix"></div>
			<center>
			<?php 
			if ($estado != 0) {
	
				if (count($listProducts) != 0) {
					$pagProducts = ceil(count($listProducts)/12); //redondea de 23.333 a 24 páginas
					if ($pagProducts > 6) {
						if($rutas[1] == 1){
							echo '<ul class="pagination">';
							for ($i=1; $i <= 4; $i++) { 
								echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							}
							echo '<li class="disabled"><a>...</a></li>
								  <li id="item'.$pagProducts.'"><a href="'.$urlFron.$rutas[0].'/'.$pagProducts.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProducts.'</a></li>
								  <li><a href="'.$urlFron.$rutas[0].'/2/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
								</ul>';
						} else if($rutas[1] == $pagProducts){
							echo '<ul class="pagination">
									<li><a href="'.$urlFron.$rutas[0].'/'.($pagProducts-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
									<li id="item1"><a href="'.$urlFron.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
									<li class="disabled"><a>...</a></li>';
							for ($i=($pagProducts-3); $i <= $pagProducts; $i++) { 
								echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							}
							echo '</ul>';
						} else if($rutas[1] != $pagProducts && $rutas[1] != 1 
								  && $rutas[1] < ($pagProducts/2) && $rutas[1] < ($pagProducts-3)){
							
							$numPagActual = $rutas[1];

							echo '<ul class="pagination">
									<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>';
							for ($i=$numPagActual; $i <= ($numPagActual+3); $i++) { 
								echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							}
							echo '<li class="disabled"><a>...</a></li>
								  <li id="item'.$pagProducts.'"><a href="'.$urlFron.$rutas[0].'/'.$pagProducts.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProducts.'</a></li>
								  <li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
								</ul>';
						} else if($rutas[1] != $pagProducts && $rutas[1] != 1 
								  && $rutas[1] >= ($pagProducts/2) && $rutas[1] < ($pagProducts-3)){
							
							$numPagActual = $rutas[1];

							echo '<ul class="pagination">
									<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
									<li id="item1"><a href="'.$urlFron.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
									<li class="disabled"><a>...</a></li>';
							for ($i=$numPagActual; $i <= ($numPagActual+3); $i++) { 
								echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							}
							echo '<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
								</ul>';
						} else {
							
							$numPagActual = $rutas[1];

							echo '<ul class="pagination">
									<li><a href="'.$urlFron.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
									<li id="item1"><a href="'.$urlFron.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
									<li class="disabled"><a>...</a></li>';
							for ($i=($pagProducts-3); $i <= $pagProducts; $i++) { 
								echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							}
							echo '</ul>';
						}
					} else {
						echo '<ul class="pagination">';
						for ($i=1; $i <= $pagProducts; $i++) { 
							echo '<li id="item'.$i.'"><a href="'.$urlFron.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
						}
						echo '</ul>';
					}		
				}
			}
			?>
			</center>
		</div>
	</div>
</div>