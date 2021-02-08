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