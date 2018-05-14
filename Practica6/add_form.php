<?php

  //Requiere el archivo php donde estan todos los metodos que haran la sentencia SQL
  require_once('database_utilities.php');

  //Se trae una variable type a traves del paso por URL, para saber que tipo de deportista es
  //Esto se utiliza para solo usar un formulario para los tipos de deportistas, y no dos, 1 es Futbolista, 2 es Basquetbolista
  //Y asi poderlos registrar en su respectiva tabla
  $type = isset( $_GET['type'] ) ? $_GET['type'] : '';

  //Esta variable tipo solamente se utiliza con propositos para senalar que tipo de deportista se va a registrar
  //"Futbolista" o "Basquetbolista" y esto se imprimira en el formulario mas abajo
  if($type==1)
  {
    $tipo = "Futbolista";
  }
  else if ($type==2)
  {
    $tipo = "Basquetbolista";
  }

  //Despues de presionar el boton de registrar, se usara el metodo POST para guardar los datos y mandar llamar la funcion add que registrara el nuevo usuario
  if(isset($_POST["guardar"]))
  {
    if(isset($_POST["id"])) 
    {
      $id =  $_POST["id"];
    }

    if(isset($_POST["nombre"]))
    {
      $nombre = $_POST["nombre"];
    }

    if(isset($_POST["posicion"]))
    {
      $posicion = $_POST["posicion"];
    }

    if(isset($_POST["carrera"]))
    {
      $carrera = $_POST["carrera"];
    }

    if(isset($_POST["email"]))
    {
      $email = $_POST["email"];
    }

    //Metodo add para registrar nuevo usuario
    //Este metodo regresa un valor tipo booleano para saber si el numero(ID) que quiere registrar ya existe. Si existe entonces
    //regresa un false y si no un true
    if(!(add($type,$id,$nombre,$posicion,$carrera,$email)))
    {
      //Si la funcion regresa un false entonces se lanzara una alerta que el deportista ya existe y entonces no dejara registrar al nuevo deportista
      echo 
      "<script type='text/javascript'>
          alert('Ya existe un jugador con ese numero(id)')
          event.preventDefault();
      </script>";
    }
    //De lo contrario se registrara el nuevo deportista y nos mandara de nuevo a la visualizacion de estos
    else
    {
      header("location: sports_view.php");
    }
  
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
        <!-- Aqui se imprime el letrero de formulario y acontinuacion una variable PHP que dira que tipo de deportista es si
        Futbolista o Basquetbolista -->
        <h3>Formulario de Nuevo <?php echo$tipo?></h3>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>Numero Dorso (ID):  </label>
              <input type="text" name="id">
              <br>
              <label>Nombre: </label>
              <input type="text" name="nombre">
              <br>
              <label>Posicion: </label>
              <input type="text" name="posicion">
              <br>
              <label>Carrera: </label>
              <select name="carrera">
                <option value="ITI">Ing en Tecnologias de la Informacion</option>
                <option value="IM">Ing en Mecatronica</option>
                <option value="ITM">Ing en Tecnologias de la Manufactura</option>
                <option value="ISA">Ing en Sistemas Automotrices</option>
                <option value="PYMES">Lic en Administracion y Gestion de PyMES</option>
              </select>
              <br>
              <label>Correo Electronico: </label>
              <input type="email" name="email">
              <input type="submit" name="guardar" value="Registrar" class="button radius tiny success">
              </form>
            </div>
          </section>
        </div>
        
      </div>
    

    <?php require_once('footer.php'); ?>


