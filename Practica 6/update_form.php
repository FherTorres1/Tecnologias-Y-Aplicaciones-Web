<?php

  //Se obtiene el id del usuario que fue seleccionado por paso de variable
  $idBf = isset( $_GET['id'] ) ? $_GET['id'] : '';

  //Se obtiene el tipo de deportista para saber si es basquetbolista o futbolista
  $type = isset( $_GET['type'] ) ? $_GET['type'] : '';

  //Esto se hace meramente para poner un letrero de que tipo de deportista es
  if($type == 1)
  {
    $tipo = "Futbolista";
  }
  else if($type == 2)
  {
    $tipo = "Basquetbolista";
  }
  //Se requiere el archivo database_utilities.php para los distintos metodos con sentencias SQL
  require_once('database_utilities.php');

  //Se busca la informacion de ese deportista con el metodo search_per_id donde se hara un query a la base de datos con el id del usuario
  // que fue seleccionado y poderlos mostrar en las cajas de texto
  $resultados = search_per_id($type,$idBf);

  //Despues de que los datos fueron cambiados y se presiono el boton de guardar, se mandan llamar los datos para poder registrarlos en la base de datos  
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

    //Metodo add para actualizar el usuario, se ponen dos id's para saber si el id que se esta registrando es el mismo que el
    //que esta en la base de datos y asi poder evitar que haya algun error ya que es posible actualizar los id's evitando
    //que se repitan
    if(!(update($type,$id,$idBf,$nombre,$posicion,$carrera,$email)))
    {
      //Funcion para crear la alerta donde nos senalara que ya existe un deportista con ese id
      echo 
      "<script type='text/javascript'>
          alert('Ya existe un jugador con ese numero(id)')
          event.preventDefault();
      </script>";
    }
    else
    {
      //Si todo sale bien entonces nos redirigira a la tabla donde se mostraran los deportistas
      header("Location: sports_view.php");
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
        <h3>Actualizar <?php echo$tipo?></h3>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>Numero Dorso (ID):  </label>
              <input type="text" name="id" value="<?php echo $resultados['id'];?>">
              <br>
              <label>Nombre: </label>
              <input type="text" name="nombre" value="<?php echo $resultados['nombre'];?>">
              <br>
              <label>Posicion: </label>
              <input type="text" name="posicion" value="<?php echo $resultados['posicion'];?>">
              <br>
              <label>Carrera: </label>
              <select name="carrera">
                <option <?php if ($resultados['carrera'] == "ITI") echo 'selected' ; ?> value="ITI">Ing en Tecnologias de la Informacion</option>
                <option <?php if ($resultados['carrera'] == "IM") echo 'selected' ; ?> value="IM">Ing en Mecatronica</option>
                <option <?php if ($resultados['carrera'] == "ITM") echo 'selected' ; ?>  value="ITM">Ing en Tecnologias de la Manufactura</option>
                <option <?php if ($resultados['carrera'] == "ISA") echo 'selected' ; ?>  value="ISA">Ing en Sistemas Automotrices</option>
                <option <?php if ($resultados['carrera'] == "PYMES") echo 'selected' ; ?>  value="PYMES">Lic en Administracion y Gestion de PyMES</option>
              </select>
              <br>
              <label>Correo Electronico: </label>
              <input type="email" name="email" value="<?php echo $resultados['email'];?>">
              <input type="submit" name="guardar" value="Actualizar" class="button radius tiny success" onClick=avoidDeleting();>
              </form>
            </div>
          </section>
        </div>
        
      </div>
    
    <script type="text/javascript">

      //Funcion para crear la alerta de estar seguros si queremos actualizar el deportista
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


