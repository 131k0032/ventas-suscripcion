<?php 
 // Llamndo controladores y modelos de usuarios
 require_once "../controladores/usuarios.controlador.php";
 require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{
	/*----------  Vlidar email existente  ----------*/

	public $validarEmail;

	public function ajaxValidarEmail(){
			$item="email";
			$datos = $this->validarEmail;
			$respuesta=ControladorUsuarios::ctrMostrarUsuario($item,$datos);
			echo json_encode($respuesta); //Retornamos al archivo script.js
	}
	
}

// Creando objetos fuera de la clase para usar la funcion ajaxValidarEmail
if (isset($_POST["validarEmail"])) {
	$valEmail = new AjaxUsuarios();
	$valEmail->validarEmail=$_POST["validarEmail"];
	$valEmail->ajaxValidarEmail();
}