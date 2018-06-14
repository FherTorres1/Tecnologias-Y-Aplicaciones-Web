<?php
  //Se regresa el login si no se ha iniciado sesion
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
            <h1>Productos</h1>
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
              <h3 class="card-title"><a href="index.php?action=registrar_producto"><button class="btn btn-block btn-outline-success" style="width:20%;">Registrar Producto</button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="bg-success">
                <tr>
                  <th>ID</th>
                  <th>Codigo de producto</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Unidades</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
                </thead>
								<tbody>
									<?php
										//Se hace una instancia del controlador
										$vistaProducto = new MvcController();
										//Se manda llamar el metodo para traer la vista de los productos
										$vistaProducto->vistaProductosController();
										//Se manda llamar el metodo para borrar algun producto en base a su ID
										$vistaProducto->borrarProductoController();

									?>
								</tbody>
							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 		</section>
</div>