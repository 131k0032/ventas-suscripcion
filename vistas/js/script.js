/*=============================================
ANIMACIONES SCROLL HEADER
=============================================*/

$(window).scroll(function(){

	var posY = window.pageYOffset;
	
	if(posY > 10){

		$("header").css({"background":"#043248", "transition":".3s all"})


	}else{

		$("header").css({"background":"rgba(0,0,0,.1)", "transition":".3s all"})

	}

})

/*=============================================
MENÚ MÓVIL
=============================================*/

$(".logotipo .fa-bars").click(function(){

	$(".menuMovil").show("fast");

})

$(".menuMovil ul li .fa-times").click(function(){

	$(".menuMovil").hide("fast");

})

/*=============================================
CURSOS
=============================================*/

var videos = $(".cursos video");

$(".cursos video").click(function(){

	for(var i = 0; i < videos.length; i++){

		$(videos[i])[0].pause();

	}

	$(this).attr("controls",true)
	$(this)[0].play();

})

/*=============================================
FAQ
=============================================*/

var listaPreguntas = $(".faq ul li.nav-item");

$(".faq ul li.nav-item").click(function(){

	var respuesta = $(this).attr("respuesta");

	for(var i = 0; i < listaPreguntas.length; i++){

		$(listaPreguntas[i]).removeClass("bg-light");

		$(listaPreguntas[i]).children("a").children("i").removeClass("fa-chevron-left");

		$(listaPreguntas[i]).children("a").children("i").addClass("fa-chevron-right");
	
	}

	$(this).addClass("bg-light");

	$(this).children("a").children("i").removeClass("fa-chevron-right");

	$(this).children("a").children("i").addClass("fa-chevron-left");

	$(".respuestas p").html(respuesta);

})

/*=============================================
DESPLAZAMIENTO MENÚ
=============================================*/

if(window.matchMedia("(max-width:768px)").matches){

	$(".menuMovil ul li a").click(function(e){

		$(".menuMovil").slideToggle('fast');

		e.preventDefault();

		var vinculo = $(this).attr("href");

		$("html, body").animate({

			scrollTop: $(vinculo).offset().top - 60

		}, 2000, "easeOutQuint")

	})


}else{

	$(".botonera ul li a").click(function(e){

		e.preventDefault();

		var vinculo = $(this).attr("href");

		$("html, body").animate({

			scrollTop: $(vinculo).offset().top - 60

		}, 2000, "easeOutQuint")

	})

}


/*=============================================
SCROLL UP
=============================================*/

$.scrollUp({
	scrollText:"",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"
})

/*=============================================
PRELOAD
=============================================*/
var incremento = 0;

$("body").css({"overflow-y":"hidden"});

$('body').nitePreload({
	srcAttr: 'data-nite-src',
	onProgress: function(a) {

		incremento = Math.floor(a.percentage);

		$("#porcentajeCarga").html(incremento+"%");

		$("#rellenoCarga").css({"width":incremento+"%"})

		if(incremento >= 100){

			$("#preload").delay(350).fadeOut("slow");
			$("body").delay(350).css({"overflow-y":"scroll"})

		}
	
	}
});

/*=============================================
VALIDAR EMAIL REPETIDO
=============================================*/
// Capturamos el value del input hidden de plantilla.php
var ruta = $("#ruta").val();

// Tomamos el input con nombre registroEmail 
// Al cambiar ejecuta una funcion
$("input[name='registroEmail']").change(function(){
	//Ruemueve el alert depues de cada cambio del input registroEmail
	$(".alert").remove();
	// Tomamos este valor que se coloque al momento
	var email = $(this).val();
	// console.log("email", email);

	var datos = new FormData();
	// Crando variable "validarEmail" de tipo post con el value email del input
	// Se va a recibir con isset en url: ruta+"backoffice/ajax/usuarios.ajax.php",
	datos.append("validarEmail", email);

	$.ajax({

		url: ruta+"backoffice/ajax/ajax.usuarios.php",
		method: "POST",
		data: datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			// console.log("respuesta", respuesta);
			// Si encuenta coincidencias la respuesta devuelve en network>xhr o en consola un true o false
			// Si viene true;
			if (respuesta) {
				// Setea el value a nada
				$("input[name='registroEmail']").val("");
				// Y grega la alerta antes del input
				$("input[name='registroEmail']").before(`
					<div class="alert alert-danger">
						<strong>Uy </stron>Correo previamente registrado, pliz agrega otro 
					</div>`)
				return; //Para cancelar cualquier proceso js
			}
		
		}

	})

})