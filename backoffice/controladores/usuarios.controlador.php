<?php 
// LLamando a las clases de PHPmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ControladorUsuarios{

	/*----------  Registro de usuarios  ----------*/
	
	public function ctrRegistroUsuario(){

		// Si existe post registroNombre
		if (isset($_POST["registroNombre"])) {
			// Para redirigir al user
			$ruta=ControladorRuta::ctrRuta();
			// Si cumple el pregmatch
			if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z0-9]{2,4}$/', $_POST["registroEmail"]) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])) {
				
				$emailEncriptado=md5($_POST["registroEmail"]);
				$tabla="usuarios";
				$datos=array(
							"perfil"=>"usuario",
							"nombre"=>$_POST["registroNombre"],
							"email"=>$_POST["registroEmail"],
							"password"=>$_POST["registroPassword"],
							"suscripcion"=>0,
							"verificacion"=>0,
							"email_encriptado"=>$emailEncriptado,
							"patrocinador"=>$_POST["patrocinador"]

					);

				$respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);
				// echo '<pre>'; print_r($respuesta); echo '</pre>';
				// $respuesta->mdlRegistroUsuario();
				

					if($respuesta=="ok"){
						// Enviando email
						date_default_timezone_set("America/Cancun");//Zona hooraria en al que se manda el correo
						$mail = new PHPmailer;
						$mail->CharSet = 'UTF-8';
						$mail->isMail();
						$mail->setFrom('masterchief22010@hotmail.com','La mera reata jeje'); //De donde se envia la info
						$mail->addReplyTo('masterchief22010@hotmail.com','La mera reata jeje');//Por si necesitan responder
						$mail->Subject = "Por favor checa tu correo";
						$mail->addAddress($_POST["registroEmail"]);// a quien se envia el correo
						$mail->msgHTML('
							<div style="width: 100%; background:#eee; position: relative; font-family: sans-serif; padding-bottom:40px;">
									<center>
										<img style="padding:20px; width: 10px;" src="http://tutorialesatualcance.com/tienda/logo.png" alt="">
									</center>

									<div style="position: relative; margin:auto; width: 600px; background: white; padding: 20px;">
										<center>
											<img style="padding: 20px; width: 15%;" src="http://tutorialesatualcance.com/tienda/icon-email.png" alt="">
											<h3 style="font-weight: 100; color: #999">Verifica tu correo men</h3>
											<hr style="border: 1px solid #ccc; width: 80%;">
											<h4 style="font-weight: 100; color: #999; padding: 0 20px;">Para usar su cienta de tienda virtual debes confirmar tu cuenta pliz</h4>

											<a href="'.$ruta.$emailEncriptado.'" target="_blank" style="text-decoration: none;">
												<div style="line-height: 60px; background: #0aa; width: 60%; color: white;" >Verifica tu correo electronico</div>
											</a>

											<br>

											<hr style="border: 1px solid #ccc; width: 80%;">
											<h5 style="font-weight: 100; color: #999;">Si no te inscribiste en este sitio omite el correo y se va eliminar jeje</h5>
										</center>
									</div>

								</div>');

						$envio=$mail->Send();
						// Si no se envia
						if(!$envio){
							echo '<script>
							swal({
								type:"error",  
								title: "¡No se ha podido enviar el correo a '.$_POST["registroEmail"].' '.$mail->ErrorInfo.' intenta nuevamente ",
								text: "¡Escriba bien sus datos plis!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
									history.back();
								}
							});	
						</script>';
						}else{
							echo '<script>
							swal({
								type:"success",
								title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
								text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta!",
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
						
			// Si no cumple con el pregmatch
			}else{
				echo '<script>
							swal({
								type:"error",  
								title: "¡CARACTERES ESPECIALES NO PERMITIDOS!",
								text: "¡Escriba bien sus datos plis!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
									window.location = "'.$ruta.'registro";
								}
							});	
						</script>';
					}
			}
		}

		/*----------  Registro de usuarios  ----------*/
		// $item=nombre de la columna
		// $valor=valor de esa columna
		static public function ctrMostrarUsuario($item, $valor){
			$tabla="usuarios";
			$respuesta=ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
			return $respuesta;//Retorna respuesta al archivo de ajax.usuarios.php
		}


		/*----------  Actualizar  usuarios  ----------*/
		// $item=nombre de la columna
		// $valor=valor de esa columna
		static public function ctrActualizarUsuario($id, $item, $valor){
			$tabla="usuarios";
			$respuesta=ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
			return $respuesta;//Retorna respuesta al archivo de ajax.usuarios.php
		}


		/*----------  Ingreso usuarios ----------*/
		public function ctrIngresoUsuario(){
			// Si el usuario llena el input con su email y pass CORRECTAMENTE
			if (isset($_POST["ingresoEmail"])) {
				if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z0-9]{2,4}$/', $_POST["ingresoEmail"]) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])) {

				// Lanzamos la consutlta con estos parametros
				$tabla="usuarios";
				$item="email";//CAMPO
				$valor=$_POST["ingresoEmail"];
				$respuesta=ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

				// Si lo que se obtiene de la consulta es igual al email y al pass que ingresa el user
				if($respuesta["email"]==$_POST["ingresoEmail"] && $respuesta["password"]==$_POST["ingresoPassword"]){

						// Si esto coincide, comprobamos si el user ya verificado 0=no 1=si
						if($respuesta["verificacion"]==0){
							echo '<script>
								swal({
									type:"error",  
									title: "¡Checa tu correo",
									text: "¡Verifica tu cuenta de correo en tu bandeja!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
										history.back();
									}
								});	
							</script>';
							// Con return cancelamos todo lo que ocurra luego jeje
							return;
						// Si está verificado mandalo al backoffice
						}else{
							// Inicio de variables de sesion
							$_SESSION["validarSesion"]="ok";//Para ver si se inicia sesion
							$_SESSION["id"]=$respuesta["id"];//Campo id de la consulta $respuesta::mdlMostrarUsuario

							// Para redirigir al user
							$ruta=ControladorRuta::ctrRuta();
							echo '<script>
								window.location="'.$ruta.'backoffice"
							</script>';
						}

					// Si no es igual dile ps que no coinciden
					}else{

						echo '<script>
							swal({
								type:"error",  
								title: "¡Email y pass no coinciden!",
								text: "¡Escriba bien sus datos pliz nada coincide!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
									history.back();
								}
							});	
						</script>';
				}
			// Si no lo llena CORRECTAMENTE o pone caracteres no permitidos
			}else{
				echo '<script>
							swal({
								type:"error",  
								title: "¡CARACTERES ESPECIALES NO PERMITIDOS!",
								text: "¡Escriba bien sus datos plis!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
									window.location = "'.$ruta.'registro";
								}
							});	
						</script>';
			}
		}
	
	}

}