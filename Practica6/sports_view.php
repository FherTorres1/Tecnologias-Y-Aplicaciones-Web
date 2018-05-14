<?php

//Se requiere el archivo database_utilities.php para poder usar las diferentes metodos que usaran las senetencias SQL
require_once('database_utilities.php');
//Se ejecutara la funcion querySoccerPlayers donde se hara la consulta a la tabla futbolistas y traera todos los datos de cada futbolista, posteriormente
//se retornara un array asociativo con todos los resultados que sera llamado resultados
$resultados = querySoccerPlayers();
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
        <h3>Deportistas</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if($resultados){ 
              //Si hay resultados entonces se hara la tabla?>
              <h3>Futbolistas</h3>
              <a href="./add_form.php?type=1" class="button radius tiny">Nuevo Futbolista</a>
              <table>
                <thead>
                  <tr>
                    <th width="200">Numero(ID)</th>
                    <th width="250">Nombre</th>
                    <th width="250">Posicion</th>
                    <th width="250">Carrera</th>
                    <th width="250">E-mail</th>
                    <th width="250">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $resultados as $id => $user ){ 
                    // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion un futbolista nuevo
                  ?>
                  <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['nombre'] ?></td>
                    <td><?php echo $user['posicion'] ?></td>
                    <td><?php echo $user['carrera'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <?php // Por cada futbolista nuevo se crearan dos botones, uno para eliminar y otro para actualizar
                          // informacion.
                          // En el boton de eliminar se desplegara una alerta para estar seguros de eliminar al usuario.
                          // En ambas ocasiones se pasara el id de cada usuario para hacer las distintas funciones como eliminar o actualizar en base al id de cada futbolista?>
                    <td><a href="./key.php?id=<?php echo $user['id']; ?>&type=1" class="button radius tiny alert"  onClick=avoidDeleting();>Eliminar</a>
                    <a href="./update_form.php?id=<?php echo $user['id']; ?>&type=1" class="button radius tiny success">Actualizar</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- Se hara un conteo de cada futbolista -->
                    <td colspan="6"><b>Total de registros: </b> <?php echo count($resultados); ?></td>
                  </tr>
                </tbody>
              </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>

              <?php 
              //Se hara ahora una consulta a todos los basquetbolista con el metodo queryBasketballPlayers
              $resultados = queryBasketballPlayers();
              //Si hay resultados entonces se hara la tabla
              if($resultados){ ?>
              <h3>Basquetbolistas</h3>

              <a href="./add_form.php?type=2" class="button radius tiny">Nuevo Basquetbolista</a>
              <table>
                <thead>
                  <tr>
                    <th width="200">Numero(ID)</th>
                    <th width="250">Nombre</th>
                    <th width="250">Posicion</th>
                    <th width="250">Carrera</th>
                    <th width="250">E-mail</th>
                    <th width="250">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $resultados as $id => $user ){ 
                    // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion un basquebolista nuevo
                  ?>
                  <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['nombre'] ?></td>
                    <td><?php echo $user['posicion'] ?></td>
                    <td><?php echo $user['carrera'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <?php // Por cada futbolista nuevo se crearan dos botones, uno para eliminar y otro para actualizar
                          // informacion.
                          // En el boton de eliminar se desplegara una alerta para estar seguros de eliminar al usuario.
                          // En ambas ocasiones se pasara el id de cada usuario para hacer las distintas funciones como eliminar o actualizar en base al id de cada basquetbolista?>
                    <td><a href="./key.php?id=<?php echo $user['id']; ?>&type=2" class="button radius tiny alert"  onClick=avoidDeleting();>Eliminar</a>
                    <a href="./update_form.php?id=<?php echo $user['id']; ?>&type=2" class="button radius tiny success">Actualizar</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- Se hara un conteo de cada basquetbolista -->
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