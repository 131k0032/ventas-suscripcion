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
		// Si todo sale bien en cuanto a validación de usuarios sucede esto
		// console.log("formulario listo");
		// Para envio de datos post
		var datos=new FormData();
		datos.append("suscripcion", "ok");
		datos.append("nombre", nombre); //Viene de VALIDAR CAMPOS DE SUSCRIPCION
		datos.append("email", email);  //Viene de VALIDAR CAMPOS DE SUSCRIPCION


			$.ajax({
				url:"ajax/ajax.usuarios.php",
				method: "POST",
				data: datos,
				cache:false,
				contentType:false,
				processData:false,
				//dataType:"json", //evita el error array to string conversion usando el echo $respuesta2; y no echo $respuesta2["id"];
				// Antes de que se envie el success (esto es un preload )
				beforeSend:function(){
					// Antes de suscribirse, antes del boton suscribirse pon esta imagen
					$(".suscribirse").after(`
						<img src="vistas/img/plantilla/status.gif" class="ml-3" style="width:30px; height:30px;" alt="">
						<span class="alert alert-warning">Procesando la suscripción, no cierres la página</span>
					`)
				},

				success:function(respuesta){
					// console.log("respuesta", respuesta);

					/*Redirige al href=https://www.sandbox.paypal.com/webapps/billing/subscriptions?ba_token=BA-97A17027A6139401V
					que viene de $urlPaypal=$respuesta4["links"][0]["href"]; de ajax.usuarios.php*/
					window.location=respuesta;
					/*A partir de aqui podemos ver que se redirige a la pagina de pago y podemos hacer el pago con la cuenta 
					ficticia de @personal.example.com* no con la de bussines, podremos observar que despues de eso nos redirige a 
					http://academyoflife.com/backoffice/index.php?pagina=perfil&subscription_id=I-0NT6HGVP2AEP&ba_token=BA-17751414368386204&token=6NP623964C097044A
					donde podemos observar un subscription_id que será necesario capturar*/

				}
			})
		}
	})

/*----------  INICIANDO DATA TABLES  ----------*/
// Esto es solo para ver que tabla-usuarios.ajax.php se conectó correctamente
$.ajax({
	url:"ajax/tabla-usuarios.ajax.php",
	success:function(respuesta){
		// console.log("respuesta", respuesta);

	}
})

$(".tablaUsuarios").DataTable({
	// Con esta linea de codigo jalamos los datos json de tabla-usuarios.php
	"ajax":"ajax/tabla-usuarios.ajax.php", //Puedes comentar esta linea
	// Mas propiedades de velocidad de ejecucion
	"deferRender": true, //Tambien comentar esta
  	"retrieve": true, //Comentar esta
  	"processing": true, //Comentar esta por si no quieres manejarlo con datos json,da lo mismo si los recorres directo en usuarios.php que en tabla.usuarios.ajax.php
	// Traduciendo al espanish
	"language": {

	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	      "sFirst":    "Primero",
	      "sLast":     "Último",
	      "sNext":     "Siguiente",
	      "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }

   }
});