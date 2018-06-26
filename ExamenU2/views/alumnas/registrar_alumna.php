  <?php
  //Se regresa al login si no se ha iniciado sesion
  if(!isset($_SESSION['validar']))
  {
    echo"<script>
            window.location = 'index.php?action=login';
          </script>";
  }

  //Se hace una instancia del controlador
  $mvc = new MvcController();
  //Se manda llamar el metodo registrarAlumna para registrar la alumna en la BD
  $mvc->registrarAlumnaController();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registrar Alumna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Registrar Alumna</li>
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
            </div>
            <!-- /.card-header -->
          	<div class="card-body">
							<form method="post" style="font-family: Arial; width: 50%; margin-left: 265px">
			
								<div class="card card-success">
              		<div class="card-header">
                			<h3 class="card-title">Nueva Alumna</h3>
              		</div>
              		<div class="card-body">
              				<br>
                			<input name="nombre" class="form-control form-control-lg" type="text" placeholder="Nombre">
                			<br>
                      <input name="apellido" class="form-control form-control-lg" type="text" placeholder="Apellido">
                      <br>
                      <input type="date" name="fecha" class="form-control form-control-lg">
                      <br>
                      <select class="form-control select2" style="width: 100%;" name="grupo">
                      <?php
                            //OBtener los grupos de la BD para registrarla en la tabla producto al momento de reistrar una alumna nueva
                            $mvc->obtenerGruposController(); 
                      ?>
                      </select>
                      <br>
                      <br>
                			<input type="submit" value="Registrar" class="btn btn-block btn-outline-success" name="registrar">
              			</div>
            		</div>

							</form>
					</div>
				</div>
			</div>
		</div>
</section>
</div>

<?php

	//Se hace una instancia del controlador
	$mvc = new MvcController();
	//Se manda llamar el metodo registrarAlumna para registrar el usuario en la BD
	$mvc->registrarAlumnaController();
?>
