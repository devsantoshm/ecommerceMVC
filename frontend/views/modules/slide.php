<!--container-fluid trabaja al 100% en todos los tamaños de los dispositivos  -->
<div class="container-fluid" id="slide">
	<div class="row">
		<ul>
			<?php 
			$slides = SlideController::showSlide();
			foreach ($slides as $slide) {
				//Cuando es TRUE, los object devueltos serán convertidos a array asociativos
				$estiloImgProducto = json_decode($slide["estiloImgProducto"], true);
				$estiloTextoSlide = json_decode($slide["estiloTextoSlide"], true);
				$titulo1 = json_decode($slide["titulo1"], true);
				$titulo2 = json_decode($slide["titulo2"], true);
				$titulo3 = json_decode($slide["titulo3"], true);
			?>
			<li>
				<img src="http://localhost/ecommerce/backend/<?php echo $slide["imgFondo"] ?>" alt="">
				<div class="slideOpciones <?php echo $slide["tipoSlide"] ?>">
					<img class="imgProducto" src="http://localhost/ecommerce/backend/<?php echo $slide["imgProducto"] ?>" style="top:<?php echo $estiloImgProducto["top"] ?>; right: <?php echo $estiloImgProducto["right"] ?>; width: <?php echo $estiloImgProducto["width"] ?>; left: <?php echo $estiloImgProducto["left"] ?>;">
					<div class="textosSlide" style="top:<?php echo $estiloTextoSlide["top"] ?>; left: <?php echo $estiloTextoSlide["left"] ?>; width: <?php echo $estiloTextoSlide["width"] ?>; right: <?php echo $estiloTextoSlide["right"] ?>;">
						<h1 style="color: <?php echo $titulo1["color"] ?>"><?php echo $titulo1["texto"] ?></h1>
						<h2 style="color: <?php echo $titulo2["color"] ?>"><?php echo $titulo2["texto"] ?></h2>
						<h3 style="color: <?php echo $titulo3["color"] ?>"><?php echo $titulo3["texto"] ?></h3>
						<a href="<?php echo $slide["url"] ?>">
							<?php echo $slide["boton"] ?>
						</a>
					</div>
				</div>
			</li>
			<?php } ?>
		</ul>
		<ol id="paginacion">
			<?php for ($i=1; $i <= count($slides); $i++) { ?>
			<li item="<?php echo $i ?>"><span class="fa fa-circle"></span></li>
			<?php } ?>
		</ol>
		<div class="flechas" id="retroceder"><span class="fa fa-chevron-left"></span></div>
		<div class="flechas" id="avanzar"><span class="fa fa-chevron-right"></span></div>
	</div>
</div>
<center>
	<button id="btnSlide" class="backColor">
		<i class="fa fa-angle-up"></i>
	</button>
</center>