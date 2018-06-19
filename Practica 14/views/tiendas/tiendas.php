<?php
  //Se regresa el login si no existe
  if(!isset($_SESSION['validar']))
  {
    echo"<script>
            window.location = 'index.php?action=login';
          </script>";
  }
  else if($_SESSION['id']!=13)
  {
    echo"<script>
            window.location = 'index.php';
          </script>";
  }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tiendas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?action=tiendas">Home</a></li>
              <li class="breadcrumb-item active">Tiendas</li>
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
              <h3 class="card-title"><a href="index.php?action=registrar_tienda"><button class="btn btn-block btn-outline-success" style="width:20%;">Registrar Tienda</button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-success">
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
								<tbody>
									<?php
										//Se hace una instancia del controlador
										$vistaTienda = new MvcController();
										//Se manda llamar el metodo para traer la vista de las tiendas
										$vistaTienda->vistaTiendasController();
                    //Se manda llamar el metodo para ingresar a una tienda
                    $vistaTienda->ingresarTiendaController();
										//Se manda llamar el metodo para desactivar alguna tienda en base a su ID
										$vistaTienda->desactivarTiendaController();

									?>
								</tbody>
							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 		</section>
</div>