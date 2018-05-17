<?php

  //Requiere el archivo php donde estan todos los metodos que haran la sentencia SQL
  require_once('database_utilities.php');


  //Despues de presionar el boton de registrar, se usara el metodo POST para guardar los datos y mandar llamar la funcion addProduct que registrara el nuevo producto
  if(isset($_POST["guardar"]))
  {
    if(isset($_POST["nombre"])) 
    {
      $nombre =  $_POST["nombre"];
    }

    if(isset($_POST["precio"]))
    {
      $precio = $_POST["precio"];
    }


    addProduct($nombre,$precio);

    //Se redirige a la lista de productos
    header("Location:products_view.php");
  
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
        <h3>Formulario de Nuevo Producto</h3>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>Nombre </label>
              <input type="text" name="nombre">
              <br>
              <label>Precio </label>
              <input type="number" name="precio">
              <input type="submit" name="guardar" value="Registrar" class="button radius tiny success">
              </form>
            </div>
          </section>
        </div>
        
      </div>
    

    <?php require_once('footer.php'); ?>


