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
		//console.log("item", item.idProducto);
		$(".cuerpoCarrito").append(
			'<div class="row itemCarrito">'+
				/*<!-- ocupara para dispositivo grande, mediano y pequeño de una sola columna -->*/
				'<div class="col-sm-1 col-xs-12">'+
					'<br>'+
					'<center>'+
						'<button class="btn btn-default backColor">'+
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
					'<p class="precioCarritoCompra text-center">USD $<span>'+item.precio+'</span></p>'+
				'</div>'+
				'<div class="col-md-2 col-sm-3 col-xs-8">'+
					'<br>'+
					'<div class="col-xs-8">'+
						'<center>'+
							'<input type="number" class="form-control cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+'">'+
						'</center>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-2 col-sm-1 col-xs-4 text-center">'+
					'<br>'+
					'<p><strong>USD $<span>10</span></strong></p>'+
				'</div>'+
			'</div>'+
			'<div class="clearfix"></div>'+
			'<hr>');

		//Evitar manipular la cantidad en productos virtuales
		$(".cantidadItem[tipo='virtual']").attr("readonly", "true");
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