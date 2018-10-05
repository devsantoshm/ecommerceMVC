<?php 
	$urlBack = Route::routeServer(); 
	$ruta = "sin-categoria";
	$banner = ProductController::showBanner($ruta);

	$titulo1 = json_decode($banner["titulo1"], true);
	$titulo2 = json_decode($banner["titulo2"], true);
	$titulo3 = json_decode($banner["titulo3"], true);
?>
<figure class="banner">
	<img src="<?php echo $urlBack.$banner['img'] ?>" class="img-responsive" width="100%">
	<div class="textoBanner <?php echo $banner['estilo'] ?>">
		<h1 style="color:<?php echo $titulo1['color'] ?>"><?php echo $titulo1['texto'] ?></h1>
		<h2 style="color:<?php echo $titulo2['color'] ?>"><strong><?php echo $titulo2['texto'] ?></strong></h2>
		<h3 style="color:<?php echo $titulo3['color'] ?>"><?php echo $titulo3['texto'] ?></h3>
	</div>
</figure>
<?php 
	$titulosModulos = array("ARTÍCULOS GRATUITOS", "LO MÁS VENDIDO", "LO MÁS VISTO");
	$rutaModulos = array("articulos-gratis", "lo-mas-vendido", "lo-mas-visto");
	$base = 0; 
	$tope = 4;

	if ($titulosModulos[0] == "ARTÍCULOS GRATUITOS") {
		$ordenar = "id";
		$item = "precio";
		$valor = 0;
		$modo = "DESC";
		$gratis = ProductController::showProducts($ordenar, $item, $valor, $base, $tope, $modo);
	}

	if ($titulosModulos[1] == "LO MÁS VENDIDO") {
		$ordenar = "ventas";
		$item = "estado";
		$valor = 1;
		$modo = "DESC";
		$ventas = ProductController::showProducts($ordenar, $item, $valor, $base, $tope, $modo);
	}

	if ($titulosModulos[2] == "LO MÁS VISTO") {
		$ordenar = "vistas";
		$item = "estado";
		$valor = 1;
		$modo = "DESC";
		$vistas = ProductController::showProducts($ordenar, $item, $valor, $base, $tope, $modo);
	}

	$modulos = array($gratis, $ventas, $vistas);
	
for ($i=0; $i < count($titulosModulos); $i++) { 
?>
<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-default btnGrid" id="btnGrid<?php echo $i ?>">
						<!-- col-xs-0 se ocultarar en los dispositivos pequeños -->
						<i class="fa fa-th" aria-hidden="true"></i><span class="col-xs-0"> GRID</span>
					</button>
					<button type="button" class="btn btn-default btnList" id="btnList<?php echo $i ?>">
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
			<div class="col-xs-12 tituloDestacado">
				<!-- con solo poner col-sm-6 ya toma las demás dispositivos con col-6 -->
				<div class="col-sm-6 col-xs-12">
					<h1><small><?php  echo $titulosModulos[$i] ?></small></h1>
				</div>
				<div class="col-sm-6 col-xs-12">
					<a href="<?php echo $rutaModulos[$i] ?>">
						<button class="btn btn-default backColor pull-right">
							VER MÁS <span class="fa fa-chevron-right"></span>
						</button>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
		</div>
		<ul class="grid<?php echo $i ?>">
			<!-- col-lg-3 no se pone por que el col-md-3 lo reemplaza -->
			<?php foreach ($modulos[$i] as $key => $value) { 
				if ($value["estado"] != 0) {
			?>
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="<?php echo $value['ruta'] ?>" class="pixelProducto">
						<img src="<?php echo $urlBack.$value['portada']; ?>" class="img-responsive">
					</a>	
				</figure>
				<h4><small>
					<a href="<?php echo $value['ruta'] ?>" class="pixelProducto"><?php echo $value['titulo'] ?>
						<br><span style="color: rgba(0,0,0,0);">-</span>
						<?php 
							if($value['nuevo'] != 0)
								echo '<span class="label label-warning fontSize">Nuevo</span> ';
							if($value['oferta'] != 0)
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
			<?php } }?>
		</ul>
		<ul class="list<?php echo $i ?>" style="display: none;">
			<!-- con solo poner col-xs-12 ya afecta al resto de pantallas-->
			<?php foreach ($modulos[$i] as $key => $value) { 
				if ($value["estado"] != 0) {?>
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
								if($value['nuevo'] != 0)
									echo '<span class="label label-warning">Nuevo</span> ';
								if($value['oferta'] != 0)
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
			<?php } }?>
		</ul>
	</div>
</div>
<?php } ?>
