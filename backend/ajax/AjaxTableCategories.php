<?php

class AjaxTableCategories{

 	public function showTable()
 	{	

	 	$datosJson = '{
		  "data": [ ';

		$estado = "<button class='btn btn-success btn-xs'>Activado</button>";
		$imgPortada = "<img class='img-thumbnail' src='views/img/cabeceras/default.jpg' width='100px'>";
		$imgOfertas = "<img class='img-thumbnail' src='views/img/ofertas/cursos.jpg' width='100px'>";
		$acciones = "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";

		$datosJson .= '
		    [
		      "1",
		      "CURSOS",
		      "cursos",
		      "'.$estado.'",
		      "descripcion del producto",
		      "descripcion del producto",
		      "'.$imgPortada.'",
		      "descuento",
		      "80%",
		      "'.$imgOfertas.'",
		      "Fechas",
		      "'.$acciones.'"
		    ]
		  ]
		}';

		echo $datosJson;
 	}
}

/*=============================================
ACTIVAR TABLA DE CATEGORÍAS
=============================================*/ 
$activar = new AjaxTableCategories();
$activar->showTable();