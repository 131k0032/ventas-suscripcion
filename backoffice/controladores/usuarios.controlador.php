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
	}
