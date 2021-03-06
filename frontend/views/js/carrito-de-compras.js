if (localStorage.getItem("cantidadCesta") != null) {
	$(".cantidadCesta").html(localStorage.getItem("cantidadCesta"))
	$(".sumaCesta").html(localStorage.getItem("sumaCesta"))
} else {
	$(".cantidadCesta").html("0");
	$(".sumaCesta").html("0");
}

//si localstorage viene con informacion entonces almacenamos en listacarrito
if (localStorage.getItem("listaProductos") != null) {
	//convertir el string en un objeto json
	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));
	listaCarrito.forEach(funcionForEach);
	//ejecuta la función indicada una vez por cada elemento del array.
	function funcionForEach(item, index){
		
		var datosProducto = new FormData();
		var precio = 0;

		datosProducto.append("id", item.idProducto);

		$.ajax({

			url:rutaFron+"ajax/AjaxProduct.php",
			method:"POST",
			data: datosProducto,
			cache: false,
			contentType: false,
			processData:false,
			dataType: "json",
			success: function(respuesta){
				// SI NO VIENE OFERTA
				if(respuesta["precioOferta"] == 0){

					precio = respuesta["precio"];

				}else{

					precio = respuesta["precioOferta"];
				}

				$(".cuerpoCarrito").append(

					'<div clas="row itemCarrito">'+
						
						'<div class="col-sm-1 col-xs-12">'+
							
							'<br>'+

							'<center>'+
								
								'<button class="btn btn-default backColor quitarItemCarrito" idProducto="'+item.idProducto+'" peso="'+item.peso+'">'+
									
									'<i class="fa fa-times"></i>'+

								'</button>'+

							'</center>'+	

						'</div>'+
						'<div class="col-sm-1 col-xs-12">'+
							
							'<figure>'+
								
								'<img src="'+item.imagen+'" class="img-thumbnail">'+

							'</figure>'+

						'</div>'+
						'<div class="col-sm-4 col-xs-12">'+

							'<br>'+

							'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+

						'</div>'+
						'<div class="col-md-2 col-sm-1 col-xs-12">'+

							'<br>'+

							'<p class="precioCarritoCompra text-center">USD $<span>'+precio+'</span></p>'+

						'</div>'+
						'<div class="col-md-2 col-sm-3 col-xs-8">'+

							'<br>'+	

							'<div class="col-xs-8">'+

								'<center>'+
								
									'<input type="number" class="form-control cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+'" precio="'+precio+'" idProducto="'+item.idProducto+'" item="'+index+'">'+	

								'</center>'+

							'</div>'+

						'</div>'+
						'<div class="col-md-2 col-sm-1 col-xs-4 text-center">'+
							
							'<br>'+

							'<p class="subTotal'+index+' subtotales">'+
								
								'<strong>USD $<span>'+(Number(item.cantidad)*Number(precio))+'</span></strong>'+

							'</p>'+

						'</div>'+
						
					'</div>'+

					'<div class="clearfix"></div>'+

					'<hr>');

				/*=============================================
				EVITAR MANIPULAR LA CANTIDAD EN PRODUCTOS VIRTUALES
				=============================================*/
				$(".cantidadItem[tipo='virtual']").attr("readonly","true");

				/*=============================================
				ACTUALIZAR SUBTOTAL
				=============================================*/
				var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");

				cestaCarrito(precioCarritoCompra.length);
				sumaSubtotales();
				
				/*var cantidadItem = $(".cuerpoCarrito .cantidadItem");

				for(var i = 0; i < precioCarritoCompra.length; i++){

					var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();
					var cantidadItemArray = $(cantidadItem[i]).val();
					var idProductoArray = $(cantidadItem[i]).attr("idProducto");

					$(".subTotal"+i).html('<strong>USD $<span>'+(precioCarritoCompraArray*cantidadItemArray)+'</span></strong>')

					sumaSubtotales();
					cestaCarrito(precioCarritoCompra.length);

				}*/			

			}
		
		})

		/*=============================================
		ACTUALIZAR SUBTOTAL
		=============================================*/
		var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
		var cantidadItem = $(".cuerpoCarrito .cantidadItem");

		for(var i = 0; i < precioCarritoCompra.length; i++){

			var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();
			var cantidadItemArray = $(cantidadItem[i]).val();
			var idProductoArray = $(cantidadItem[i]).attr("idProducto");

			$(".subTotal"+i).html('<strong>USD $<span>'+(precioCarritoCompraArray*cantidadItemArray)+'</span></strong>')

			sumaSubtotales();
			cestaCarrito(precioCarritoCompra.length);

		}

	}
}else{
	$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
	$(".sumaCarrito").hide();
	$(".cabeceraCheckout").hide();
}

$(".agregarCarrito").click(function(){
	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var titulo = $(this).attr("titulo");
	var precio = $(this).attr("precio");
	var tipo = $(this).attr("tipo");
	var peso = $(this).attr("peso");

	var agregarAlCarrito = false;

	if (tipo == "virtual") {
		agregarAlCarrito = true;
	} else {
		var seleccionarDetalle = $(".seleccionarDetalle")
		for(var i = 0; i < seleccionarDetalle.length; i++){
			if ($(seleccionarDetalle[i]).val() == "") {
				swal({
					  title:"Debe seleccionar Talla y Color",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡Seleccionar!",
					  closeOnConfirm: false
					});
			} else {
				titulo = titulo + "-" + $(seleccionarDetalle[i]).val();
				agregarAlCarrito = true;
			}
		}
	}
	//almacenar en el localStorage los productos agregados al carrito
	if (agregarAlCarrito) {
		//recuperar almacenamiento del localStorage
		if (localStorage.getItem("listaProductos") == null) {
			listaCarrito = [];
		} else {
			var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
			for (var i = 0; i < listaProductos.length; i++) {
				if (listaProductos[i]["idProducto"] == idProducto && listaProductos[i]["tipo"] == "virtual") {
					swal({
					  title:"El producto ya está agregado al carrito de compras",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡volver!",
					  closeOnConfirm: false
					})

					// Cancelamos todo lo que estaba haciendo el código con el return
					return;
				}
			}

			listaCarrito.concat(localStorage.getItem("listaProductos"))
		}

		listaCarrito.push({"idProducto":idProducto,
							"imagen":imagen,
							"titulo":titulo,
							"precio":precio,
							"tipo":tipo,
							"peso":peso,
							"cantidad":"1"});

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito)); //convertir a string

		//actuzalizar la cesta
		var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
		var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);

		$(".cantidadCesta").html(cantidadCesta)
		$(".sumaCesta").html(sumaCesta)

		localStorage.setItem("cantidadCesta", cantidadCesta)
		localStorage.setItem("sumaCesta", sumaCesta)

		swal({
		  title:"",
		  text: "¡Se ha agregado un nuevo producto al carrito de compras!",
		  type: "success",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  cancelButtonText: "¡Continuar comprando!",
		  confirmButtonText: "¡Ir al carrito de compras!",
		  closeOnConfirm: false
		},
		function(isConfirm){
			if (isConfirm) {
				window.location = rutaFron+"carrito-de-compras";
			}
		}
		);
	}
})

//DAR CLICK A ELEMENTOS DEL DOM QUE CARGUEN DESPUÉS DEL AJAX
$(document).on("click", ".quitarItemCarrito", function(){
	$(this).parent().parent().parent().remove()

	/*var id=$(this).attr("idProducto")
	$("#idhr"+id).remove()*/

	//me trae todos los button que hay en cuerpoCarrito después de haber eliminado un item
	var idProducto = $(".cuerpoCarrito button")
	//console.log("idProducto", idProducto)
	var imagen = $(".cuerpoCarrito img") //encuentra todas las etiquetas img
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra")
	var precio = $(".cuerpoCarrito .precioCarritoCompra span")
	var cantidad = $(".cuerpoCarrito .cantidadItem")

	//actualizar el localStorage
	listaCarrito = []

	if (idProducto.length != 0) {
		for (var i = 0; i < idProducto.length; i++) {
			var idProductoArray = $(idProducto[i]).attr("idProducto")
			var imagenArray = $(imagen[i]).attr("src")
			var tituloArray = $(titulo[i]).html()
			var precioArray = $(precio[i]).html()
			var pesoArray = $(idProducto[i]).attr("peso")
			var tipoArray = $(cantidad[i]).attr("tipo")
			var cantidadArray = $(cantidad[i]).val()

			listaCarrito.push({"idProducto":idProductoArray,
							"imagen":imagenArray,
							"titulo":tituloArray,
							"precio":precioArray,
							"tipo":tipoArray,
							"peso":pesoArray,
							"cantidad":cantidadArray});
		}

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito))

		sumaSubtotales()
		cestaCarrito(listaCarrito.length)

	} else {
		// si ya no quedan productos hay que remover todo
		localStorage.removeItem("listaProductos")
		localStorage.setItem("cantidadCesta", "0")
		localStorage.setItem("sumaCesta", "0")

		$(".cantidadCesta").html("0");
		$(".sumaCesta").html("0");

		$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
		$(".sumaCarrito").hide();
		$(".cabeceraCheckout").hide();
	}
})

//Generar subtotal después de cambiar cantidad
$(document).on("change", ".cantidadItem", function(){
	var cantidad = $(this).val()
	var precio = $(this).attr("precio")
	var idProducto = $(this).attr("idProducto")
	var item = $(this).attr("item");
	//var cantidadItem = $(".cantidadItem") //captura el array de etiquetas con esa clase

	$(".subTotal"+item).html('<strong>USD $<span>'+(Math.abs(cantidad*precio))+'</span></strong>')

	//actualizar la cantidad en el localstorage
	var idProducto = $(".cuerpoCarrito button")
	var imagen = $(".cuerpoCarrito img") //encuentra todas las etiquetas img
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra")
	var precio = $(".cuerpoCarrito .precioCarritoCompra span")
	var cantidad = $(".cuerpoCarrito .cantidadItem")

	listaCarrito = []

	for (var i = 0; i < idProducto.length; i++) {
		var idProductoArray = $(idProducto[i]).attr("idProducto")
		var imagenArray = $(imagen[i]).attr("src")
		var tituloArray = $(titulo[i]).html()
		var precioArray = $(precio[i]).html()
		var pesoArray = $(idProducto[i]).attr("peso")
		var tipoArray = $(cantidad[i]).attr("tipo")
		var cantidadArray = $(cantidad[i]).val()

		listaCarrito.push({"idProducto":idProductoArray,
						"imagen":imagenArray,
						"titulo":tituloArray,
						"precio":precioArray,
						"tipo":tipoArray,
						"peso":pesoArray,
						"cantidad":cantidadArray});
	}

	localStorage.setItem("listaProductos", JSON.stringify(listaCarrito))

	sumaSubtotales()
	cestaCarrito(listaCarrito.length)
})

//Actualizar subtotal
var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span")
//console.log("preciocompra", precioCarritoCompra)
var cantidadItem = $(".cuerpoCarrito .cantidadItem")

for (var i = 0; i < precioCarritoCompra.length; i++) {
	var precioCarritoCompraArray = $(precioCarritoCompra[i]).html()
	var cantidadItemArray = $(cantidadItem[i]).val()
	var idProductoArray = $(cantidadItem[i]).attr("idProducto")

	$(".subTotal"+idProductoArray).html('<strong>USD $<span>'+(Math.abs(cantidadItemArray*precioCarritoCompraArray))+'</span></strong>')

	sumaSubtotales()
	cestaCarrito(precioCarritoCompra.length)
}

//suma de todos los subtotales
function sumaSubtotales(){
	var subtotales = $(".subtotales span")
	var arraySumaSubtotales = []

	for (var i = 0; i < subtotales.length; i++) {
		var subtotalesArray = $(subtotales[i]).html()
		arraySumaSubtotales.push(Number(subtotalesArray))
	}

	function sumaArraySubtotales(total, numero){
		return total + numero
	}

	//reduce() aplica una función a un acumulador y a cada valor de un array (de izquierda a derecha) para reducirlo a un único valor.
	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales)

	$(".sumaSubTotal").html('<strong>USD $<span>'+(sumaTotal).toFixed(2)+'</span></strong>')
	$(".sumaCesta").html((sumaTotal).toFixed(2))

	localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2))
}

//Actualizar cesta al cambiar cantidad
function cestaCarrito(cantidadProductos){
	//si hay productos en el carrito
	if (cantidadProductos != 0) {
		var cantidadItem = $(".cuerpoCarrito .cantidadItem")
		var arraySumaCantidades = []

		for (var i = 0; i < cantidadItem.length; i++) {
			var cantidadItemArray = $(cantidadItem[i]).val()
			arraySumaCantidades.push(Number(cantidadItemArray))
		}

		function sumaArrayCantidades(total, numero){
			return total + numero
		}

		var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades)
		$(".cantidadCesta").html(sumaTotalCantidades)
		localStorage.setItem("cantidadCesta", sumaTotalCantidades)
	} 
}

$("#btnCheckout").click(function(){
	//para limpiar la redundancia de datos en la ventana modal
	$(".listaProductos table.tablaProductos tbody").html("");

	var idUsuario = $(this).attr("idUsuario")
	var peso = $(".cuerpoCarrito button, .comprarAhora button")
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra, .comprarAhora .tituloCarritoCompra")
	var cantidad = $(".cuerpoCarrito .cantidadItem, .comprarAhora .cantidadItem")
	var subtotal = $(".cuerpoCarrito .subtotales span, .comprarAhora .subtotales span")
	var tipoArray = []
	var cantidadPeso = []
	var sumaSubTotal = $(".sumaSubTotal span")
	//console.log("sumaSubTotal", $(sumaSubTotal).html());
	//de esta forma asignamos el valor de subtotal
	$(".valorSubtotal").html($(sumaSubTotal).html());
	$(".valorSubtotal").attr("valor", $(sumaSubTotal).html());

	//tasas de impuesto del 19% del subtotal
	/*var numero = 1.77777777;
	numero = Number(numero.toFixed(2));
	console.log(numero); // Muestra 1.78*/
	var impuestoTotal = ($(".valorSubtotal").html() * $("#tasaImpuesto").val())/100;
	$(".valorTotalImpuesto").html(impuestoTotal.toFixed(2));
	$(".valorTotalImpuesto").attr("valor", impuestoTotal.toFixed(2));

	sumaTotalCompra();

	for (var i = 0; i < titulo.length; i++) {
		var pesoArray = $(peso[i]).attr("peso")
		var tituloArray = $(titulo[i]).html()
		var cantidadArray = $(cantidad[i]).val()
		var subtotalArray = $(subtotal[i]).html()

		//Evaluar el peso de acuerdo a la cantidad de productos
		cantidadPeso[i] = pesoArray * cantidadArray;

		function sumaArrayPeso(total, numero){
			return total + numero
		}


		//reduce() aplica una función a un acumulador y a cada valor de un array (de izquierda a derecha) para reducirlo a un único valor.
		var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso)

		//mostrar productos definitivos a comprar
		$(".listaProductos table.tablaProductos tbody").append('<tr>'+
																'<td class="valorTitulo">'+tituloArray+'</td>'+
																'<td class="valorCantidad">'+cantidadArray+'</td>'+
																'<td>$<span class="valorItem" valor="'+subtotalArray+'">'+subtotalArray+'</span></td>'+
																'</tr>')
		//seleccionar pais de envio si hay productos fisicos
		tipoArray.push($(cantidad[i]).attr("tipo"))
		
		function checkTipo(tipo){
			return tipo == "fisico"
		} 
	}

	//EXISTEN PRODUCTOS FISICOS
	if (tipoArray.find(checkTipo) == "fisico") {
		//para que no siga mostrando el mensaje de divisa no selecciono pais
		$(".seleccionePais").html('<select class="form-control" id="seleccionarPais" required>'+
								'<option value="">Seleccione el país</option>'+
								'</select>');

		$(".formEnvio").show()

		$(".btnPagar").attr("tipo", "fisico");

		$.ajax({
			url: rutaFron+"views/js/plugins/countries.json",
			type: "GET",
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				respuesta.forEach(seleccionarPais)
				function seleccionarPais(item, indec){
					var pais = item.name
					var codPais = item.code

					$("#seleccionarPais").append('<option value="'+codPais+'">'+pais+'</option>')
				}
			}
		})

		//Evaluar tasas de envio si el producto es físico
		$("#seleccionarPais").change(function(){

			//remover la alerta después de seleccionar país
			$(".alert").remove();

			$("#cambiarDivisa").val("USD") //para que regrese a dolares despues de seleccionar el pais
			$(".cambioDivisa").html("USD")
			//retornar cambio de divisa a dolar luego de cambiar de país
			$(".valorSubtotal").html((1 * Number($(".valorSubtotal").attr("valor"))).toFixed(2))
			$(".valorTotalEnvio").html((1 * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2))
			$(".valorTotalImpuesto").html((1 * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2))
			$(".valorTotalCompra").html((1 * Number($(".valorTotalCompra").attr("valor"))).toFixed(2))
		
			var valorItem = $(".valorItem")

			for (var i = 0; i < valorItem.length; i++) {
				$(valorItem[i]).html((1 * Number($(valorItem[i]).attr("valor"))).toFixed(2))
			}

			var pais = $(this).val()
			var tasaPais = $("#tasaPais").val()

			if (pais == tasaPais) {
				var resultadoPeso = sumaTotalPeso * $("#envioNacional").val()
				if (resultadoPeso < $("#tasaMinimaNal").val()) {
					$(".valorTotalEnvio").html($("#tasaMinimaNal").val())
					$(".valorTotalEnvio").attr("valor", $("#tasaMinimaNal").val())
				} else {
					$(".valorTotalEnvio").html(resultadoPeso)
					$(".valorTotalEnvio").attr("valor", resultadoPeso)
				}
			}else{
				var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val()
				if (resultadoPeso < $("#tasaMinimaInt").val()) {
					$(".valorTotalEnvio").html($("#tasaMinimaInt").val())
					$(".valorTotalEnvio").attr("valor", $("#tasaMinimaInt").val())
				} else {
					$(".valorTotalEnvio").html(resultadoPeso)
					$(".valorTotalEnvio").attr("valor", resultadoPeso)
				}
			}

			sumaTotalCompra()
		})
	} else{
		$(".btnPagar").attr("tipo", "virtual");
	}
	
})

//SUMA TOTAL DE LA COMPRA
function sumaTotalCompra(){
	var sumaTotalTasas = Number($(".valorSubtotal").html())+
						 Number($(".valorTotalEnvio").html())+
						 Number($(".valorTotalImpuesto").html());

	$(".valorTotalCompra").html(sumaTotalTasas.toFixed(2));
	$(".valorTotalCompra").attr("valor", sumaTotalTasas.toFixed(2));

	localStorage.setItem("total", hex_md5($(".valorTotalCompra").html()))
}

var metodoPago = "paypal"
divisas(metodoPago)

//MÉTODO DE PAGO PARA CAMBIO DE DIVISA
$("input[name='pago']").change(function(){
	var metodoPago = $(this).val()
	divisas(metodoPago)
})

function divisas(metodoPago){
	$("#cambiarDivisa").html("")
	if (metodoPago == "paypal") {
		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
								   '<option value="EUR">EUR</option>'+
								   '<option value="GBP">GBP</option>'+
								   '<option value="MXN">MXN</option>'+
								   '<option value="JPV">JPV</option>'+
								   '<option value="CAD">CAD</option>'+
								   '<option value="BRL">BRL</option>')
	} else {
		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
								   '<option value="PEN">PEN</option>'+
								   '<option value="COP">COP</option>'+
								   '<option value="MXN">MXN</option>'+
								   '<option value="CLP">CLP</option>'+
								   '<option value="ARS">ARS</option>'+
								   '<option value="BRL">BRL</option>')
	}
}

//CAMBIO DE DIVISA
/*
They are the inverse of each other. JSON.stringify() serializes a JS object into a JSON string, 
whereas JSON.parse() will deserialize a JSON string into a JS object.
*/
var divisaBase = "USD"

$("#cambiarDivisa").change(function(){
	$(".alert").remove() //para eliminar los alert repetidos
	
	if ($("#seleccionarPais").val() == "") {
		$("#cambiarDivisa").after('<div class="alert alert-warning">No ha seleccionado el país de envío</div>')

		return; //return para cancelar la compra, es decir, cancelar la acción que puede seguir el boton pagar
	}


	var divisa = $(this).val()

	$.ajax({
		url: "http://free.currencyconverterapi.com/api/v3/convert?q="+divisaBase+"_"+divisa+"&compact=y",
		type: "GET",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "jsonp", //cruce de origen solicitado para traer informacion de otro servidor
		success: function(respuesta){
			
			var conversion = (respuesta["USD_"+divisa]["val"]).toFixed(2);

	    	$(".cambioDivisa").html(divisa);
	    	
	    	if(divisa == "USD"){

	    		$(".valorSubtotal").html($(".valorSubtotal").attr("valor"))
		    	$(".valorTotalEnvio").html($(".valorTotalEnvio").attr("valor"))
		    	$(".valorTotalImpuesto").html($(".valorTotalImpuesto").attr("valor"))
		    	$(".valorTotalCompra").html($(".valorTotalCompra").attr("valor"))

		    	var valorItem = $(".valorItem");

		    	localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

		    	for(var i = 0; i < valorItem.length; i++){

		    		$(valorItem[i]).html($(valorItem[i]).attr("valor"));

		    	}
	    		
	    	}else{
	
		    	$(".valorSubtotal").html(
		    		
		    		Math.ceil(Number(conversion) * Number($(".valorSubtotal").attr("valor"))*100)/100

		    	)

		    	$(".valorTotalEnvio").html(

		    		(Number(conversion) * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2)

		    	)

		    	$(".valorTotalImpuesto").html(

		    		(Number(conversion) * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2)

		    	)

		    	$(".valorTotalCompra").html(

		    		(Number(conversion) * Number($(".valorTotalCompra").attr("valor"))).toFixed(2)

		    	)

		    	var valorItem = $(".valorItem");

		    	localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

		    	for(var i = 0; i < valorItem.length; i++){

		    		$(valorItem[i]).html(
		    			
		    			(Number(conversion) * Number($(valorItem[i]).attr("valor"))).toFixed(2)

		    		);

		    	}

		    }

	    	sumaTotalCompra();
		}
	})
})

//boton pagar
$(".btnPagar").click(function(){
	var tipo = $(this).attr("tipo")
	if (tipo == "fisico" && $("#seleccionarPais").val() == "") {
		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el país de envío</div>')

		return; //return para cancelar la compra, es decir, cancelar la acción que puede seguir el boton pagar
	}

	var divisa = $("#cambiarDivisa").val()
	var total = $(".valorTotalCompra").html()
	var totalEncriptado = localStorage.getItem("total")
	var impuesto = $(".valorTotalImpuesto").html()
	var envio = $(".valorTotalEnvio").html()
	var subtotal = $(".valorSubtotal").html()
	var titulo = $(".valorTitulo")
	var cantidad = $(".valorCantidad")
	var valorItem = $(".valorItem")
	var idProducto = $(".cuerpoCarrito button, .comprarAhora button")

	var tituloArray = []
	var cantidadArray = []
	var valorItemArray = []
	var idProductoArray = []

	for (var i = 0; i < titulo.length; i++) {
		tituloArray[i] = $(titulo[i]).html()
		cantidadArray[i] = $(cantidad[i]).html()
		valorItemArray[i] = $(valorItem[i]).html()
		idProductoArray[i] = $(idProducto[i]).attr("idProducto")
	}

	var datos = new FormData()

	datos.append("divisa", divisa)
	datos.append("total", total)
	datos.append("totalEncriptado", totalEncriptado)
	datos.append("impuesto", impuesto)
	datos.append("envio", envio)
	datos.append("subtotal", subtotal)
	datos.append("tituloArray", tituloArray)
	datos.append("cantidadArray", cantidadArray)
	datos.append("valorItemArray", valorItemArray)
	datos.append("idProductoArray", idProductoArray)

	$.ajax({
		url: rutaFron+"ajax/AjaxCar.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			console.log("respuesta", respuesta);
			window.location = respuesta;
		}
	})
})

//AGREGAR PRODUCTOS GRATIS
$(".agregarGratis").click(function(){

	var idProducto = $(this).attr("idProducto");
	var idUsuario = $(this).attr("idUsuario");
	var tipo = $(this).attr("tipo");
	var titulo = $(this).attr("titulo");
	var agregarGratis = false;

	//VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
	var datos = new FormData();
	datos.append("idUsuario", idUsuario)
	datos.append("idProducto", idProducto)

	$.ajax({
		url: rutaFron+"ajax/AjaxCar.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			//console.log("respuesta", respuesta);
			if (respuesta != "[]") {
				swal({
				  title:"¡Usted ya adquirió este producto!",
				  text: "",
				  type: "warning",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Regresar",
				  closeOnConfirm: false
				})

			}else{

				if (tipo == "virtual") {
					agregarGratis = true;
				} else {
					var seleccionarDetalle = $(".seleccionarDetalle")
					for(var i = 0; i < seleccionarDetalle.length; i++){
						if ($(seleccionarDetalle[i]).val() == "") {
							swal({
								  title:"Debe seleccionar Talla y Color",
								  text: "",
								  type: "warning",
								  showCancelButton: false,
								  confirmButtonColor: "#DD6B55",
								  confirmButtonText: "¡Seleccionar!",
								  closeOnConfirm: false
								});

							return; //para que se detenga si solamente selecciono talla y no color

						} else {
							titulo = titulo + "-" + $(seleccionarDetalle[i]).val();
							agregarGratis = true;
						}
					}
				}

				if (agregarGratis) {
					window.location = rutaFron+"index.php?ruta=finalizar-compra&gratis=true&producto="+idProducto+"&titulo="+titulo;
				}
			}
		}
	})
})