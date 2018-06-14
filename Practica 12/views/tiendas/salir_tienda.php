<?php
  //Se regresa el login si no existe
  if(!isset($_SESSION['validar']))
  {
    echo"<script>
            window.location = 'index.php?action=login';
          </script>";
  }
  else if($_SESSION['id']!=13)
  {
    echo"<script>
            window.location = 'index.php';
          </script>";
  }
  $mvc = new MvcController();
  $mvc->salirTiendaController();
?>