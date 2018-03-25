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