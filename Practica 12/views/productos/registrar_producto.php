<?php
   //Se regresa el login si no se ha iniciado sesion
  if(!isset($_SESSION['validar']))
  {
    echo"<script>
            window.location = 'index.php?action=login';
          </script>";
  }

  //Se hace una instancia del controlador
  $mvc = new MvcController();
  //Se manda llamar el metodo registrarProducto para registrar el producto en la BD
  $mvc->registrarProductoController();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registrar Producto</h1>
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
								<div class="card card-success">
              		<div class="card-header">
                			<h3 class="card-title">Nuevo Producto</h3>
              		</div>
              		<div class="card-body">
              				<br>
                      <input name="codigo" class="form-control form-control-lg" type="text" placeholder="Codigo de Producto">
                      <br>
                			<input name="nombre" class="form-control form-control-lg" type="text" placeholder="Nombre">
                			<br>
                			<input name="precio" class="form-control form-control-lg" type="text" placeholder="Precio">
                			<br>
                			<input name="unidades" class="form-control form-control-lg" type="text" placeholder="Unidades"><br>
                        <label>Categoria</label>
                        <select class="form-control select2" style="width: 100%;" name="categoria">
                          <?php
                          	//OBtener las categorias de la BD para registrarla en la tabla producto 
                          	$mvc->obtenerCategoriasController(); ?>
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

