var item = 0;
var itemPaginacion = $("#paginacion li");
var interrumpirCiclo = false;
var imgProducto = $(".imgProducto")
var titulo1 = $("#slide h1")
var titulo2 = $("#slide h2")
var titulo3 = $("#slide h3")
var btnVerProducto = $("#slide button")
var detenerIntervalo = false;

$(imgProducto[item]).animate({"top": -10 +"%", "opacity": 0}, 100, "easeOutBounce")
$(imgProducto[item]).animate({"top": 30 +"px", "opacity": 1}, 600, "easeOutBounce")

$(titulo1[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
$(titulo1[item]).animate({"top": 30 +"px", "opacity": 1}, 600)
$(titulo2[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
$(titulo2[item]).animate({"top": 30 +"px", "opacity": 1}, 600)
$(titulo3[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
$(titulo3[item]).animate({"top": 30 +"px", "opacity": 1}, 600)

$(btnVerProducto[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
$(btnVerProducto[item]).animate({"top": 30 +"px", "opacity": 1}, 600)

$("#paginacion li").click(function(){
	item = $(this).attr("item")-1;
	movimientoSlide(item);
});

function avanzar(){
	if(item == 3)
		item = 0;
	else
		item++

	movimientoSlide(item);
}

$("#slide #avanzar").click(function(){
	avanzar();
})

$("#slide #retroceder").click(function(){
	if(item == 0)
		item = 3;
	else
		item--

	movimientoSlide(item);
})

function movimientoSlide(item){
	// http://easings.net/es efectos de retardo a una animación en jquery
	$("#slide ul").animate({"left": item * -100 + "%"}, 400, "easeOutQuart");
	$("#paginacion li").css({"opacity":.5});
	//console.log("itemPaginacion", itemPaginacion); //0:li 1:li 2:li 3:li
	$(itemPaginacion[item]).css({"opacity":1});

	interrumpirCiclo = true

	$(imgProducto[item]).animate({"top": -10 +"%", "opacity": 0}, 100, "easeOutBounce")
	$(imgProducto[item]).animate({"top": 30 +"px", "opacity": 1}, 600, "easeOutBounce")

	$(titulo1[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
	$(titulo1[item]).animate({"top": 30 +"px", "opacity": 1}, 600)
	$(titulo2[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
	$(titulo2[item]).animate({"top": 30 +"px", "opacity": 1}, 600)
	$(titulo3[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
	$(titulo3[item]).animate({"top": 30 +"px", "opacity": 1}, 600)

	$(btnVerProducto[item]).animate({"top": -10 +"%", "opacity": 0}, 100)
	$(btnVerProducto[item]).animate({"top": 30 +"px", "opacity": 1}, 600)
}

$("#slide").mouseover(function(){
	$("#slide #retroceder").css({"opacity":1})
	$("#slide #avanzar").css({"opacity":1})

	detenerIntervalo = true
})

$("#slide").mouseout(function(){
	$("#slide #retroceder").css({"opacity":0})
	$("#slide #avanzar").css({"opacity":0})

	detenerIntervalo = false
})

setInterval(function(){
	
	if(interrumpirCiclo)
		interrumpirCiclo = false
	else{
		if(!detenerIntervalo)
			avanzar();
	}

}, 3000)

