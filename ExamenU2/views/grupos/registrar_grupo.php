<?php
  //Si no se ha iniciado sesion entonces se regresa a la pagina
  if(!isset($_SESSION['validar']))
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
            <h1>Registrar Grupo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Registrar Grupo</li>
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
                			<h3 class="card-title">Nuevo Grupo</h3>
              		</div>
              		<div class="card-body">
                			<br>
                			<textarea name="nombre" class="form-control form-control-lg" type="text" placeholder="Nombre de Grupo"></textarea>
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
	//Se manda llamar el metodo registrarGrupo del controlador para registrar el grupo en la BD
	$mvc->registrarGrupoController();
?>
