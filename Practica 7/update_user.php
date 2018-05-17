<?php

  //Se obtiene el id del usuario que fue seleccionado por paso de variable
  $id = isset( $_GET['id'] ) ? $_GET['id'] : '';

  //Se requiere el archivo database_utilities.php para los distintos metodos con sentencias SQL
  require_once('database_utilities.php');

  //Se busca la informacion de ese usuario con el metodo search_per_id donde se hara un query a la base de datos con el id del usuario
  // que fue seleccionado y poderlos mostrar en las cajas de texto
  $resultados = search_per_id_user($id);

  //Despues de que los datos fueron cambiados y se presiono el boton de guardar, se mandan llamar los datos para poder registrarlos en la base de datos  
  if(isset($_POST["guardar"]))
  {

    if(isset($_POST["usuario"]))
    {
      $usuario = $_POST["usuario"];
    }

    updateUser($usuario,$id);

    header("Location: users_view.php");
  
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
        <br><br>
        <h3>Actualizar Usuario</h3>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>Usuario: </label>
              <input type="text" name="usuario" value="<?php echo $resultados['usuario'];?>">
              <br>
              <label>Password: </label>
              <input type="text" name="password" value="<?php echo $resultados['password'];?>" readonly>
              <br>
              <input type="submit" name="guardar" value="Actualizar" class="button radius tiny success" onClick=avoidDeleting();>
              </form>
            </div>
          </section>
        </div>
        
      </div>
    
    <script type="text/javascript">

      //Funcion para crear la alerta de estar seguros si queremos actualizar el usuario
      function avoidDeleting()
      {
        var msj = confirm("Deseas actualizar este usuario?");
        if(msj == false)
        {
          event.preventDefault();
        }
      }
    </script>

    <?php require_once('footer.php'); ?>


