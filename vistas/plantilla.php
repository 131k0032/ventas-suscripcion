<?php 
	// Al hacer esto puedo trabajar con variables de sesion en cualquier parte
	// Recuerda iniciar sesion en plantilla del backoffice y del frontend
	session_start(); 
	// Retornando la vairable ruta
	$ruta=ControladorRuta::ctrRuta(); 
	// echo '<pre>'; print_r($ruta); echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Academy of life</title>
	<!-- Con este codigo agreamos al atributo href la opcion vistas/ -->
	<base href="vistas/">

	<link rel="icon" href="img/icono.png">

	<!--=====================================
	VÍNCULOS CSS
	======================================-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Fuente Open Sans -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Roboto:100|Grand+Hotel" rel="stylesheet">
	<!-- Hoja Estilo Personalizada -->
	<link rel="stylesheet" href="css/style.css">

	<!--=====================================
	VÍNCULOS JAVASCRIPT
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<!-- https://easings.net/es# -->
	<script src="js/plugins/jquery.easing.js"></script>

	<!-- https://markgoodyear.com/labs/scrollup/ -->
	<script src="js/plugins/scrollUP.js"></script>

	<!-- https://www.jqueryscript.net/loading/Handle-Loading-Progress-jQuery-Nite-Preloader.html -->
	<script src="js/plugins/jquery.nite.preloader.js"></script>
	<!-- Sweet alert -->
	<script src="js/plugins/sweetalert2.all.js"></script>

</head>

<body>

<?php 
// Si viene en la url var pagina
if(isset($_GET["pagina"])){
	
	// validar correo
	$item="email_encriptado"; //Campo en bd
	$valor=$_GET["pagina"];

	$validarCorreo=ControladorUsuarios::ctrMostrarUsuario($item, $valor);

	// Si la url es igual al resultado de la consulta
	if(isset($validarCorreo["email_encriptado"])==$_GET["pagina"]){

		$id=$validarCorreo["id"];
		$item="verificacion";
		$valor=1;

		$respuesta=ControladorUsuarios::ctrActualizarUsuario($id, $item, $valor);

		if($respuesta=="ok"){
			echo '<script>
					swal({
						type:"success",
						title: "¡SU CUENTA HA SIDO VERIICADA CORRECTAMENTE!",
						text: "¡Por favor YA PUEDES ENTRAR!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){

						if(result.value){
							window.location = "'.$ruta.'ingreso";
						}
					});	
				</script>';	
		}

	}
	
	# ======  VALIDAR ENLACE DE AFILIADO  ======= #

	$validarEnlace=ControladorUsuarios::ctrMostrarUsuario("enlace_afiliado", $_GET["pagina"]);

	if ($_GET["pagina"] == isset($validarEnlace["enlace_afiliado"]) && isset($validarEnlace["suscripcion"])==1) {
		// Cookie de 7 dias
		setcookie("patrocinador", $validarEnlace["enlace_afiliado"], time()+ 608400, "/");
		include "paginas/inicio.php"; 

		}else if($_GET["pagina"]=="inicio" ){// Si es igual a inicio
			// Carga el archivo de inicio
			include "paginas/inicio.php"; 
		}else if($_GET["pagina"]=="ingreso"){// Si pagina es igual a ingreso
			if(isset($_POST["idioma"])){
				if ($_POST["idioma"]=="es") {
					include "paginas/ingreso.php"; 
				}else{
					include "paginas/ingreso_en.php"; 
				}
			}else{
				// Default español
				include "paginas/ingreso.php"; 	
			}
		}else if($_GET["pagina"]=="registro"){// Si pagina es igual a ingreso
			if(isset($_POST["idioma"])){
				if ($_POST["idioma"]=="es") {
					include "paginas/registro.php"; 
				}else{
					include "paginas/registro_en.php"; 
				}
			}else{
				// Default español
				include "paginas/registro.php"; 	
			}
	}else{
		include "paginas/inicio.php"; 
	}


}else{

	// Si no hay vairables get, solo carga el inicio
	include "paginas/inicio.php";
}
	

?>


<!-- Valor oculto que manda la ruta actual para vincular con script.js y ajax-->
<input type="hidden" value="<?php echo $ruta; ?>" id="ruta">

<!-- Script general -->
<script src="js/script.js"></script>
</body>

</html>
