<?php
$type = isset( $_GET['type'] ) ? $_GET['type'] : '';
if($type=='teacher')
{
  $teacher=1;
  $header = "Detalles de profesor";
}
else if($type =='student')
{
  $teacher=0;
  $header = "Detalles de Alumno";
}

include_once('utilities.php');
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';
if( !array_key_exists($id, $user_access) )
{
  die('No existe dicho usuario');
}
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
        <h3><?php echo $header;?></h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <ul class="pricing-table">
                <li class="title">Detalle de indice</li>
                <?php if($teacher==1){ ?>
                <li class="description"><?php echo $user_access[$id]['numero'] ?></li>
                <li class="description"><?php echo $user_access[$id]['nombre'] ?></li>
                <li class="description"><?php echo $user_access[$id]['carrera'] ?></li>
                <li class="description"><?php echo $user_access[$id]['telefono'] ?></li>
                <?php }
                else if($teacher==0){ ?>
                <li class="description"><?php echo $user_access[$id]['matricula'] ?></li>
                <li class="description"><?php echo $user_access[$id]['nombre'] ?></li>
                <li class="description"><?php echo $user_access[$id]['correo'] ?></li>
                <li class="description"><?php echo $user_access[$id]['carrera'] ?></li>
                <li class="description"><?php echo $user_access[$id]['telefono'] ?></li>
                <?php }?>

              </ul>
            </div>
          </section>
        </div>
      </div>
    </div>
     
    <?php require_once('footer.php'); ?>