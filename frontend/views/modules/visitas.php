<?php  
//$ip = $_SERVER['REMOTE_ADDR'];
$ip = "159.202.197.216";
//www.geoplugin.net me permite recuperar datos de una determinada ip
//para recuperar información desde múltiples fuentes file_get_contents(filename)
$informacionPais = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
$datosPais = json_decode($informacionPais);
$pais = $datosPais->geoplugin_countryName;
$enviarIp = VisitsController::saveIp($ip, $pais);

$totalVisitas = VisitsController::showTotalVisits();

?>

<div class="container-fluid well well-sm">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb lead">
			<h2 class="pull-right"><small>Tu eres nuestro visitante #<?php echo $totalVisitas["total"] ?></small></h2>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="container">
		<div class="row">
			<?php  
			$paises = VisitsController::showCountries();
			$coloresPaises = array("#09F", "#900", "#059", "#260", "#F09", "#02A");
			$indice = -1;

			foreach ($paises as $key => $value) {
				$promedio = $value["cantidad"] * 100 / $totalVisitas["total"];
				$indice++;

				echo '<div class="col-md-2 col-sm-4 col-xs-12 text-center">
						<h2 class="text-muted">'.$value["pais"].'</h2>
						<input type="text" class="knob" value="'.round($promedio).'" data-width="90" data-height="90" data-fgcolor="'.$coloresPaises[$indice].'" data-readonly="true">
						<p class="text-muted text-center" style="font-size:12px"> '.round($promedio).'% de las visitas</p>
					</div>';
			}
			?>
		</div>
	</div>
</div>