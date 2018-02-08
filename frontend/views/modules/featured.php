<?php $urlBack = Route::routeServer(); ?>
<figure class="banner">
	<img src="http://localhost/ecommerce/backend/views/img/banner/default.jpg" class="img-responsive" width="100%">
	<div class="textoBanner textoDer">
		<h1 style="color:#fff">OFERTAS ESPECIALES</h1>
		<h2 style="color:#fff"><strong>50% off</strong></h2>
		<h3 style="color:#fff">Termina el 31 de octubre</h3>
	</div>
</figure>
<?php 
	$titulosModulos = array("ARTÍCULOS GRATUITOS", "LO MÁS VENDIDO", "LO MÁS VISTO");
	$rutaModulos = array("articulos-gratis", "lo-mas-vendido", "lo-mas-visto");

	if ($titulosModulos[0] == "ARTÍCULOS GRATUITOS") {
		$ordenar = "id";
		$item = "precio";
		$valor = 0;
		$gratis = ProductController::showProducts($ordenar, $item, $valor);
	}

	if ($titulosModulos[1] == "LO MÁS VENDIDO") {
		$ordenar = "ventas";
		$item = null;
		$valor = null;
		$ventas = ProductController::showProducts($ordenar, $item, $valor);
	}

	if ($titulosModulos[2] == "LO MÁS VISTO") {
		$ordenar = "vistas";
		$item = null;
		$valor = null;
		$vistas = ProductController::showProducts($ordenar, $item, $valor);
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
			<?php foreach ($modulos[$i] as $key => $value) { ?>
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
							if ($value['tipo'] == 'virtual') {
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
			<?php } ?>
		</ul>
		<ul class="list<?php echo $i ?>" style="display: none;">
			<!-- con solo poner col-xs-12 ya afecta al resto de pantallas-->
			<li class="col-xs-12">
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						<a href="#" class="pixelProducto"><img src="http://localhost/ecommerce/backend/views/img/productos/accesorios/accesorio04.jpg" class="img-responsive"></a>
					</figure>
				</div>
				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1><small><a href="#" class="pixelProducto">Collar de diamantes</a></small></h1>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde. sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde</p>
					<h2><small>GRATIS</small></h2>
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
				<div class="col-xs-12"><hr></div>
			</li>
			<li class="col-xs-12">
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						<a href="#" class="pixelProducto"><img src="http://localhost/ecommerce/backend/views/img/productos/accesorios/accesorio03.jpg" class="img-responsive"></a>
					</figure>
				</div>
				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1><small><a href="#" class="pixelProducto">Bolso deportivo</a></small></h1>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde. sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde</p>
					<h2><small>GRATIS</small></h2>
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
				<div class="col-xs-12"><hr></div>
			</li>
			<li class="col-xs-12">
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						<a href="#" class="pixelProducto"><img src="http://localhost/ecommerce/backend/views/img/productos/accesorios/accesorio02.jpg" class="img-responsive"></a>
					</figure>
				</div>
				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1><small><a href="#" class="pixelProducto">Bolso militar</a></small></h1>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde. sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde</p>
					<h2><small>GRATIS</small></h2>
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
				<div class="col-xs-12"><hr></div>
			</li>
			<li class="col-xs-12">
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						<a href="#" class="pixelProducto"><img src="http://localhost/ecommerce/backend/views/img/productos/accesorios/accesorio01.jpg" class="img-responsive"></a>
					</figure>
				</div>
				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1><small><a href="#" class="pixelProducto">Pulsera de diamantes</a></small></h1>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde. sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde</p>
					<h2><small>GRATIS</small></h2>
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
				<div class="col-xs-12"><hr></div>
			</li>
		</ul>
	</div>
</div>
<?php } ?>
<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-default btnGrid" id="btnGrid1">
						<!-- col-xs-0 se ocultarar en los dispositivos pequeños -->
						<i class="fa fa-th" aria-hidden="true"></i><span class="col-xs-0"> GRID</span>
					</button>
					<button type="button" class="btn btn-default btnList" id="btnList1">
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
					<h1><small>LO MÁS VENDIDO</small></h1>
				</div>
				<div class="col-sm-6 col-xs-12">
					<a href="lo-mas-vendido">
						<button class="btn btn-default backColor pull-right">
							VER MÁS <span class="fa fa-chevron-right"></span>
						</button>
					</a>
				</div>
			</div>
			<!-- me permite visualizar el hr formateando el float left de las columnas -->
			<div class="clearfix"></div>
			<hr>
		</div>
		<ul class="grid1">
			<!-- col-lg-3 no se pone por que el col-md-3 lo reemplaza -->
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/ropa/ropa03.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Falda de flores<br>
					<span class="label label-warning fontSize">Nuevo</span>
					<span class="label label-warning fontSize">40% off</span>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small><strong class="oferta">USD $29</strong></small>
					<small>$11</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/ropa/ropa04.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Vestido jean<br>
					<span class="label label-warning fontSize">40% off</span>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small><strong class="oferta">USD $29</strong></small>
					<small>$11</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/ropa/ropa02.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Vestido clásico<br>
					<span class="label label-warning fontSize">40% off</span>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small><strong class="oferta">USD $29</strong></small>
					<small>$11</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/ropa/ropa06.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Top dama<br><br>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small>USD $29</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
		</ul>
		<ul class="list1" style="display: none;">
			<!-- con solo poner col-xs-12 ya afecta al resto de pantallas-->
			<li class="col-xs-12">
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						<a href="falda-de-flores-1" class="pixelProducto"><img src="http://localhost/ecommerce/backend/views/img/productos/ropa/ropa03.jpg" class="img-responsive"></a>
					</figure>
				</div>
				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1><small><a href="falda-de-flores-1" class="pixelProducto">Falda de flores
						<span class="label label-warning">Nuevo</span>
						<span class="label label-warning">40% off</span>
					</a></small></h1>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde. sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde</p>
					<h2>
						<small><strong class="oferta">USD $29</strong></small>
						<small>$11</small>
					</h2>
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
				<div class="col-xs-12"><hr></div>
			</li>
		</ul>
	</div>
</div>
<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-default btnGrid" id="btnGrid2">
						<!-- col-xs-0 se ocultarar en los dispositivos pequeños -->
						<i class="fa fa-th" aria-hidden="true"></i><span class="col-xs-0"> GRID</span>
					</button>
					<button type="button" class="btn btn-default btnList" id="btnList2">
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
					<h1><small>LO MÁS VISTO</small></h1>
				</div>
				<div class="col-sm-6 col-xs-12">
					<a href="lo-mas-visto">
						<button class="btn btn-default backColor pull-right">
							VER MÁS <span class="fa fa-chevron-right"></span>
						</button>
					</a>
				</div>
			</div>
			<!-- me permite visualizar el hr formateando el float left de las columnas -->
			<div class="clearfix"></div>
			<hr>
		</div>
		<ul class="grid2">
			<!-- col-lg-3 no se pone por que el col-md-3 lo reemplaza -->
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/cursos/curso05.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Curso de bootstrap<br>
					<span class="label label-warning fontSize">90% off</span>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small><strong class="oferta">USD $100</strong></small>
					<small>$10</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="444" imagen="http://localhost/ecommerce/backend/views/img/productos/cursos/curso05.jpg" titulo="Curso de Bootstrap" precio="10" tipo="virtual" peso="0" data-toggle="tooltip" title="Agregar al carrito de compras">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/cursos/curso04.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Curso de canvas y javascript<br>
					<span class="label label-warning fontSize">90% off</span>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small><strong class="oferta">USD $100</strong></small>
					<small>$10</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="444" imagen="http://localhost/ecommerce/backend/views/img/productos/cursos/curso04.jpg" titulo="Curso de Canvas y Javasript" precio="10" tipo="virtual" peso="0" data-toggle="tooltip" title="Agregar al carrito de compras">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/cursos/curso02.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Aprende Javascript desde cero<br>
					<span class="label label-warning fontSize">90% off</span>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small><strong class="oferta">USD $100</strong></small>
					<small>$10</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="444" imagen="http://localhost/ecommerce/backend/views/img/productos/cursos/curso02.jpg" titulo="Aprende Javascript desde cero" precio="10" tipo="virtual" peso="0" data-toggle="tooltip" title="Agregar al carrito de compras">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
			<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/views/img/productos/cursos/curso03.jpg" class="img-responsive">
					</a>	
				</figure>
				<h4><small><a href="" class="pixelProducto">Curso de JQuery<br>
					<span class="label label-warning fontSize">90% off</span>
				</a></small></h4>
				<div class="col-xs-6 precio"><h2>
					<small><strong class="oferta">USD $100</strong></small>
					<small>$10</small></h2>
				</div>
				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="444" imagen="http://localhost/ecommerce/backend/views/img/productos/cursos/curso03.jpg" titulo="Curso de JQuery" precio="10" tipo="virtual" peso="0" data-toggle="tooltip" title="Agregar al carrito de compras">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>
						<a href="" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
			</li>
		</ul>
		<ul class="list2" style="display: none;">
			<!-- con solo poner col-xs-12 ya afecta al resto de pantallas-->
			<li class="col-xs-12">
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						<a href="falda-de-flores-1" class="pixelProducto"><img src="http://localhost/ecommerce/backend/views/img/productos/cursos/curso05.jpg" class="img-responsive"></a>
					</figure>
				</div>
				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1><small><a href="falda-de-flores-1" class="pixelProducto">Curso de bootstrap
						<span class="label label-warning">90% off</span>
					</a></small></h1>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde. sit amet, consectetur adipisicing elit. Culpa placeat, tempore maiores labore odio minima repellendus et unde</p>
					<h2>
						<small><strong class="oferta">USD $100</strong></small>
						<small>$10</small>
					</h2>
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProductos="34" data-toggle="tooltip" title="Agregar a mi lista de deseos"><i class="fa fa-heart" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="444" imagen="http://localhost/ecommerce/backend/views/img/productos/cursos/curso05.jpg" titulo="Curso de Bootstrap" precio="10" tipo="virtual" peso="0" data-toggle="tooltip" title="Agregar al carrito de compras">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>
						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i></button>	
						</a>
					</div>
				</div>
				<div class="col-xs-12"><hr></div>
			</li>
		</ul>
	</div>
</div>