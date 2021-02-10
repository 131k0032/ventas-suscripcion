<div class="ladoUsuarios">

<div class="container-fluid">
	
	<div class="row">
		
		<div class="col-12 col-lg-4">

			<figure class="p-2 p-sm-5 p-lg-4 p-xl-5 text-center">
			
				<a href="<?php echo $ruta; ?>inicio"><img src="img/logo-positivo.png" class="img-fluid"></a>

					<div class="d-flex justify-content-between">
					
						<h4>Access to website</h4>

						<div class="dropdown text-right">

							<button type="button" class="btn btn-light btn-sm dropdown-toggle border" data-toggle="dropdown">
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
												float:left; 
												cursor: 
												pointer;">
								</form>
							</button>

							<div class="dropdown-menu">

								<a class="dropdown-item">
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
													cursor: 
													pointer;">
									</form>
								</a>

							</div>

						</div>

					</div>

					<p class="text-center py-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi sunt officia unde officiis</p>
					<form class="" method="post">
						
					<input type="email" class="form-control my-3 py-3" placeholder="Correo Electrónico" name="ingresoEmail" required>

					<input type="password" class="form-control my-3 py-3" placeholder="Contraseña" name="ingresoPassword" required>

					<?php 
						$ingreso= new ControladorUsuarios(); //Instanciando la clase
						$ingreso->ctrIngresoUsuario(); //Llamamos el objeto o funcion
					 ?>

					<input type="submit" class="form-control my-3 py-3 btn btn-info" value="Ingresar">

					<p class="text-center">¿Dont you have an accout? | <a href="<?php echo $ruta; ?>registro">Signup</a></p>

					<p class="text-center"><a href="#modalRecuperarPassword" data-toggle="modal" data-dismiss="modal">Forgot password?</a></p>


				</form>

			</figure>

		</div>

		<div class="col-12 col-lg-8 fotoIngreso text-center">		

			<a href="<?php echo $ruta; ?>inicio">><button class="d-none d-lg-block text-center btn btn-default btn-lg my-3 text-white btnRegresar">Back</button></a>

			<a href="<?php echo $ruta; ?>inicio">><button class="d-block d-lg-none text-center btn btn-default btn-lg btn-block my-3 text-white btnRegresarMovil">Back</button></a>

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


<!--=====================================
VENTANA MODAL RECUPERAR CONTRASEÑA
======================================-->
<div class="modal" id="modalRecuperarPassword">
	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header bg-info text-white">
		        <h4 class="modal-title">Reset passwird</h4>
		        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
		    </div>
			 <div class="modal-body">
				<form method="post">
					<p class="text-muted">Write your email and we send you a new password</p>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					      <span class="input-group-text">					    
					      	<i class="far fa-envelope"></i>
					      </span>
					    </div>
					    <input type="email" class="form-control" placeholder="Email" name="emailRecuperarPassword" required>
					</div>
					<input type="submit" class="btn btn-dark btn-block" value="Enviar">
					<?php

						$recuperarPassword = new ControladorUsuarios();
						$recuperarPassword -> ctrRecuperarPassword();

					?>
				</form>
			 </div>
	    </div>
    </div>
</div>