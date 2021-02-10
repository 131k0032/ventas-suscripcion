<!-- evita que ingrese en la url http://localhost/ventas-suscripcion/backoffice/usuarios manualmente si no es admin -->
<?php 

  if($usuario["perfil"] != "admin"){

  echo '<script>

  window.location = "'.$ruta.'backoffice/inicio";

  </script>';

  return;
}
// Como necesito a todos pongo parametros null
  $item=null;
  $valor=null;
  $usuarios=ControladorUsuarios::ctrMostrarUsuario($item, $valor);
  // echo '<pre>'; print_r($usuarios); echo '</pre>';
 ?>
<div class="content-wrapper" style="min-height: 1059.55px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Usuarios registrados</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered dt-responsive tablaUsuarios">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Pais</th>
                  <th>Suscripcion</th>
                  <th>ID suscripcion</th>
                  <th>Ciclo de pago</th>
                  <th>Enlace afiliado</th>
                  <th>Patrocinador</th>
                  <th>Email de paypal</th>
                  <th>Ultima actualizacion</th>
                  <th>Fecha vencimiento</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($usuarios as $key => $value): ?>
                     <tr>
                        <td><?php echo($key+1) ?></td>
                        <td><img src="<?php echo $value["foto"]; ?>" class="img-fluid" width="30px"></td>
                        <td><?php echo $value["nombre"]; ?></td>
                        <td><?php echo $value["email"]; ?></td>
                        <td><?php echo $value["pais"]; ?></td>
                        <td><?php echo $value["suscripcion"]; ?></td>
                        <td><?php echo $value["id_suscripcion"]; ?></td>
                        <td><?php echo $value["ciclo_pago"]; ?></td>
                        <td><?php echo $value["enlace_afiliado"]; ?></td>
                        <td><?php echo $value["patrocinador"]; ?></td>
                        <td><?php echo $value["paypal"]; ?></td>
                        <td><?php echo $value["fecha"]; ?></td>
                        <td><?php echo $value["vencimiento"]; ?></td>
                    </tr>
                <?php endforeach ?>
               
              </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>