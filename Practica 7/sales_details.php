<?php
include_once('database_utilities.php');

//Se obtiene el id de la vente por metodo get
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';

//Se obtienen lo srsultados de detalle de venta con el metodo querySalesDetails
$resultados = querySalesDetails($id);

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <?php require_once('header.php'); ?>

    <div class="row">
 
      <div class="large-9 columns">
        <h3>Manejo de arreglos</h3>
          <p>Elemento de un arreglo</p>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <ul class="pricing-table">
                <li class="title">Detalle de venta <?php echo $resultados[0]['id_venta']?></li>
                <?php foreach( $resultados as $id => $user ){ 
                  //Por cada producto se registraran sus datos?>
                <li class="description">
                Nombre: <?php echo $user['nombre'] ?><br>
                Cantidad: <?php echo $user['cantidad'] ?> Unidades<br>
                Promedio de Prenda $<?php echo $user['prom_prenda'] ?><br>
                Total: $<?php echo $user['precio'] * $user['cantidad'] ?>.00
                </li>
                <?php } ?>
              </ul>
              <a href="./sales_view.php" class="button radius tiny">Regresar</a><br>
            </div> 
          </section>
        </div>
      </div>
    </div>
     
    <?php require_once('footer.php'); ?>