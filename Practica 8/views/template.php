<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Practica 8</title>
    <link rel="stylesheet" href="views/css/foundation.css" />
    <script src="views/js/vendor/modernizr.js"></script>
    <script src="views/js/vendor/jquery.js"></script>
    <link rel="stylesheet" href="views/css/select2.min.css" />
    <script src="views/js/select2.min.js"></script>
    <script src="views/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="views/css/jquery.dataTables.min.css" />

	<style>

		header{
			position:relative;
			margin:auto;
			text-align:center;
			padding:5px;
		}

		nav{
			position:relative;
			margin:auto;
			width:100%;
			height:auto;
			background:black;
		}

		nav ul{
			position:relative;
			margin:auto;
			width:50%;
			text-align: center;
		}

		nav ul li{
			display:inline-block;
			width:24%;
			line-height: 50px;
			list-style: none;
		}

		nav ul li a{
			color:white;
			text-decoration: none;
		}

		section{
			position:relative;
			padding:20px;
		}

	</style>


</head>
<body>
	<?php
		//Se requioere la navegacion
		require_once("modules/navegacion.php");
		require_once("controllers/controller.php");
		$mvc = new MvcController();
		$mvc->enlazarPagina();	
	?>


</body>
</html>

<script type="text/javascript">
 //Funcion de JS para enlazar los id de las tablas con y decirles que esos ID son datatable
  $(document).ready(function(){
    $('#example').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();

  })
</script>
