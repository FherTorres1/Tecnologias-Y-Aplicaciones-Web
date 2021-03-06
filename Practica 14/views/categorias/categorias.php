<?php

  //Se regresa al login si no se ha iniciado sesion
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
            <h1>Categoria</h1>
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
              <h3 class="card-title"><a href="index.php?action=registrar_categoria"><button class="btn btn-block btn-outline-success" style="width:20%;">Registrar Categoria</button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="bg-success">
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Fecha anadida</th>
                  <th>Acciones</th>
                </tr>
                </thead>
								<tbody>
									<?php
										//Se hace una instancia del controlador
										$vistaProducto = new MvcController();
										//Se manda llamar el metodo para traer la vista de todas las categorias existentes
										$vistaProducto->vistaCategoriasController();
										//Se manda llamar el metodo para borrar alguna categoria en base a su ID
										$vistaProducto->borrarCategoriaController();

									?>
								</tbody>
							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 		</section>
</div>