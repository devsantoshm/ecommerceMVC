<?php  

$comercio = CommerceController::selectCommerce();

?>
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">INFORMACIÓN DEL COMERCIO</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body formularioConfiguracion">
		<div class="form-group">
			<label>Impuesto:</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-percent"></i></span>
				<input type="number" min="1" class="form-control cambioConfiguracion" id="impuesto" value="<?php echo $comercio["impuesto"]; ?>">
			</div>
		</div>
		<div class="form-group">
			<label>Envío Nacional:</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
				<input type="number" min="1" class="form-control cambioConfiguracion" id="envioNacional" value="<?php echo $comercio["envioNacional"]; ?>">
			</div>
		</div>
		<div class="form-group">
			<label>Envío Internacional:</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
				<input type="number" min="1" class="form-control cambioConfiguracion" id="envioInternacional" value="<?php echo $comercio["envioInternacional"]; ?>">
			</div>
		</div>
		<div class="form-group">
			<label>Tasa Mínima Nacional:</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
				<input type="number" min="1" class="form-control cambioConfiguracion" id="tasaMinimaNal" value="<?php echo $comercio["tasaMinimaNal"]; ?>">
			</div>
		</div>
		<div class="form-group">
			<label>Tasa Mínima Internacional:</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
				<input type="number" min="1" class="form-control cambioConfiguracion" id="tasaMinimaInt" value="<?php echo $comercio["tasaMinimaInt"]; ?>">
			</div>
		</div>
		<div class="form-group">
			<label>Selccione País:</label>
			<input type="hidden" id="codigoPais" value="<?php echo $comercio["pais"]; ?>">
			<select class="form-control cambioConfiguracion" id="seleccionarPais">
				<option id="paisSeleccionado"></option>	
			</select>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="text-uppercase">Configuración Paypal</h4>
			</div>
			<div class="panel-body">
				<div class="form-group row">
					<div class="col-xs-3">
						<label>Modo:</label>
						<?php  
						if ($comercio["modoPaypal"] == "sandbox") {
							echo '<label class="checkbox">
									<input type="radio" name="modoPaypal" value="sandbox" class="cambioConfiguracion" checked>
									Sandbox
								</label>
								<label class="checkbox">
									<input type="radio" name="modoPaypal" value="live" class="cambioConfiguracion">
									Live
								</label>';
						} else {
							echo '<label class="checkbox">
									<input type="radio" name="modoPaypal" value="sandbox" class="cambioConfiguracion">
									Sandbox
								</label>
								<label class="checkbox">
									<input type="radio" name="modoPaypal" value="live" class="cambioConfiguracion" checked>
									Live
								</label>';
						}
						
						?>
					</div>
					<div class="col-xs-4">
						<label>Cliente:</label>
						<input type="text" class="form-control cambioConfiguracion" id="clienteIdPaypal" value="<?php echo $comercio["clienteIdPaypal"] ?>">
					</div>
					<div class="col-xs-5">
						<label>Llave Secreta:</label>
						<input type="text" class="form-control cambioConfiguracion" id="llaveSecretaPaypal" value="<?php echo $comercio["llaveSecretaPaypal"] ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button type="button" id="guardarInformacion" class="btn btn-primary pull-right">Guardar</button>
	</div>
</div>