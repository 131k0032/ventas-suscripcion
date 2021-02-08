/*----------  LISTAOD DE PAISES  ----------*/
$.ajax({
	// Ruta del archivo json
	url:"vistas/js/plugins/paises.json",
	type:"GET",
	success: function(respuesta){
		// console.log("respuesta", respuesta);

		// Recorriendo  la funcion 
		respuesta.forEach(seleccionarPais);


		function seleccionarPais(item, index){

			// console.log("item", item.name);
			// Name es un atributo del archivo json
			var pais=item.name;
			var codPais=item.code;
			var dial=item.dial_code;

			// Agregamos en el option los valores
			$("#inputPais").append(
				'<option value="'+pais+','+codPais+','+dial+'">'+pais+'</option>'
			);

		}

	}

})


/*----------  SELECT 2  ----------*/
$('.select2').select2();

/*----------  CAMBIAR CODIGO DE PAIS  ----------*/
// Cuando el inputPais cambien
$("#inputPais").change(function(){
	// el select .dialCode tendrá un valor separado por comas y tomará la posicion [2]=dial
	// $this=tomará el valor de #inputPais o sea pais+codPais+dial
	// Split(",")[2], divide el string y toma la posicion 2=dial
	$(".dialCode").html($(this).val().split(",")[2])
	// $(".dialCode").html($(this).val().split(",")[2])
})

/*----------  INPUTMASK  ----------*/
$('[data-mask]').inputmask();

/*----------  FIRMA DIGITAL   ----------*/
$("#signatureparent").jSignature({

  color:"#333", // line color
  lineWidth:1, // Grosor de línea
  // Ancho y alto área de la firma
  idth:320,
  height:100

});

// Cuado quiera volver a firmar, al darle clic en el boton .repetir firma
$(".repetirFirma").click(function(){
	// Toma el valor de la firma y lo resetea
	$("#signatureparent").jSignature("reset");

})

/*----------  VALIDAR CAMPOS DE SUSCRIPCION  ----------*/
// Al darle clic al boton .suscribirse del form
$(".suscribirse").click(function (){

	// Remueve el alert al dar clic en el boton suscribirse
	$(".alert").remove();

	var nombre = $("#inptName").val();
	// console.log("nombre", nombre);
	var email = $("#inputEmail").val();
	// console.log("email", email);
	var patrocinador = $("#inputPatrocinador").val();
	// console.log("patrocinador", patrocinador);
	var enlace_afiliado = $("#inputAfiliado").val();
	// console.log("enlace_afiliado", enlace_afiliado);
	var pais = $("#inputPais").val().split(",")[0];//[0]Contiene el pais
	// console.log("pais", pais);
	var codigo_pais = $("#inputPais").val().split(",")[1];//[1]Contiene el codigo
	// console.log("codigo_pais", codigo_pais);
	var telefono_movil = $("#inputPais").val().split(",")[2]+" "+$("#inputMovil").val(); [2]//codigo del pais+el telefono
	// console.log("telefono_movil", telefono_movil);
	var red = $("#tipoRed").val();
	// console.log("red", red);
	var aceptarTerminos = $("#aceptarTerminos:checked").val();//Si esta chekeado
	// console.log("aceptarTerminos", aceptarTerminos);

	// Validamos la firma
	if($("#signatureparent").jSignature("isModified")){
		// Almacenamos el codigo svg en una variable
		var firma = $("#signatureparent").jSignature("getData", "image/svg+xml");
		// console.log("firma", firma);

	}

	// Validamos informacion de los campos
	if( nombre == "" ||
		email == "" ||
		patrocinador == "" ||
		enlace_afiliado == "" ||
		pais == "" ||
		codigo_pais == "" ||
		telefono_movil == "" ||
		red == "" ||
		aceptarTerminos != "on" ||
		//Si no es modificada el espacio de firma
		!$("#signatureparent").jSignature('isModified')){

			// Mostramos un alert antes del boton suscribirse
			$(".suscribirse").before(`

				<div class="alert alert-danger">Faltan datos, no ha aceptado o no ha firmado los términos y condiciones</div>


			`);

		// Retorna y no deja avanzar
		return;


	}else{
		// Si todo sale bien
		console.log("formulario listo");
	}
})