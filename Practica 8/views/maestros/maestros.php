<?php
	//Se comprueba si se ha inciiado sesion
	if(!isset($_SESSION['tipo']))
	{
		header("Location: index.php");
	}
	else
	{
		//Se comprueba si es superadmin
		if($_SESSION['tipo'] == 2)
		{
			header("Location: index.php?action=tutorias");
		}
	}
?>
<h1 align="center">Maestros</h1>
<div align="center">
<input type="button" name="registrar_btn" value="Registrar Maestro" class="button tiny success" style='width: 20%; font-size: 20px;' onclick="window.location='index.php?action=registrar_maestro'">
</div>

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center" class="display" width="80%" id="example">
		
	<thead>
			
		<tr>
			<th>Numero</th>
			<th>Carrera</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Password</th>
			<th>Editar?</th>
			<th>Borrar?</th>
		</tr>

	</thead>

	<tbody>

		<?php
			//Se hace una instancia del controlador
			$vistaMaestro = new MvcController();
			//Se manda llamar la vista
			$vistaMaestro->vistaMaestrosController();
			//Se manda llamar el metodo para borrar algun maestro
			$vistaMaestro->borrarMaestroController();

		?>
	</tbody>
</table>


<script type="text/javascript">
	//Funcion de JS para comprobar si queremos borrar algun maestro
	function confirmar()
	{
		var x = confirm("Seguro que deseas borrar el registro?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>