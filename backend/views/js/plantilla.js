$('input').iCheck({
	checkboxClass: 'icheckbox_square-blue',
	radioClass: 'iradio_square-blue',
	increaseArea: '20%' // optional
});
/*jquery knob*/
$('.knob').knob();
$('.sidebar-menu').tree();
$('.my-colorpicker').colorpicker();

//Tags Input
$(".tagsInput").tagsinput({
	maxTags: 10,
	confirmKeys: [44],
	cancelConfirmKeysOnEmpty: false,
	trimValue: false
})

$(".bootstrap-tagsinput").css({
	"padding":"11px",
	"width":"100%",
	"border-radius":"1px"
})

$('.datepicker').datepicker({
	format: 'yyyy-mm-dd 23:59:59',
	startDate: '0d',
	autoclose: true
})

//CORRECCIÓN BOTONERAS OCULTAS BACKEND 
 
if(window.matchMedia("(max-width:767px)").matches){
 
     $("body").removeClass('sidebar-collapse');
 
}else{
 
    $("body").addClass('sidebar-collapse');
 
}
