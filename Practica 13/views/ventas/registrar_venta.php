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
            <h1>Realizar una venta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Registrar una venta</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <form method="POST">
    <?php
      //Se hace una instancia del controlador
      $mvc = new MvcController();
      //Se obtienen los datos del producto que se eligio para mostrarlos en la pantalla
      $mvc->obtenerDatosVentaController();
      //Funcion para realizar la actualizacion de stock y la insercion del historial
      $mvc->registrarVentaController();
    ?>
    </form>


</div>