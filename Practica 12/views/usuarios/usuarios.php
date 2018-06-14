<?php
  //Se regresa el login si no existe
  if(!isset($_SESSION['validar']))
  {
    echo"<script>
            window.location = 'index.php?action=login';
          </script>";
  }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

		<section class="content">
      <div class="row">
        <div class="col-12">
					<div class="card">
            <div class="card-header">
              <h3 class="card-title"><a href="index.php?action=registrar_usuario"><button class="btn btn-block btn-outline-success" style="width:20%;">Registrar Usuario</button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-success">
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Usuario</th>
                  <th>Password</th>
                  <th>Correo</th>
                  <th>Fecha anadida</th>
                  <th>Acciones</th>
                </tr>
                </thead>
								<tbody>
									<?php
										//Se hace una instancia del controlador
										$vistaUsuario = new MvcController();
										//Se manda llamar el metodo para traer la vista de los usuarios
										$vistaUsuario->vistaUsuariosController();
										//Se manda llamar el metodo para borrar algun usuario en base a su ID
										$vistaUsuario->borrarUsuarioController();

									?>
								</tbody>
							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 		</section>
</div>