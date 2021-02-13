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

	/*----------  Sucripcion con paypal  ----------*/
	public $sucripcion;

	public function ajaxSuscripcion(){
		// echo "Hola";
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 300,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic QWJNU2NRVVBxbE9tamdqdXQ2cEJ1UXlVaHhCRGtHRzJMMms0SDlOVlFDN05LRjhDU29CZTVKc0FPUzRKcFN5dXZHVFRNc0ZCVDNPNk5yVDM6RU1VNW05dU1VNkZIVTdHMkJnYm9lblpTYUx3eVdTQ3lzano1NlNZcHBtTk1mbkpYLU4xVVI0cGZUd1c4azhDWnpRN2oxUjlJbW9tSDRlUjI=',
		    'Content-Type: application/x-www-form-urlencoded'
		  ),
		));

		$response = curl_exec($curl);
		$err=curl_error($curl);
		curl_close($curl);

		if ($err) {
			echo "cURL Error# :" .$err;
		}else{
			// echo $response;
			// Muestra valores json y con true captura propiedades
			$respuesta= json_decode($response, true);
			// Almacenando el access_token en una variable
			$token=$respuesta["access_token"];
			// Mostrando el token en console.log () de usuarios.js
			echo $token;
		}	

	}

}


// Creando objetos fuera de la clase para usar la funcion ajaxValidarEmail
if (isset($_POST["validarEmail"])) {
	$valEmail = new AjaxUsuarios();
	$valEmail->validarEmail=$_POST["validarEmail"];
	$valEmail->ajaxValidarEmail();
}

// Creando objetos fuera de la clase para usar la funcion sucripcionpaypal
if (isset($_POST["suscripcion"]) && $_POST["suscripcion"]=="ok") {
	$paypal = new AjaxUsuarios();
	$paypal->ajaxSuscripcion();
}