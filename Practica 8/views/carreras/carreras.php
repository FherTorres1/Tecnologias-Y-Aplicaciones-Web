<?php
	//Se comprueba si se ha inciiado sesion
	if(!isset($_SESSION['tipo']))
	{
		header("Location: index.php");
	}
	else
	{
		//Se comprueba si el usuario es superadmin
		if($_SESSION['tipo'] == 2)
		{
			header("Location: index.php?action=tutorias");
		}
	}
?>
<h1 align="center">Carreras</h1>
<div align="center">
<input type="button" name="registrar_btn" value="Registrar Carrera" class="button tiny success" style='width: 20%; font-size: 20px;' onclick="window.location='index.php?action=registrar_carrera'">
</div>

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center" class="display" width="80%" id="example">
		
	<thead>
			
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Editar?</th>
			<th>Borrar?</th>
		</tr>

	</thead>

	<tbody>

		<?php
			//Se hace una instancia del controlador
			$vistaCarrera = new MvcController();
			//Se manda llamar el metodo para traer la vista de las carreras
			$vistaCarrera->vistaCarrerasController();
			//Se manda llamar el metodo para borrar alguna carrera
			$vistaCarrera->borrarCarreraController();

		?>
	</tbody>
</table>


<script type="text/javascript">
	//Funcion de JS para confirmar si queremos borrar una carrera
	function confirmar()
	{
		var x = confirm("Seguro que deseas borrar el registro?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>