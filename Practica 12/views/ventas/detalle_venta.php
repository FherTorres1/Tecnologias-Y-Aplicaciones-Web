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
            <h1>Detalles de Venta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?action=ventas">Home</a></li>
              <li class="breadcrumb-item active">Ventas</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-success">
                  <th>Codigo de Producto</th>
                  <th>Descripcion</th>
                  <th>Cantidad</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    //Se hace una instancia del controlador
                    $vistaDetalle = new MvcController();
                    //Se manda llamar el metodo para traer la vista de las tiendas
                    $vistaDetalle->vistaDetalleController();

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>