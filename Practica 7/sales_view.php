<?php

//Se requiere el archivo database_utilities.php para poder usar las diferentes metodos que usaran las senetencias SQL
require_once('database_utilities.php');

//Se obtendra el valor de los resultados por el metodo querySales
$resultados = querySales();

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
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>

              <h3>Ventas</h3>
              <a href="./add_sale.php" class="button radius tiny">Nueva Venta</a><br>
              <form method="POST">
                <div align="right">
                    <label for="fecha">Filtro por Fecha </label>
                    <input type="date" name="fecha" style="width: 200px;">
                    <div>
                    <input type="submit" name="filtro" value="Buscar" class="button radio tiny">
                    <input type="submit" name="limpiar" value="Limpiar Filtro" class="button radio tiny">
                    </div>
                </div>  
              </form>


              <?php
                //FILTRO DE BUSQUEDA
                if(isset($_POST['filtro']))
                {
                  //Se obtendra la fecha que se ingreso en el filtro
                  $date = $_POST['fecha'];
                  //Se cambiara el formato para que coincida con la base de datos
                  $fecha = date("Y-m-d",strtotime($date));

                  //Se obtendran lo sresultados por el metodo querySalesPerDate
                  $resultados=querySalesPerDate($fecha);
                }
                //Limpiar el filtro de busqueda y que salgan todas las fechas
                if(isset($_POST['limpiar']))
                {
                  $resultados = querySales();
                }
              ?>

              <?php if($resultados){ 
              //Si hay resultados entonces se hara la tabla?> 
          
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Monto</th>
                    <th width="250">Fecha</th>
                    <th width="250">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $resultados as $id => $user ){ 
                    // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion un futbolista nuevo
                  ?>
                  <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['monto'] ?></td>
                    <td><?php echo $user['fecha'] ?></td>
                    <?php // Por cada venta nueva se creara un boton para ver lo detalles de la venta?>
                    <td>
                    <a href="./sales_details.php?id=<?php echo $user['id']; ?>" class="button radius tiny success">Ver detalles</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- Se hara un conteo de las ventas -->
                    <td colspan="6"><b>Total de registros: </b> <?php echo count($resultados); ?></td>
                  </tr>
                </tbody>
              </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>
            </div>
          </section>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>

    <script type="text/javascript">

      //Funcion para crear la alerta de estar seguros si queremos eliminar el usuario
      function avoidDeleting()
      {
        var msj = confirm("Deseas eliminar este usuario?");
        if(msj == false)
        {
          event.preventDefault();
        }
      }
    </script>