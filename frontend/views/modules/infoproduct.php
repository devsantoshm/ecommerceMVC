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
			<?php  
			$item = "ruta";
			$valor = $rutas[0];
			$infoproducto = ProductController::showInfoProduct($item, $valor);
			?>
			<?php if($infoproducto["tipo"] == "fisico"){ ?>
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
			<?php }else{ ?>
			<!-- con col-sm-6, también se ven afectados los md y lg en 6 columnas -->
			<div class="col-sm-6 col-xs-12">
				<iframe class="videoPresentacion" src="https://www.youtube.com/embed/N4aY6yX-MaM?rel=0&autoplay=1" width="100%" frameborder="0" allowfullscreen></iframe>
			</div>
			<?php } 
			if($infoproducto["tipo"] == "fisico")
				echo '<div class="col-md-7 col-sm-6 col-xs-12">';
			else
				echo '<div class="col-sm-6 col-xs-12">';	
			?>	
				<div class="col-xs-6">
					<h6><a href="javascript:history.back()" class="text-muted">
						<i class="fa fa-reply"></i> Continuar comprando
					</a></h6>
				</div>
				<div class="col-xs-6">
					<h6>
						<a href="#" class="dropdown-toggle pull-right text-muted" data-toggle="dropdown"><i class="fa fa-plus"></i> Compartir</a>
						<ul class="dropdown-menu pull-right compartirRedes">
							<li>
								<p class="btnFacebook">
									<i class="fa fa-facebook"></i> Facebook
								</p>
							</li>
							<li>
								<p class="btnGoogle">
									<i class="fa fa-google"></i> Google
								</p>
							</li>
						</ul>
					</h6>
				</div>
				<figure class="lupa">
					<img src="">
				</figure>
			</div>
		</div>
	</div>
</div>