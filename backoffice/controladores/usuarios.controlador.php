<?php 

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
	}

