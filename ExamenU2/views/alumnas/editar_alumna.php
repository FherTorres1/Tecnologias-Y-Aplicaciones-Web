<?php
  //Si no se ha iniciado sesion se regresa al login
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
            <h1>Editar Usuario</h1>
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
            </div>
            <!-- /.card-header -->
          	<div class="card-body">
							<form method="post" style="font-family: Arial; width: 50%; margin-left: 265px">
			
								<?php

									//Se hace una instancia del controlador
									$editarAlumna = new MvcController();
									//Se llama el metodo editarAlumna para traer el formulario y los datos de la alumna
									$editarAlumna -> editarAlumnaController();
									//Se llama el metodo actualizarAlumna para actualizar a la alumna en la BD
									$editarAlumna -> actualizarAlumnaController();

								?>

							</form>
					</div>
				</div>
			</div>
		</div>
</section>
</div>