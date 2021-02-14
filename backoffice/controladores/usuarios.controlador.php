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

				//Encriptandopassword
				$encriptar = crypt($_POST['registroPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$emailEncriptado=md5($_POST["registroEmail"]);
				$tabla="usuarios";
				$datos=array(
							"perfil"=>"usuario",
							"nombre"=>$_POST["registroNombre"],
							"email"=>$_POST["registroEmail"],
							"password"=>$encriptar,
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

				//Encriptandopassword
				$encriptar = crypt($_POST['ingresoPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				// Lanzamos la consutlta con estos parametros
				$tabla="usuarios";
				$item="email";//CAMPO
				$valor=$_POST["ingresoEmail"];
				$respuesta=ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

				// Si lo que se obtiene de la consulta es igual al email y al pass que ingresa el user
				if($respuesta["email"]==$_POST["ingresoEmail"] && $respuesta["password"]==$encriptar){

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

	/*----------  CAMBIAR FOTO DE PERFIL  ----------*/
	public function ctrCambiarFotoPerfil(){
		// Ve si viene por post  del modal info-usuario.php
		if(isset($_POST["idUsuarioFoto"])){
			// tomamos la ruta actual de la foto este es un input hidden
			$ruta = $_POST["fotoActual"];
			// Si existe la imagen y no está vacia 
			if(isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])){
				// obtenemos el alto y ancho
				list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);
				// Establecemmos un nuevo alto y ancho
				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/

				$directorio = "vistas/img/usuarios/".$_POST["idUsuarioFoto"];

				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD Y EL CARPETA
				=============================================*/
				// Si lo que viene de post ruta es diferente de vacio
				if($ruta != ""){
					// Borramos
					unlink($ruta);
				}else{
					// Si no esxte el directorio creado
					if(!file_exists($directorio)){	
						// Lo creamos
						mkdir($directorio, 0755);
					}
				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/
				// Si es tipo jpeg
				if($_FILES["cambiarImagen"]["type"] == "image/jpeg"){
					// Genramos numeros aleatorios
					$aleatorio = mt_rand(100,999);
					// ponemos la ruta donde se va a guardar
					$ruta = $directorio."/".$aleatorio.".jpg";
					// de donde viene la img
					$origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);
					// donde guarar y como
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					// redimensionamos
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					// guardamos
					imagejpeg($destino, $ruta);	


				}else if($_FILES["cambiarImagen"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta = $directorio."/".$aleatorio.".png";
					$origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);	
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	
					imagealphablending($destino, FALSE);
					imagesavealpha($destino, TRUE);		
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);		
					imagepng($destino, $ruta);

				}else{
					// Si no es de tipo imagen el archivo
					echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}
			
			}

			// final condicion

			$tabla = "usuarios";
			$id = $_POST["idUsuarioFoto"];
			$item = "foto";
			$valor = $ruta;

			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
			if($respuesta == "ok"){

				echo '<script>
					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡La foto de perfil ha sido actualizada!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"					  
					}).then(function(result){
						if(result.value){   
						    history.back();
						  } 
					});
				</script>';


			}

		}

	}



	/*----------  CAMBIAR PASSWORD  ----------*/
	public function ctrCambiarPassword(){
		if (isset($_POST["idUsuarioPassword"])) {
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

				$tabla = "usuarios";
				$id = $_POST["idUsuarioPassword"];
				$item = "password";//Campo de bd
				$encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$valor = $encriptar; //viene de info-usuario.php

				$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
				if($respuesta == "ok"){

					echo '<script>
						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡La contraseña ha sido actualizada!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"					  
						}).then(function(result){
							if(result.value){   
							    history.back();
							  } 
						});
					</script>';


					}
			}else{
				echo '<script>
						swal({
							type:"error",
						  	title: "Incorrecto!",
						  	text: "¡Caracteries especiales no permitidos!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"					  
						}).then(function(result){
							if(result.value){   
							    history.back();
							  } 
						});
					</script>';
			}

		}

	}


	/*----------  RECUPERAR PASS  ----------*/
	public function ctrRecuperarPassword(){
		// Si viene por port emailRecuperarPassword
		if (isset($_POST["emailRecuperarPassword"])) {
				// Validamos con preg_match
				if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z0-9]{2,4}$/', $_POST["emailRecuperarPassword"])) {

				// Generar pass aleatorio
					function generarPassword($longitud){
						// La iniciamos vacía
						$password="";
						$patron="1234567890abcdefghijklmnopqrstuvwzyz";
						$max=strlen($patron)-1;

						for ($i=0; $i <$longitud ; $i++) { 
							$password .= $patron{mt_rand(0,$max)};
						}
						return $password;
					}
					// Genera un pass de tamaño 11
					$nuevoPassword=generarPassword(11);
					$encriptar = crypt($nuevoPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					// Consultamos si existe el email en bd
					$tabla="usuarios";
					$item="email";
					$valor=$_POST["emailRecuperarPassword"];

					$traerUsuario=ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
					
					// Si existe el user con ese email
					if ($traerUsuario) {

						$tabla="usuarios";
						$id=$traerUsuario["id"];
						$item="password";
						$valor=$encriptar;

						$actualizarPassword=ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

							// Si se actualiza
							if($actualizarPassword=="ok"){
								// Enviando email
								// Para redirigir al user
								$ruta=ControladorRuta::ctrRuta();
								date_default_timezone_set("America/Cancun");//Zona hooraria en al que se manda el correo
								$mail = new PHPmailer;
								$mail->CharSet = 'UTF-8';
								$mail->isMail();
								$mail->setFrom('masterchief22010@hotmail.com','La mera reata jeje'); //De donde se envia la info
								$mail->addReplyTo('masterchief22010@hotmail.com','La mera reata jeje');//Por si necesitan responder
								$mail->Subject = "Solicitud de nueva contraseña";
								$mail->addAddress($traerUsuario["email"]);// a quien se envia el correo
								$mail->msgHTML('
									<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
											<center>												
												<img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">
											</center>
											<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
												<center>												
												<img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-pass.png">
												<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>
												<hr style="border:1px solid #ccc; width:80%">
												<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevoPassword.'</h4>
												<a href="'.$ruta.'ingreso" target="_blank" style="text-decoration:none">
												<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">		
													Haz click aquí
												</div>
												</a>
												<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>
												<br>
												<hr style="border:1px solid #ccc; width:80%">
												<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
												</center>
											</div>
										</div>');

								$envio=$mail->Send();
								// Si no se envia
								if(!$envio){
									echo '<script>
									swal({
										type:"error",  
										title: "¡No se ha podido enviar el correo a '.$traerUsuario["email"].' '.$mail->ErrorInfo.' intenta nuevamente ",
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
										title: "¡SU NUEVA CONTRASEÑA HA SIDO CREADA CORRECTAMENTE!",
										text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar ver su nueva contraseña!",
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

						// Si no existe	
						}else{
							echo '<script>
							swal({
								type:"error",
							  	title: "Error!",
							  	text: "Email inexistente en el sistema",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"					  
							}).then(function(result){
								if(result.value){   
								    history.back();
								  } 
							});
						</script>';
					}


				// Sino mandar el error
				}else{
					echo '<script>
							swal({
								type:"error",
							  	title: "Incorrecto!",
							  	text: "¡Caracteries especiales no permitidos!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"					  
							}).then(function(result){
								if(result.value){   
								    history.back();
								  } 
							});
						</script>';
				}
		}

	}


static public function ctrIniciarSuscripcion($datos){

	$tabla="usuarios";
	$respuesta=ModeloUsuarios::mdlIniciarSuscripcion($tabla,$datos);
	return $respuesta; //Mandalo a formulario-suscripcion.php

	}

}