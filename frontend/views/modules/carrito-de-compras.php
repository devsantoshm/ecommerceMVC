<?php 
$urlBack = Route::routeServer();  
$urlFron = Route::urlFront();
?>
<div class="container-fluid well well-sm">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb text-uppercase fondoBreadcrumb">
				<li><a href="<?php echo $urlFron ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>
			</ul>			
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading cabeceraCarrito">
				<div class="col-md-6 col-sm-7 col-xs-12 text-center">
					<h3>
						<small>PRODUCTO</small>
					</h3>
				</div>
				<div class="col-md-2 col-sm-1 col-xs-0 text-center">
					<h3>
						<small>PRECIO</small>
					</h3>
				</div>
				<div class="col-sm-2 col-xs-0 text-center">
					<h3>
						<small>CANTIDAD</small>
					</h3>
				</div>
				<div class="col-sm-2 col-xs-0 text-center">
					<h3>
						<small>SUBTOTAL</small>
					</h3>
				</div>
			</div>
			<div class="panel-body cuerpoCarrito">
				<div class="row itemCarrito">
					<!-- ocupara para dispositivo grande, mediano y pequeño de una sola columna -->
					<div class="col-sm-1 col-xs-12">
						<br>
						<center>
							<button class="btn btn-default backColor">
								<i class="fa fa-times"></i>
							</button>
						</center>
					</div>
					<div class="col-sm-1 col-xs-12">
						<figure>
							<img src="http://localhost/ecommerce/backend/views/img/productos/cursos/curso02.jpg" class="img-thumbnail">
						</figure>
					</div>
					<div class="col-sm-4 col-xs-12">
						<br>
						<p class="tituloCarritoCompra text-left">Aprende php desde cero</p>
					</div>
					<div class="col-md-2 col-sm-1 col-xs-12">
						<br>
						<p class="precioCarritoCompra text-center">USD $<span>10</span></p>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-8">
						<br>
						<div class="col-xs-8">
							<center>
								<input type="number" class="form-control" min="1" value="1" readonly>
							</center>
						</div>
					</div>
					<div class="col-md-2 col-sm-1 col-xs-4 text-center">
						<br>
						<p><strong>USD $<span>10</span></strong></p>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="row itemCarrito">
					<!-- ocupara para dispositivo grande, mediano y pequeño de una sola columna -->
					<div class="col-sm-1 col-xs-12">
						<br>
						<center>
							<button class="btn btn-default backColor">
								<i class="fa fa-times"></i>
							</button>
						</center>
					</div>
					<div class="col-sm-1 col-xs-12">
						<figure>
							<img src="http://localhost/ecommerce/backend/views/img/productos/ropa/ropa04.jpg" class="img-thumbnail">
						</figure>
					</div>
					<div class="col-sm-4 col-xs-12">
						<br>
						<p class="tituloCarritoCompra text-left">vestido jean</p>
					</div>
					<div class="col-md-2 col-sm-1 col-xs-12">
						<br>
						<p class="precioCarritoCompra text-center">USD $<span>11</span></p>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-8">
						<br>
						<div class="col-xs-8">
							<center>
								<input type="number" class="form-control" min="1" value="1">
							</center>
						</div>
					</div>
					<div class="col-md-2 col-sm-1 col-xs-4 text-center">
						<br>
						<p><strong>USD $<span>11</span></strong></p>
					</div>
					<div class="clearfix"></div>
					<hr>
				</div>
			</div>
			<div class="panel-body sumaCarrito">
				<div class="col-md-4 col-sm-6 col-xs-12 pull-right well">
					<div class="col-xs-6">
						<h4>TOTAL:</h4>
					</div>
					<div class="col-xs-6">
						<h4 class="sumaSubTotal">
							<strong>USD $<span>21</span></strong>
						</h4>
					</div>
				</div>
			</div>
			<div class="panel-heading cabeceraCheckout">
				<button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button>
			</div>
		</div>
	</div>
</div>