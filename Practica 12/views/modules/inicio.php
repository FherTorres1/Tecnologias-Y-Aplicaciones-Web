<?php

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
            <h1>Dashboard</h1>
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
              <h3 class="card-title">Informacion</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row" align="">
                <?php
                  //Se hace una instancia del controlador
                  $vistaProductos = new MvcController(); 
                  $vistaProductos-> vistaDashboardController() ?>
              </div>
              <br><br><br>
              <div class="card-header">
              <h3 class="card-title">Productos sin stock</h3>
              </div>
              <br><br>
              <table id="example1" class="table table-bordered table-striped">
                <thead class="bg-info">
                <tr>
                  <th>Nombre</th>
                  <th>Stock</th>
                </tr>
                </thead>
								<tbody>

									<?php
										//Se manda llamar al vista de productos sin Stock
										$vistaProductos->vistaProductosSinStock();
									?>
								</tbody>
							</table>
              <div class="card-header">
              <h3 class="card-title">Transacciones del dia de hoy</h3>
              </div>
              <br><br>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-info">
                  <th>Fecha</th>
                  <th>Descripcion</th>
                  <th>Referencia</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>

                  <?php
                    //Se manda llamar al vista de productos sin Stock
                    $vistaProductos->vistaHistorialController();
                  ?>
                </tbody>
              </table>
            </div>
 					</div>
 				</div>
 			</div>
 		</section>
</div>

