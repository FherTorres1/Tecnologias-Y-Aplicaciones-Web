<?php
if(isset($_POST["guardar"]))
  {
    if(isset($_POST["no_empleado"])) 
    {
      $no_empleado =  $_POST["no_empleado"];
    }

    if(isset($_POST["nombre"]))
    {
      $nombre = $_POST["nombre"];
    }

    if(isset($_POST["carrera"]))
    {
      $carrera = $_POST["carrera"];
    }

    if(isset($_POST["telefono"]))
    {
      $telefono = $_POST["telefono"];
    }

    $myfile = fopen("teachers.txt", "aw") or die("Unable to open file!");
	$txt = "$no_empleado\t$nombre\t$carrera \t$telefono\r\n";
	fwrite($myfile, $txt);
	fclose($myfile);

	header("location: teacher_view.php");

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
        <h3>Formulario Maestro</h3>
        <br><br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="POST">
              <label>No. Empleado: </label>
              <input type="text" name="no_empleado">
              <br>
              <label>Nombre: </label>
              <input type="text" name="nombre">
              <br>
              <label>Carrera: </label>
              <select name="carrera">
                <option value="ITI">Ing en Tecnologias de la Informacion</option>
                <option value="IM">Ing en Mecatronica</option>
                <option value="ITM">Ing en Tecnologias de la Manufactura</option>
                <option value="ISA">Ing en Sistemas Automotrices</option>
                <option value="PYMES">Lic en Administracion y Gestion de PyMES</option>
              </select>
              <br><br>
              <label>Telefono: </label>
              <input type="text" name="telefono">
              <br>
              
              <input type="submit" name="guardar" value="GUARDAR" class="button">
              </form>
            </div>
          </section>
        </div>
        
      </div>
    

    <?php require_once('footer.php'); ?>	
