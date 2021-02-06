<?php 

include "modulos/preload.php";
// Si existe var post idioma
if (isset($_POST["idioma"])) {
	// Si esa variable es igual a español
	if ($_POST["idioma"]=="es") {
		// Agrega el default que es español
		include "modulos/header.php";
		// Si no ps, agrega el que es igual a ingles
		}else{

		include "modulos/header_en.php";
	}
}else{
	// Si no vairables post ps dejalo al español
	include "modulos/header.php";
}


include "modulos/menu-movil.php";
include "modulos/hero.php";
include "modulos/cursos.php";
include "modulos/nosotros.php";
include "modulos/testimonios.php";
include "modulos/planes.php";
include "modulos/faq.php";
include "modulos/footer.php";