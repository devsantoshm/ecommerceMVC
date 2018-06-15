<?php  
//$ip = $_SERVER['REMOTE_ADDR'];
$ip = "159.202.197.216";
//www.geoplugin.net me permite recuperar datos de una determinada ip
//para recuperar información desde múltiples fuentes file_get_contents(filename)
$informacionPais = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
$datosPais = json_decode($informacionPais);
$pais = $datosPais->geoplugin_countryName;
$enviarIp = VisitsController::saveIp($ip, $pais);

?>

<div class="container-fluid well well-sm">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb lead">
			<h2 class="pull-right"><small>Tu eres nuestro visitante #100</small></h2>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-4 col-xs-12 text-center">
				<h2 class="text-muted">Colombia</h2>
					<input type="text" class="knob" value="50" data-width="90" data-height="90" data-fgcolor="#0FF" data-readonly="true">
					<p class="text-muted text-center" style="font-size:12px"> 50% de las visitas</p>
			</div>
		</div>
	</div>
</div>