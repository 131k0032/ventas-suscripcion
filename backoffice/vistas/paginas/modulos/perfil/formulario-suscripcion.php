<!-- Si el usuario no está suscrito, 0=no suscrito 1=sucrito -->

<?php if($usuario["suscripcion"]==0): ?>

<div class="col-12 col-md-8">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h5 class="m-0 text-uppercase text-secondary">
				<!-- $valorSuscripcion viene de plantilla.php -->
				<strong>Suscripción de $<?php echo $valorSuscripcion;  ?> mensual</strong>
			</h5>
		</div>

		<div class="card-body">
			<h6 class="card-title">Acceso a todo el contenido educativo</h6>
			<br>
			<p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati, voluptas culpa, quia sapiente, eligendi maxime ut dicta similique deserunt excepturi fuga architecto nesciunt, temporibus reiciendis explicabo quo ab? Hic, facere.
			Modi fugiat, doloremque vero adipisci iusto quo excepturi ad consequuntur, ex minus, molestiae temporibus optio possimus cumque aliquam. Eius, qui aut veritatis itaque hic velit aliquid quis maiores, perspiciatis quo. <a href="plan-compensacion">Plan de compensación</a>
			</p>

			<div class="form-group">
				<label for="inputName" class="control-label">Nombre completo</label>
				<div>
					<input type="text" class="form-control" id="inputName" value="<?php echo $usuario["nombre"]; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail" class="control-label">Correo electrónico</label>
				<div>
					<input type="email" class="form-control" id="inputEmail" value="<?php echo $usuario["email"]; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="inputPatrocinador" class="control-label">Patrocinador</label>
				<div>
					<input type="text" class="form-control" id="inputPatrocinador" value="<?php echo $usuario["patrocinador"]; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="inputAfiliado" class="control-label">Afiliado</label>
				<span>(Compartiendo este enlace podrá ganar comisiones, más info en <a href="plan-compensacion">Plan de compensación</a>)</span>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="p-2 bg-info rounded-left">http://academyoflife.com/</span>
					</div>
					<!-- Primero deja en minusculas todos los caracteres -->
					<!-- Luego reemplaza los espacion vacios por guiones lo que venga de $usuario["nombre"]-->
					<!-- strtolower( str_replace(" ", "-", $usuario["nombre"])); -->
					<!-- Y concatenamos con el id del user -->
					<input type="text" class="form-control" id="inputAfiliado" value="<?php echo strtolower( str_replace(" ", "-", $usuario["nombre"]))."-".$usuario["id"]; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="inputPais" class="control-label py-1">Pais</label>
				<div>
					<select class="form-control select2" name="" id="inputPais">
						<option value="">Seleccionar pais</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="inputMovil" class="control-label">Número de telefono</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="p-2 bg-info rounded-left dialCode">+57</span>
					</div>
					<input type="text" class="form-control" id="inputMovil" data-inputmask="'mask':'(999) 999-9999'" data-mask>
				</div>
			</div>

			<div class="form-group">
				<label for="tipoRed" class="control-label">Tipo de red</label>
				<div>
					<select class="form-control" name="" id="tipoRed">
						<option value="">Seleccionar tipo de red</option>
						<option value="uninivel">Red uninivel</option>
						<option value="binaria">Red binaria</option>
						<option value="matriz">Red matriz</option>
					</select>
				</div>
			</div>

			<div class="form-group pb-4">
				<div class="col-sm-offset-2">
					<div class="checkbox">
						<input type="checkbox" id="aceptarTerminos">
						<label for="aceptarTerminos">
							<span></span>Yo acepto y firmo los <a href="#terminos" data-toggle="collapse">Términos y condiciones</a>
						</label>
						<a href="#terminos" data-toggle="collapse" ><span class="float-left float-xl-right text-info"><strong>Ver y firmar términos y condiciones</strong></span></a>
					</div>	
				</div>
			</div>
			<!--==============================
			=            Contrado            =
			===============================-->
			<!-- Para quitar elementos flotantes como float-xl o float-left se usa clearfix -->
			<div class="clearfix">
				<div class="collapse pb-4" id="terminos">
					<div class="card">
						<div class="card-body">
							Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, sequi, illo! Labore autem, ducimus modi aperiam ratione porro saepe, ipsum in, consectetur, ab qui. Nulla hic non iste unde maiores.
							Accusantium voluptatum animi alias at tenetur fugit aperiam id quibusdam, adipisci et temporibus assumenda, vel dignissimos, omnis. Fuga et ducimus enim sint, officiis tempore tenetur dicta, delectus quibusdam officia cumque.
							Mollitia illum reprehenderit, dolor, enim labore ad eveniet, facilis distinctio ab nostrum debitis atque consectetur fuga repudiandae ratione iusto est, reiciendis! Cumque nihil totam, maxime reiciendis dolor! Temporibus, minus, natus.
							Magnam cum quis numquam, aliquam suscipit impedit eos, repudiandae quam nostrum fugiat voluptatum, accusamus inventore modi vitae magni placeat? Sequi similique tempore porro, assumenda aliquam id reiciendis sunt voluptatum magni.
						</div>

						<div class="card-header">
							<a data-toggle="collapse" href="#collapse1" class="card-link">
								Definiciones del contrato
							</a>
						</div>

						<div class="collapse show" id="collapse1" data-parent="#accordion">
							<div class="card-body">
								Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis tenetur dicta hic temporibus, repellendus, nihil odio illum culpa distinctio harum exercitationem. Incidunt dolore ad dolor. Fugiat pariatur quae, tenetur blanditiis.
								Cumque aliquid corporis dolore, exercitationem repellendus hic! Assumenda atque facere velit nemo itaque et enim quis quae rem doloremque rerum eos, similique eius hic quidem explicabo cupiditate inventore neque reprehenderit.
							</div>

							<!-- Collapse dos -->
							<div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#collapse2">
									Acuerdos
								</a>	
							</div>

							<div class="collapse" id="collapse2" data-parent="#accordion">
								<div class="card-body">
									Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere soluta nihil architecto voluptatem officiis mollitia vitae aut perferendis consectetur. Voluptates sit debitis amet voluptate eius maiores, temporibus odit asperiores facere?
									Ratione hic illum aut eum ex a. Nisi eos adipisci deleniti quidem amet totam, dolor libero quisquam cupiditate voluptas excepturi recusandae nostrum dicta! Quisquam enim, iste architecto impedit earum doloribus.
									Enim nulla alias a? Hic aut deserunt iure vero eum fuga qui ducimus, aperiam excepturi ipsam porro. Facilis minus fuga eos hic deleniti quos inventore quam, quae laboriosam sint reprehenderit?
								</div>
							</div>

							<!-- Collapse tres -->
							<div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
									Firma y fecha del contrato
								</a>	
							</div>

							<div class="collapse" id="collapse3" data-parent="#accordion">
								<div class="card-body">
									Lorem ipsum dolor sit amet consectetur adipisicing elit. firmada el <?php echo date('d/m/Y'); ?>
									<div class="mb-4" id="signatureparent">
										<div id="signature"></div>
									</div>
									<button type="button" class="repetirFirma btn btn-default btn-sm">Repetir firma</button>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2">
					<button type="submit" class="btn btn-dark suscribirse">Suscribirse</button>
				</div>
			</div>

		</div>

	</div>
</div>

<!-- Si ya está suscrito -->
<?php else: ?>

<div class="class col-12 col-md-8">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h5 class="m-0 text-uppercase text-secondary float-left">Suscripcion activa</h5>
			<span class="m-0 text-secondary float-right">Se renueva automáticamente el <?php echo $usuario["vencimiento"]; ?> </span>
		</div>

		<div class="card-body">
			<h6 class="pb-2">Comparte el enlace de afiliado</h6>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="p-2 bg-info rounded-left copiarLink" style="cursor:pointer;">Copiar</span>
				</div>
				<input type="text" class="form-control" id="linkAfiliado" value="<?php echo $ruta.$usuario["enlace_afiliado"]; ?>" readonly>
			</div>

			<h6 class="pt-3 pb-2">Cuenta de Paypal donde recibirpas tus pagos de comisiones</h6>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="p-2 bg-primary rounded-left"><i class="fab fa-paypal"></i></span>
					</div>
					<input type="text" class="form-control" id="correoPaypal" value="<?php echo $usuario["paypal"]; ?>" readonly>
				</div>

		</div>

		<div class="card-footer">
			<a href="#" class="btn btn-dark float-left" target="_blank">Descargar contrato</a>
			<button class="btn btn-danger float-right cancelarSuscripcion">Cancelar suscripción</button>
		</div>

	</div>
</div>

<?php endif ?>

<?php 
// Verificamos que la url exista la variable get de nombre subscription_id
	if (isset($_GET["subscription_id"])) {
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
			// echo '<pre>'; print_r($token); echo '</pre>';

			/*======================================================================
			=            PARA VER Y VALIDAR EL ESTTUS DE LA SUSCTIPCION            =
			======================================================================*/
			$curl2 = curl_init();

			  curl_setopt_array($curl2, array(
			  CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$_GET["subscription_id"].'',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 300,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
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
				// echo '<pre>'; print_r($respuesta2); echo '</pre>';

				// Toma la propiedad estatus de la suscripcion
				$estado=$respuesta2["status"];

				// Si está activo
				if ($estado=="ACTIVE") {
					// tomamos el email de paypal
					$paypal=$respuesta2["subscriber"]["email_address"];
					$suscripcion=1; //1 ¡Suscrito, 0 no ¡Suscrito
					$id_suscripcion=$_GET["subscription_id"];
					$ciclo_pago=1;

					$fechaInicial= substr($respuesta2["status_update_time"],0,-10);
					$fechaVencimiento=strtotime('+1 month', strtotime($fechaInicial));
					$vencimiento=date("Y-m-d", $fechaVencimiento);

					// $fechaContrato= substr($respuesta2["status_update_time"],0,-10);
					// $fechaInicial=substr($respuesta2["billing_info"]["next_billing_time"],0,-10);

					// $vencimiento=date("Y-m-d", strtotime($fechaInicial));

					//Llamando a las cookies que vienen de usuarios.js 
					$enlace_afiliado=$_COOKIE["enlace_afiliado"];
					$patrocinador=$_COOKIE["patrocinador"];
					$pais=$_COOKIE["pais"];
					$codigo_pais=$_COOKIE["codigo_pais"];
					$telefono_movil=$_COOKIE["telefono_movil"];
					$firma=$_COOKIE["firma"];
					
					// validamos que exista el patrocinador en bd y que coincida con la cookie
					$validarPatrocinador=ControladorUsuarios::ctrMostrarUsuario("enlace_afiliado", $enlace_afiliado);

					// Si viene vacío enlace de afiliado
					if (!$validarPatrocinador) {
						// $patrocinador se encuentra en plantilla
						$confimarPatrocinador=$patrocinador;
					}else{
						// validamos que tambien esté suscrito
						if ($validarPatrocinador["suscripcion"]==1) {
							// Lo que venga en bd
							$confimarPatrocinador=$validarPatrocinador["enlace_afiliado"];
						}else{
							$confimarPatrocinador=$patrocinador;
						}
						
					}


					// agrupando datos en un array
					$datos=array(
						"id"=>$usuario["id"],//Variable de sesion, se encuentra en plantilla.php
						"suscripcion"=>$suscripcion,
						"id_suscripcion"=>$id_suscripcion,
						"ciclo_pago"=>$ciclo_pago,
						"vencimiento"=>$vencimiento,
						"enlace_afiliado"=>$enlace_afiliado,
						"patrocinador"=>$confimarPatrocinador,
						"paypal"=>$paypal,
						"pais"=>$pais,
						"codigo_pais"=>$codigo_pais,
						"telefono_movil"=>$telefono_movil,
						"firma"=>$firma,
						"fecha_contrato"=>$fechaContrato

					);
					// echo '<pre>'; print_r($datos); echo '</pre>';	
					$iniciarSuscripcion=ControladorUsuarios::ctrIniciarSuscripcion($datos);
					// Si la suscripcion retorna "ok", que viene del controlador
					if ($iniciarSuscripcion=="ok") {
							echo '<script>
									swal({
										type:"success",
										title: "¡Suscrito correctamente!",
										text: "¡Bienvenido ahora ya puede ganar millones :D !",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"
									}).then(function(result){

										if(result.value){
											window.location = "'.$ruta.'backoffice/perfil";
										}
									});	
								</script>';	
						}else{
							echo '<script>
									swal({
										type:"error",
										title: "¡Error en la suscripcion!",
										text: "¡Ups ahora ya no puede ganar millones D: mejor mande un correo a academyoflife@info.com para mas detalles si han generado cargos a su cuenta !",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"
									}).then(function(result){

										if(result.value){
											window.location = "'.$ruta.'backoffice/perfil";
										}
									});	
								</script>';	
						}

				}

			}
			
		}
	}
 ?>