<?php

//Se requiere el archivo database_utilities.php para poder usar las diferentes metodos que usaran las senetencias SQL
require_once('database_utilities.php');
//Se ejecutara la funcion run_query donde se haran distintas consultas que traera el conteo de todas las distintas tablas
//donde en algunas tendran ciertas clausulas where para obtener un resultado especifico
//se retornara un array asociativo con todos los resultados que sera llamado resultados
$resultados = run_query();
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
        <h3>Ejemplos de listado en array</h3>
          <p>Listado</p>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <!-- Se condiciona si se obtuvieron resultados para proceder a hacer la tabla que los mostrara -->
              <?php if($resultados){ ?>
              <h3>Datos Totales</h3>
              <table>
                <thead>
                  <tr>
                    <th width="200">Usuarios</th>
                    <th width="250">Tipos</th>
                    <th width="250">Status</th>
                    <th width="250">Accesos</th>
                    <th width="250">Usuarios Activos</th>
                    <th width="250">Usuarios Inactivos</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <!-- Aqui simplemente se imprime una fila con los distintos resultados que se obtuvieron del metodo run_query y se imprimiran en su columna correspondiente -->
                    <td><?php echo $resultados["total_users"]?></td>
                    <td><?php echo $resultados['total_user_types'] ?></td>
                    <td><?php echo $resultados['total_status_types'] ?></td>
                    <td><?php echo $resultados['total_user_logs'] ?></td>
                    <td><?php echo $resultados['total_user_active'] ?></td>
                    <td><?php echo $resultados['total_user_inactive'] ?></td>
                  </tr>
                </tbody>
              </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>

              <?php
                //Ahora se llamara un metodo que hace una vista a la tabla 'user', este metodo trae un array asociativo con sus resultados
                $resultados = queryUsersTable();
                if($resultados){ ?>

                <!-- Se condiciona si se obtuvieron resultados para proceder a hacer la tabla que los mostrara -->
                <h3>Tabla User</h3>
                <table>
                  <thead>
                    <tr>
                      <th width="200">Id</th>
                      <th width="250">E-mail</th>
                      <th width="250">Password</th>
                      <th width="250">Status Id</th>
                      <th width="250">User Type Id</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach( $resultados as $id => $user ){ 
                      // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion una fila nueva
                    ?>
                    <tr>
                      <td><?php echo $user['id'] ?></td>
                      <td><?php echo $user['email'] ?></td>
                      <td><?php echo $user['password'] ?></td>
                      <td><?php echo $user['status_id'] ?></td>
                      <td><?php echo $user['user_type_id'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <!-- Se cuenta cuantos registras hay para poderlos senalar -->
                      <td colspan="4"><b>Total de registros: </b> <?php echo count($resultados); ?></td>
                    </tr>
                  </tbody>
                </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>

              <?php
                //Ahora se llamara un metodo que hace una vista a la tabla 'user_logs', este metodo trae un array asociativo con sus resultados
                $resultados = queryUserLogTable();
                //Se condiciona si se obtuvieron resultados para proceder a hacer la tabla que los mostrara
                if($resultados){ ?>
                <h3>Tabla User_Log</h3>
                <table>
                  <thead>
                    <tr>
                      <th width="200">Id</th>
                      <th width="250">Date Logged In</th>
                      <th width="250">User Id</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach( $resultados as $id => $user ){ 
                      // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion una fila nueva
                    ?>
                    <tr>
                      <td><?php echo $user['id'] ?></td>
                      <td><?php echo $user['date_logged_in'] ?></td>
                      <td><?php echo $user['user_id'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <!-- Se cuenta cuantos registras hay para poderlos senalar -->
                      <td colspan="4"><b>Total de registros: </b> <?php echo count($resultados); ?></td>
                    </tr>
                  </tbody>
                </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>

              <?php
                //Ahora se llamara un metodo que hace una vista a la tabla 'user_types', este metodo trae un array asociativo con sus resultados
                $resultados = queryUserTypeTable();
                //Se condiciona si se obtuvieron resultados para proceder a hacer la tabla que los mostrara
                if($resultados){ ?>
                <h3>Tabla User_Type</h3>
                <table>
                  <thead>
                    <tr>
                      <th width="200">Id</th>
                      <th width="250">Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach( $resultados as $id => $user ){ 
                      // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion una fila nueva
                    ?>
                    <tr>
                      <td><?php echo $user['id'] ?></td>
                      <td><?php echo $user['name'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <!-- Se cuenta cuantos registras hay para poderlos senalar -->
                      <td colspan="4"><b>Total de registros: </b> <?php echo count($resultados); ?></td>
                    </tr>
                  </tbody>
                </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>

              <?php
                //Ahora se llamara un metodo que hace una vista a la tabla 'status', este metodo trae un array asociativo con sus resultados
                $resultados = queryStatusTable();
                //Se condiciona si se obtuvieron resultados para proceder a hacer la tabla que los mostrara
                if($resultados){ ?>
                <h3>Tabla Status</h3>
                <table>
                  <thead>
                    <tr>
                      <th width="200">Id</th>
                      <th width="250">Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach( $resultados as $id => $user ){ 
                      // Se recorrera el array asoc y se pondra los distintos valores siendo cada iteracion una fila nueva
                    ?>
                    <tr>
                      <td><?php echo $user['id'] ?></td>
                      <td><?php echo $user['name'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <!-- Se cuenta cuantos registras hay para poderlos senalar -->
                      <td colspan="4"><b>Total de registros: </b> <?php echo count($resultados); ?></td>
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

      //Funcion para crear la alerta de estar seguros si queremos eliminar el usuario ya que la eliminacion del usuario 
      //nos llevara a una diferente pagina
      function avoidDeleting()
      {
        var msj = confirm("Deseas eliminar este usuario?");
        if(msj == false)
        {
          event.preventDefault();
        }
      }
    </script>