<?php

  //Requiere el archivo php donde estan todos los metodos que haran la sentencia SQL
  require_once('database_utilities.php');

  //Si se oprime el boton de registrar entonces se llaman todas las variables por metodo post y se agrega la venta
  if(isset($_POST["registrar"]))
  {

    if(isset($_POST["fecha"])) 
    {
      $fecha =  $_POST["fecha"];
    }

    if(isset($_POST["total"]))
    {
      $total = $_POST["total"];
    }

    //Se agrega la venta

    addSale($total,$fecha);

    //Se obtiene el ultimo id de la venta (la que acabamos de registrar) para asi poder registrar los detalles de la venta en base a esa venta
    $id_venta = queryLastSale();


    //Traemos el numero maximo de productos que pusimos por medo de JavaScript en un contenedor escondido para saber cuantos productos agregamos y asi poder
    //recorrer los distintos inputs que le pusimos un contador a lado del input para poderlos recorrer en un ciclo
    $iMax = $_POST['hid'];
             
    //Se recorre el ciclo en base al numero de productos
    for($i = 1; $i<=$iMax; $i++)
    {

   	  //Se obitene el nombre del producto mediante un post a un input que tiene como nombre prod + un numero consecutivo. Esto se hizo por medio de Javascript
      $nombre_producto = $_POST["prod".$i];

      //Lo mismo con cant
      $cant = $_POST["cant".$i];

      //Lo mismo con precio
      $precio = $_POST["precio".$i];

      //Se obtiene el id de producto en base al nombre del producto que se registro
      $id_prod = queryIdProduct($nombre_producto);

      //Se agrega el producto al detalle de la venta con todos sus datos
      addDetailsSale($id_venta,$id_prod,$cant,$precio);
    }


    //Se redirige a la vista de ventas
    header("Location:sales_view.php");
  
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
 
    <form method="POST" action="">
      
        <br><br>

        <div align='center'>
        <h2>Nueva Venta</h2>
        </div>
        <br><br>
        
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              
              <div align="center">
              <label>Fecha </label>
              <input type="text" name="fecha" style="width: 400px;" id="fecha" readonly>
              </div>
              <br>
              <hr width="500px;">
              <div name="div1" id="div1" style="width: 1000px;">
              <h3>Agregar Producto</h3>
              <br>
              <label>Producto </label>
              <select name="producto" id="producto" style="width: 400px;" >
                <?php 

                  // Se obtienen todos lo sproductos de la base de datos y se ponen en un select, se pone su precio y nombre
                  $resultados = queryProducts();
                  foreach( $resultados as $id => $user){
                 ?>
                  <option value="<?php echo $user['id']; ?>" ><?php echo $user['nombre'] . "$" . $user['precio']; ?></option>

               <?php } ?>
              </select>

              <br>
              <div align='right'>
              <input type="text" name="total" style="width: 400px;" id="total" placeholter='total' readonly>
              </div>
              
              <br>
              <label>Cantidad </label>
              <input type="number" name="cantidad" id="cantidad" style="width: 400px;">
              <input type="button" name="add" value="Agregar" onclick="agregarProd();" class="button radius tiny">
              <br><br>
              </div>
              <hr width="500px">
              <div align="center">
              <input type="submit" style='width:250px; height:75px; font-size: 150%;' name="registrar" value="Registrar Venta" class="button radius tiny success" id="btn">
              </div>
              </form>
            </div>
          </section>
        
        
      
    

    <?php require_once('footer.php'); ?>

  <script type="text/javascript">

  	  //Se obtiene la fecha del sistema y se ingresa en el input de fecha
      var fecha = document.getElementById('fecha');

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();

        if(dd<10) 
        {
          dd = '0'+dd
        } 

        if(mm<10) 
        {
          mm = '0'+mm
        } 

        today = yyyy + '-' + mm + '-' + dd;
      

      fecha.setAttribute("value",today);


      //Se crean diferentes variables como total para poderlos ingresar en las cajas de texto y asi imprimirlo sen pantalla en base a los productos que se escojan
      var total = 0;
      //Variable acumulativa que nos permitira hacer distintos inputs con el nombre del elemento mas el numero acumulativo, esto nos permitira para poder obtener esta 
      //informacion por PHP haciendo inputs con un numero consecutivo y asi recorrer un ciclo obteniendo estos valores e ingresandolos en la tabla detalle_Venta
      var count = 0;
      var div1 = document.getElementById("div1");

      //input escondido que nos permitira guardar cuantos productos se guardaron y asi poder recorrer un ciclo en base a eso
      var input_hidden = document.createElement("input");
      input_hidden.setAttribute("name","hid");
      input_hidden.setAttribute("type","hidden");
      div1.appendChild(input_hidden);

      var lTitulo = document.createElement("h4");
      lTitulo.innerHTML = "Venta";
      div1.appendChild(lTitulo);
      var br = document.createElement("br");
      var lDet = document.createElement("h5");
      div1.appendChild(lDet);
      var total1 = document.getElementById("total");


      //Funcion para agregar un producto cada vez que se seleccione algo y hacer todo dinamico, calculando el total
      function agregarProd()
      {
        var cantidad = document.getElementById("cantidad").value;
        if(cantidad != "" && cantidad != 0)
        {
            count++;
            

            var combo = document.getElementById("producto");
            var selected = combo.options[combo.selectedIndex].text;
            var res = selected.split("$");
            var nombre_producto = res[0];
            var precio = res[1];


            var input_article = document.createElement("input");
            var input_cantidad = document.createElement("input");
            var input_precio = document.createElement("input");
            var br2 = document.createElement("br");
            
            input_article.setAttribute("value", nombre_producto);
            input_article.setAttribute("style", "width:100px;");
            input_article.setAttribute("class", "n");
            input_article.setAttribute("readonly", "");

            //Se le pone como nombre la palabra producto mas el numero acumulativo
            input_article.setAttribute("name","prod" + count);
            input_precio.setAttribute("value",precio);
            input_precio.setAttribute("style", "width:100px;");
            input_precio.setAttribute("class", "n");
            input_precio.setAttribute("readonly", "");

            //Se le pone como nombre la palabra precio y el numero acumulativo
            input_precio.setAttribute("name","precio" + count);
            input_cantidad.setAttribute("value", cantidad);
            input_cantidad.setAttribute("style", "width:100px;")
            input_article.setAttribute("class", "n");
            input_cantidad.setAttribute("readonly", "");

            //Se le pone como nombre la palabra cant y el numero acumulativo
            input_cantidad.setAttribute("name","cant" + count);
            
            //Se agrega todo a pantalla
            div1.appendChild(br2);
            div1.appendChild(input_article);
            div1.appendChild(input_precio);
            div1.appendChild(input_cantidad);

            //Se calcula total
            total = total + (precio*cantidad);

            //Se ingresa el total en el input total
            total1.setAttribute("value",total);

            //Se agrega el numero maximo de productos en la caja de texto escondida
            input_hidden.setAttribute("value",count);
        }

      }

    </script>


