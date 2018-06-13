var rutaFron = $("#rutaFron").val();

$('[data-toggle="tooltip"]').tooltip({placement: "top"});

$.ajax({
	url: rutaFron + "ajax/AjaxTemplate.php",
	success: function(response){
		//console.log(JSON.parse(response)); //convertir un string en formato json
		var colorFondo = JSON.parse(response).colorFondo;
		var colorTexto = JSON.parse(response).colorTexto;
		var barraSuperior = JSON.parse(response).barraSuperior;
		var textoSuperior = JSON.parse(response).textoSuperior;

		$(".backColor, .backColor a").css({"background": colorFondo,
											"color": colorTexto})
		$(".barraSuperior, .barraSuperior a").css({"background": barraSuperior,
											"color": textoSuperior})
	}
});

var btnList = $(".btnList");
//console.log("btnList", btnList.length) , numero de clases btnList
for (var i = 0; i < btnList.length; i++) {
	$("#btnGrid"+i).click(function(){
		//extracts parts of a string To extract characters from the end of the string, use a negative start number
		var numero = $(this).attr("id").substr(-1);
		$(".list"+numero).hide(); //display:none
		$(".grid"+numero).show(); //display:block

		$("#btnGrid"+numero).addClass("backColor");
		$("#btnList"+numero).removeClass("backColor");
	})

	$("#btnList"+i).click(function(){
		//extracts parts of a string To extract characters from the end of the string, use a negative start number
		var numero = $(this).attr("id").substr(-1);
		$(".list"+numero).show();
		$(".grid"+numero).hide(); 

		$("#btnGrid"+numero).removeClass("backColor");
		$("#btnList"+numero).addClass("backColor");
	})
}

$(window).scroll(function(){
	var scrollY = window.pageYOffset;
	//console.log("scrollY", scrollY); posición de la altura del scroll
	if (window.matchMedia("(min-width:768px)").matches) {
		if ($(".banner").html() != null) {
			if(scrollY < ($(".banner").offset().top)-150)
				$(".banner img").css({"margin-top": -scrollY/3+"px"})
			else
				scrollY = 0
		}
	} 
})

$.scrollUp({
	scrollText: "",
	scrollSpeed: 2000, //2 seg
	easingType: "easeOutQuint"
})

var pagActiva = $(".pagActiva").html();
if (pagActiva != null) {
	// la g me permite reemplazar más de un guion con el caracter vacio
	var regPagActiva = pagActiva.replace(/-/g, " ");
	$(".pagActiva").html(regPagActiva);
}

var url = window.location.href;
//console.log("url",url); url http://localhost/ecommerce/frontend/telefonos-movil/2
//method is used to split a string into an array of substrings, and returns the new array
//The pop() method removes the last element of an array, and returns that element.
//The isNaN() function determines whether a value is an illegal number (Not-a-Number).
//This function returns true if the value equates to NaN. Otherwise it returns false.
var indice = url.split("/");
var pagActual = indice.pop();

/*console.log("indice", indice[6]);
var pagSearch = indice[6];*/

if(pagActual != "#"){
	if (indice[5] == "buscador") {
		var paginador = indice[6];
		$("#item"+paginador).addClass("active");
		$("#item"+paginador+" a").removeAttr("href");
	} else if (isNaN(pagActual)) {
		$("#item1").addClass("active");
		$("#item1 a").removeAttr("href");
	} else {
		$("#item"+pagActual).addClass("active");
		$("#item"+pagActual+" a").removeAttr("href");
	}
}

$(".cerrarOfertas").click(function(){
	$(this).parent().remove();
})

//CONTADOR DE TIEMPO
/*var finOferta = $(".countdown").attr("finOferta");

$('.countdown').dsCountDown({
	endDate: new Date(finOferta),
	theme: 'black', // Set the theme 'white', 'black', 'red', 'flat', 'custom'
	titleDays: 'Días', // Set the title of days
	titleHours: 'Horas', // Set the title of hours
	titleMinutes: 'Minutos', // Set the title of minutes
	titleSeconds: 'Segundos', // Set the title of seconds
});*/

var finOferta = $(".countdown");
var fechaFinOferta = [];

for (var i = 0; i < finOferta.length; i++) {

	fechaFinOferta[i] = $(finOferta[i]).attr("finOferta");

	$(finOferta[i]).dsCountDown({
		endDate: new Date(fechaFinOferta[i]),
		theme: 'black', // Set the theme 'white', 'black', 'red', 'flat', 'custom'
		titleDays: 'Días', // Set the title of days
		titleHours: 'Horas', // Set the title of hours
		titleMinutes: 'Minutos', // Set the title of minutes
		titleSeconds: 'Segundos', // Set the title of seconds
	});
}
