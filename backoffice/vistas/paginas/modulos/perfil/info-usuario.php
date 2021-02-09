<div class="col-12 col-md-4">
	<div class="card card-info card-outline">
		<div class="car-body box-profile">
			<div class="text-center">
				<img class="profile-user-img img-fluid img-circle" src="vistas/img/usuarios/default/default.png" alt="">
			</div>

				<h3 class="profile-user-name text-center">
					<?php echo $usuario["nombre"]; ?>
				</h3>

				<p class="text-muted text-center">
					<?php echo $usuario["email"]; ?>
				</p>
				<div class="text-center">
					<button class="btn btn-primary btn-sm"> Cambiar foto</button>
					<button class="btn btn-purple btn-sm"> Cambiar contraseña</button>
				</div>	
		</div>

			<div class="card-footer">
				<button class="btn btn-default float-right">Eliminar cuenta</button>
			</div>
	</div>
</div>