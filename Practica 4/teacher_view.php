<?php
$teacher=1;
include_once('utilities.php');
$total_users = count($user_access);
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
        <a href="./teacher_form.php" class="button">Registrar Profesor</a>
        <h3>Profesores</h3>
          <p>Listado</p>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if($total_users){ ?>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Numero de Empleado</th>
                    <th width="250">Nombre</th>
                    <th width="250">Carrera</th>
                    <th width="250">Telefono</th>
                    <th width="250">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $user_access as $id => $user ){ ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $user['numero'] ?></td>
                    <td><?php echo $user['nombre'] ?></td>
                    <td><?php echo $user['carrera'] ?></td>
                    <td><?php echo $user['telefono'] ?></td>
                    <td><a href="./key.php?id=<?php echo $id; ?>&type=teacher" class="button radius tiny secondary">Ver detalles</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="4"><b>Total de registros: </b> <?php echo $total_users; ?></td>
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