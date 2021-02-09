<div class="ladoUsuarios">

<div class="container-fluid">
	
	<div class="row">
		
		<div class="col-12 col-lg-4">

			<figure class="p-2 p-sm-5 p-lg-4 p-xl-5 text-center">
			
				<a href="<?php echo $ruta; ?>inicio"><img src="img/logo-positivo.png" class="img-fluid"></a>

					<div class="d-flex justify-content-between">
					
						<h4>Ingreso al sistema</h4>

						<div class="dropdown text-right">

							<button type="button" class="btn btn-light btn-sm dropdown-toggle border" data-toggle="dropdown">
								<form method="post" action="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
									<input type="hidden" name="idioma" value="es">
									<input 
										type="submit" 
										value="ES" 
										style="border: 0; 
												background: 
												transparent; 
												padding: 0; 
												margin: 0; 
												float:left; 
												cursor: 
												pointer;">
								</form>
							</button>

							<div class="dropdown-menu">

								<a class="dropdown-item">
									<form method="post" action="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
										<input type="hidden" name="idioma" value="en">
										<input 
											type="submit" 
											value="EN" 
											style="border: 0; 
													background: 
													transparent; 
													padding: 0; 
													margin: 0; 
													cursor: 
													pointer;">
									</form>
								</a>

							</div>

						</div>

					</div>

					<p class="text-center py-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi sunt officia unde officiis</p>

				<form class="mt-5" method="post">

					<input type="email" class="form-control my-3 py-3" placeholder="Correo Electrónico" name="ingresoEmail" required>

					<input type="password" class="form-control my-3 py-3" placeholder="Contraseña" name="ingresoPassword" required>

					<?php 
						$ingreso= new ControladorUsuarios(); //Instanciando la clase
						$ingreso->ctrIngresoUsuario(); //Llamamos el objeto o funcion
					 ?>

					<input type="submit" class="form-control my-3 py-3 btn btn-info" value="Ingresar">

					<p class="text-center py-3">¿Aún no tienes una cuenta? | <a href="<?php echo $ruta; ?>registro">Regístrate</a></p>
					
					<hr>

					<p class="text-center py-3">¿Olvidó su contraseña?</p>


				</form>

			</figure>

		</div>

		<div class="col-12 col-lg-8 fotoIngreso text-center">		

			<a href="<?php echo $ruta; ?>inicio">><button class="d-none d-lg-block text-center btn btn-default btn-lg my-3 text-white btnRegresar">Regresar</button></a>

			<a href="<?php echo $ruta; ?>inicio">><button class="d-block d-lg-none text-center btn btn-default btn-lg btn-block my-3 text-white btnRegresarMovil">Regresar</button></a>

			<ul class="p-0 m-0 py-4 d-flex justify-content-center redesSociales">

				<li>
					<a href="#" target="_blank"><i class="fab fa-facebook-f lead text-white mx-4"></i></a>
				</li>

				<li>
					<a href="#" target="_blank"><i class="fab fa-instagram lead text-white mx-4"></i></a>
				</li>	

				
				<li>
					<a href="#" target="_blank"><i class="fab fa-linkedin lead text-white mx-4"></i></a>
				</li>

				<li>
					<a href="#" target="_blank"><i class="fab fa-twitter lead text-white mx-4"></i></a>
				</li>

				<li>
					<a href="#" target="_blank"><i class="fab fa-youtube lead text-white mx-4"></i></a>
				</li>

			</ul>

		</div>

	</div>

</div>

</div>
