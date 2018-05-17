<?php

//Se requiere el archivo database_utilities.php para poder usar las diferentes metodos que usaran las senetencias SQL
require_once('database_utilities.php');

//Se traen los resultados de los usuarios por el metodo queryUsers
$resultados = queryUsers();
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
              <?php if($resultados){ 
              //Si hay resultados entonces se hara la tabla?>
              <h3>Usuarios</h3>
              <a href="./add_user.php" class="button radius tiny">Nuevo Usuario</a>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Usuario</th>
                    <th width="250">Password</th>
                    <th width="250">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $resultados as $id => $user ){ 
                    // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion un usuario nuevo
                  ?>
                  <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['usuario'] ?></td>
                    <td><?php echo $user['password'] ?></td>
                    <?php // Por cada usuario  nuevo se crearan dos botones, uno para eliminar y otro para actualizar
                          // informacion.
                          // En el boton de eliminar se desplegara una alerta para estar seguros de eliminar al usuario.
                          // En ambas ocasiones se pasara el id de cada usuario para hacer las distintas funciones como eliminar o actualizar en base al id de cada usuario?>
                    <td><a href="./key.php?id=<?php echo $user['id']; ?>" class="button radius tiny alert"  onClick=avoidDeleting();>Eliminar</a>
                    <a href="./update_user.php?id=<?php echo $user['id']; ?>" class="button radius tiny success">Actualizar</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- Se hara un conteo de los usuarios -->
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