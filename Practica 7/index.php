<?php

require_once('database_utilities.php');

if( isset($_COOKIE)
    &&is_array($_COOKIE)
    && count($_COOKIE)>0
    && isset($_COOKIE['username'])
    && $_COOKIE['username']!=null
){
    session_start();
    $_SESSION['username']=$_COOKIE['username'];
}


if(isset($_GET['action'])
    && $_GET['action']=='logout'){

	//Se elimina la cookie para hacer definitivo el logeo del usuario
    setcookie("username","",time()-3600);
    unset($_SESSION['username']);
}
if (isset($_POST['formu'])){

//Imprime el array con los datos de acceso, una vez logueado
    if( isset($_POST['formu']['nombre'])
        &&isset($_POST['formu']['pass'])
        //Se manda llamar la funcion findUser para saber si el usuario y contrasena que se ingreso son correctas
        &&findUser($_POST['formu']['nombre'],$_POST['formu']['pass'])
    ){
        session_start();
        $_SESSION['username']=$_POST['formu']['nombre'];
        setcookie("username", $_POST['formu']['nombre']);
    }

}?>
<html>
<head>
    <title>Sesiones en PHP7</title>
</head>

<body>
<?php
if( isset($_SESSION)
    &&is_array($_SESSION)
    && count($_SESSION)>0
){
    ?>
    
    <?php
}
if(isset($_SESSION['username']) && $_SESSION){
    


    //estoy logueado
    ?>
    <?php
    include_once('header.php');
    echo "<div align='center'>";
    echo "<h3>Bienvenido</h3>";
    echo "<h4>".$_SESSION['username']."</h4>";
    echo "<a href='./sales_view.php' class='button radius tiny' style='width:200px; font-size:150%;'>Venta</a><br>";
    echo "<a href='./products_view.php' class='button radius tiny' style='width:200px; font-size:150%;'>Productos</a><br>";
    echo "<a href='./users_view.php' class='button radius tiny' style='width:200px; font-size:150%;'>Usuarios</a>";
    echo "</div>";
    echo "<a href='?action=logout'>Logout</a>";
    include_once('footer.php');
}else{
    



    //estoy deslogueado
    ?>

    <?php require_once('header.php'); ?>
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
          </div>
          <FORM ACTION="index.php" name="formu" METHOD="post">
          <label for="nombre">Usuario</label>
          <input type="text" name="formu[nombre]"  id="nombre"
               


               value="<?php
               if(isset($_POST['formu']['nombre'])&&$_POST['formu']['nombre']!=null){
                   echo $_POST['formu']['nombre'];
               }
               ?>">


          <br/>
          <label for="valor">Contraseña</label>
          <input type="text" name="formu[pass]"  id="valor"
               

               value="<?php
               if(isset($_POST['formu']['pass'])
                   &&$_POST['formu']['pass']!=null){
                   echo $_POST['formu']['pass'];
               }
               ?>">
          <br/>
          <input type="submit" name="formu[enviar]" value="Iniciar Sesion" class="button radius tiny"/>
        </FORM>
      </div>
    </section>
  </div>
        
</div>

      <?php require_once('footer.php'); ?>

    <?php
}
?>
