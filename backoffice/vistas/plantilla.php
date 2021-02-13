<?php 
	// Al hacer esto puedo trabajar con variables de sesion en cualquier parte
	session_start(); 
	// variables generales definidas del ControladorGeneral en general.controlador.php
	$ruta=ControladorGeneral::ctrRuta();
	$valorSuscripcion=ControladorGeneral::ctrValorSuscripcion();
	$patrocinador=ControladorGeneral::ctrPatrocinador();

	// Si no existe la sesion de validarSesion
	if (!isset($_SESSION["validarSesion"])) {
		// Mandalo al ingreso
		echo '<script>
				window.location="'.$ruta.'ingreso"
			</script>';
		// Para cancelar cualquier ejecucion de codigo
		return;
	}

$item="id";//Campo id
$valor=$_SESSION["id"]; //valor del campo id
$usuario=ControladorUsuarios::ctrMostrarUsuario($item, $valor);
// echo '<pre>'; print_r($usuario); echo '</pre>';


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Backoffice | Ventas por suscripción</title>
  <link rel="icon" href="vistas/img/plantilla/icono.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--==================================
	=            vinculos css            =
	===================================-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Theme style -->
	<link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">
	<!-- overlayScrollbars -->
  	<link rel="stylesheet" href="vistas/css/plugins/OverlayScrollbars.min.css">
  	<!-- jdSlider -->
	<link rel="stylesheet" href="vistas/css/plugins/jdSlider.css">
	<!-- select2 -->
	<link rel="stylesheet" href="vistas/css/plugins/select2.min.css">
  	<!-- Estilos personalizados -->
  	<link rel="stylesheet" href="vistas/css/style.css">
  	<!-- DataTables -->
	<link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">	
	<link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">
	<!--====  End of vinculos css  ====-->

	<!--========================
	=            JS            =
	=========================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="vistas/js/plugins/adminlte.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="vistas/js/plugins/jquery.overlayScrollbars.min.js"></script>
	<!-- jdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<script src="vistas/js/plugins/jdSlider.js"></script>
	<!-- select2 -->
	<script src="vistas/js/plugins/select2.full.min.js"></script>
	<!-- inputmask -->
	<script src="vistas/js/plugins/jquery.inputmask.js"></script>
	<!-- jSignature -->
	<script src="vistas/js/plugins/jSignature.js"></script>
	<script src="vistas/js/plugins/jSignature.CompressorSVG.js"></script>
	<!-- Sweetalert -->
	<script src="vistas/js/plugins/sweetalert2.all.js"></script>
		<!-- DataTables 
	https://datatables.net/-->
  	<script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
  	<script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script> 
	<script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
  	<script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>	
	<!--====  End of JS  ====-->

</head>	

<body class="hold-transition sidebar-mini sidebar-collapse">
	<div class="wrapper">
		<?php 
			include "paginas/modulos/header.php";
			include "paginas/modulos/menu.php";
			// paginas dinamicas de inicio
				// Si viene por get pagina
				if (isset($_GET["pagina"])) {
					// Si es igual a inicio, perfil
					if ($_GET["pagina"]=="inicio" || 
						$_GET["pagina"]=="perfil" || 
						$_GET["pagina"]=="usuarios" ||
						$_GET["pagina"]=="uninivel" ||
						$_GET["pagina"]=="binaria" ||
						$_GET["pagina"]=="matriz" ||
						$_GET["pagina"]=="ingresos-uninivel" ||
						$_GET["pagina"]=="ingresos-binaria" ||
						$_GET["pagina"]=="ingresos-matriz" ||
						$_GET["pagina"]=="plan-compensacion" ||
						$_GET["pagina"]=="soporte" ||
						$_GET["pagina"]=="salir") {
						// Muestra incio
						include "paginas/".$_GET["pagina"].".php";
					}
					//Si es igual a academia
					else if ($_GET["pagina"]=="cuerpo-activo" || 
						$_GET["pagina"]=="mente-sana" || 
						$_GET["pagina"]=="espiritu-libre") {
						// Muestra incio
						include "paginas/academia.php";
					}
					// Si no encuentra esas coincidencias
					else{
						// Muestar el error
						include "paginas/error404.php";
					}

				}else{
					// Si no por default muestra inicio
					include "paginas/inicio.php";
				}
			// paginas dinamicas de inicio
			include "paginas/modulos/footer.php";
		 ?>
	</div>

	<!-- Js del slide de inicio -->
	<script src="vistas/js/inicio.js"></script>
	<!-- Scripts de usuarios -->
	<script src="vistas/js/usuarios.js"></script>

</body>

</html>