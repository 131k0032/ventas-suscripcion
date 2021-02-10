<div class="col-12 col-md-4">
	<div class="card card-info card-outline">
		<div class="car-body box-profile">
			<div class="text-center">
				<!-- Si no hay nada en foto pon el default -->
				<?php if ($usuario["foto"] == ""): ?>

					<img class="profile-user-img img-fluid img-circle" src="vistas/img/usuarios/default/default.png">

				<?php else: ?>
					<!-- Si ya tiene otra foto -->

					<img class="profile-user-img img-fluid img-circle" src="<?php echo $usuario["foto"] ?>">
					
				<?php endif ?>
			</div>

				<h3 class="profile-user-name text-center">
					<?php echo $usuario["nombre"]; ?>
				</h3>

				<p class="text-muted text-center">
					<?php echo $usuario["email"]; ?>
				</p>
				<div class="text-center">
					<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cambiarFoto"> Cambiar foto</button>
					<button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#cambiarPassword"> Cambiar contraseña</button>

				</div>	
		</div>

			<div class="card-footer">
				<button class="btn btn-default float-right">Eliminar cuenta</button>
			</div>
	</div>
</div>


<!--===================================
CAMBIAR FOTO DE PERFIL
====================================-->
<!-- The Modal -->
<div class="modal" id="cambiarFoto">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">
      	<!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Cambiar foto</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	      	<!-- id de usuario en modo oculto -->
	      	<input type="hidden" name="idUsuarioFoto" value="<?php echo $usuario["id"]; ?>">
	      	

	        <div class="form-group">
	        	<input type="file" class="form-control-file border" name="cambiarImagen" required>
	        	<!-- Foto actual del usuario en modo oculto -->
	      		<input type="hidden" name="fotoActual" value="<?php echo $usuario["foto"]; ?>">
	        </div>
	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">
	      	<div>
	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	        </div>
	        <div>
	        	<button type="submit" class="btn btn-primary">Enviar</button>
	        </div>
	      </div>

	      <?php 
	      	$cambiarImagen= new ControladorUsuarios();
	      	$cambiarImagen->ctrCambiarFotoPerfil();
	      	// var_dump($cambiarImagen);
	       ?>
      </form>
    </div>
  </div>
</div>




<!--===================================
CAMBIAR PASS
====================================-->
<!-- The Modal -->
<div class="modal" id="cambiarPassword">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="post">
      	<!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Cambiar contraseña</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	      	<!-- id de usuario en modo oculto -->
	      	<input type="hidden" name="idUsuarioPassword" value="<?php echo $usuario["id"]; ?>">
	      	

	        <div class="form-group">
	        	<input type="password" class="form-control-file border" name="editarPassword" required>
	        </div>
	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">
	      	<div>
	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	        </div>
	        <div>
	        	<button type="submit" class="btn btn-primary">Enviar</button>
	        </div>
	      </div>

	      <?php 
	      	$cambiarPassword= new ControladorUsuarios();
	      	$cambiarPassword->ctrCambiarPassword();
	      	// var_dump($cambiarImagen);
	       ?>
      </form>
    </div>
  </div>
</div>