<?php 
 // Llamndo controladores y modelos de usuarios
 require_once "../controladores/usuarios.controlador.php";
 require_once "../modelos/usuarios.modelo.php";
 // Controlador de rutas
 require_once "../controladores/general.controlador.php";

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
	// Cuando capturas por post es mejor ponerlo por public
	public $sucripcion; //Viene de usuarios.js como 	datos.append("suscriocion", "ok");
	public $nombre; //Viene de usuarios.js como 	datos.append("nombre", nombre);
	public $email; //Viene de usuarios.js como 	datos.append("nombre", nombre);

	public function ajaxSuscripcion(){

		$ruta =ControladorGeneral::ctrRuta();
		$valorSuscripcion =ControladorGeneral::ctrValorSuscripcion();
		$fecha=substr(date("c"), 0, -6)."Z";
		// echo "Hola";
		/*================================================================
		=            PARA CREAR EL TOKEN CON LA API DE PAYPAL            =
		================================================================*/
		$curl1 = curl_init();

		  curl_setopt_array($curl1, array(
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

		$response = curl_exec($curl1);
		$err=curl_error($curl1);
		curl_close($curl1);

		if ($err) {
			echo "cURL Error# :" .$err;
		}else{


			// echo $response;
			// Muestra valores json y con true captura propiedades
			$respuesta1= json_decode($response, true);
			// Almacenando el access_token en una variable
			$token=$respuesta1["access_token"];
			// Mostrando el token en console.log () de usuarios.js
			 // echo $token;

				/*================================================================
			  CREANDO EL PRODUCTO CON LA API DE paypal (token anterior es necesario)
				================================================================*/
			
			$curl2 = curl_init();

			curl_setopt_array($curl2, array(
			  CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/catalogs/products',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 300,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
					  "name": "Academy of life",
					  "description": "Educacion en linea",
					  "type": "DIGITAL",
					  "category": "EDUCATIONAL_AND_TEXTBOOKS",
					  "image_url": "'.$ruta.'backoffice/vistas/img/plantilla/icono.png",
					  "home_url": "'.$ruta.'"
					}',
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Bearer '.$token.''
			  ),
			));

			$response = curl_exec($curl2);
			curl_close($curl2);
			
			if ($err) {
				echo "cURL Error# :" .$err;
			}else{
				// echo $response;
				$respuesta2= json_decode($response, true);
				// echo $respuesta2["id"];
				$idProducto=$respuesta2["id"];

				// echo $idProducto;

					 /*=======================================================================================================
					 =           	  CREANDO EL PLAN CON LA API DE paypal (id del producto anterior es necesario)            =
					 =======================================================================================================*/
					 
					  $curl3 = curl_init();

					  curl_setopt_array($curl3, array(
					  CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/billing/plans',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 300,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS =>'{
					  "product_id": "'.$idProducto.'",
					  "name": "Suscripcion mensual a Academyoflife",
					  "description": "Plan de pago mensual a Academyoflife",
					  "status": "ACTIVE",
					  "billing_cycles": [
					    {
					      "frequency": {
					        "interval_unit": "MONTH",
					        "interval_count": 1
					      },
					      "tenure_type": "REGULAR",
					      "sequence": 1,
					      "total_cycles": 99,
					      "pricing_scheme": {
					        "fixed_price": {
					          "value": "'.$valorSuscripcion.'",
					          "currency_code": "USD"
					        }
					      }
					    }
					  ],
					  "payment_preferences": {
					    "auto_bill_outstanding": true,
					    "setup_fee": {
					      "value": "'.$valorSuscripcion.'",
					      "currency_code": "USD"
					    },
					    "setup_fee_failure_action": "CONTINUE",
					    "payment_failure_threshold": 3
					  },
					  "taxes": {
					    "percentage": "0",
					    "inclusive": false
					  }
					}',
					  CURLOPT_HTTPHEADER => array(
					    'Content-Type: application/json',
					  'Authorization: Bearer '.$token.''
					  ),
					));

					$response = curl_exec($curl3);
					curl_close($curl3);

					if ($err) {
						echo "cURL Error# :" .$err;
						}else{
						// echo $response;
							// echo $response;

							/*=======================================================================================================
							=            CREANDO LA SUSCRIPCION CON LA API DE paypal (id del plan anterior es necesario)            =
							=======================================================================================================*/
							
							$respuesta3= json_decode($response, true);
							// echo $respuesta2["id"];
							$idPlan=$respuesta3["id"];
							// echo $idPlan;
							$curl4 = curl_init();


								  curl_setopt_array($curl4, array(
								  CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions',
								  CURLOPT_RETURNTRANSFER => true,
								  CURLOPT_ENCODING => '',
								  CURLOPT_MAXREDIRS => 10,
								  CURLOPT_TIMEOUT => 300,
								  CURLOPT_FOLLOWLOCATION => true,
								  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								  CURLOPT_CUSTOMREQUEST => 'POST',
								  CURLOPT_POSTFIELDS =>'{
								  "plan_id": "'.$idPlan.'",
								  "start_time": "'.$fecha.'",
								  "subscriber": {
								    "name": {
								      "given_name": "'.$this->nombre.'"
								    },
								    "email_address": "'.$this->email.'"
								  },
								  "auto_renewal":true,
								  "application_context": {
								    "brand_name": "Academy of life",
								    "locale": "en-US",
								    "shipping_preference": "SET_PROVIDED_ADDRESS",
								    "user_action": "SUBSCRIBE_NOW",
								    "payment_method": {
								      "payer_selected": "PAYPAL",
								      "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
								    },
								    "return_url": "'.$ruta.'backoffice/index.php?pagina=perfil",
								    "cancel_url": "'.$ruta.'backoffice/index.php?pagina=perfil"
								  }
								}',
								  CURLOPT_HTTPHEADER => array(
								    'Content-Type: application/json',
								     'Authorization: Bearer '.$token.''
								  ),
								));

								$response = curl_exec($curl4);
								curl_close($curl4);

								if ($err) {
									echo "cURL Error# :" .$err;
									}else{
										// echo $response;
										$respuesta4= json_decode($response, true);
										// echo $respuesta2["id"];
										/*links[0]["href"]= a linkns:https://www.sandbox.paypal.com/webapps/billing/subscriptions?ba_token=BA-97A17027A6139401V
										 "links": [
										        {
										            "href": "https://www.sandbox.paypal.com/webapps/billing/subscriptions?ba_token=BA-97A17027A6139401V",
										            "rel": "approve",
										            "method": "GET"
										        }*/
										$urlPaypal=$respuesta4["links"][0]["href"];
										// echo '<pre>'; print_r($respuesta4); echo '</pre>';
										echo $urlPaypal;
									}
								

					}
					

			}
		


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
	$paypal->nombre=$_POST["nombre"]; //Viene de usuarios.js como 	datos.append("nombre", nombre);
	$paypal->email=$_POST["email"]; //Viene de usuarios.js como 	datos.append("email", email);
	$paypal->ajaxSuscripcion();
}

// Todo lo de sandbox puedes verlo documentado en el archivo api.paypal.html