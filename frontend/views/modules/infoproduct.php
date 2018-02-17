<?php 
$urlBack = Route::routeServer(); 
$urlFron = Route::urlFront();
?>
<div class="container-fluid well well-sm">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb fondoBreadcrumb text-uppercase ">
				<li><a href="<?php echo $urlFron ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid infoproducto">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-6 col-xs-12 visorImg">
				<figure class="visor">
					<img id="lupa1" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-01.jpg" alt="tennis verde 11"></img>
					<img id="lupa2" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-02.jpg" alt="tennis verde 11"></img>
					<img id="lupa3" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-03.jpg" alt="tennis verde 11"></img>
					<img id="lupa4" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-04.jpg" alt="tennis verde 11"></img>
					<img id="lupa5" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-05.jpg" alt="tennis verde 11"></img>
				</figure>
				<div class="flexslider">
					<ul class="slides">
						<li><img value="1" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-01.jpg" alt="tennis verde 11"></img></li>
						<li><img value="2" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-02.jpg" alt="tennis verde 11"></img></li>
						<li><img value="3" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-03.jpg" alt="tennis verde 11"></img></li>
						<li><img value="4" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-04.jpg" alt="tennis verde 11"></img></li>
						<li><img value="5" class="img-thumbnail" src="http://localhost/ecommerce/backend/views/img/multimedia/tennis-verde/img-05.jpg" alt="tennis verde 11"></img></li>
					</ul>
				</div>
			</div>
			<div class="col-md-7 col-sm-6 col-xs-12">
				<figure class="lupa">
					<img src="">
				</figure>
			</div>
		</div>
	</div>
</div>