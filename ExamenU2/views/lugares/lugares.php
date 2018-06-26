<?php
  $vistaLugares = new MvcController();
?>
    <!-- Content Header (Page header) -->
    <section style="background-color: #f06292" class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="color:white;"><b><b>Danz</b></b>life</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Lugares</li>
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
              <h3 class="card-title">Lugares Registrados</h3>
            </div>
            
            <table id="historialT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Folio</th>
                  <th>Nombre de Alumna</th>
                  <th>Grupo</th>
                  <th>Nombre de Mama</th>
                  <th>Fecha de Pago</th>
                  <th>Fecha de Registro</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    //Se manda llamar el metodo para traer la vista de los lugares registrados hasta el momento
                    $vistaLugares ->vistaPagosPublicosController();

                  ?>
                </tbody>
              </table>
            

 					</div>
 				</div>
 			</div>
 		</section>

    <footer>
    <strong>Copyright &copy; 2014-2018. Fher Torres.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Danzlife</b>
    </div>
 </footer>
