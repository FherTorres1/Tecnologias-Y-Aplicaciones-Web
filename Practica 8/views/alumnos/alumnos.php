<?php
	//Se comprueba si el usuario ha iniciado sesion
	if(!isset($_SESSION['tipo']))
	{
		header("Location: index.php");
	}
	else
	{
		//Se comprueba si el usuario es el superadmin para darle luz verde de acceder
		if($_SESSION['tipo'] == 2)
		{
			header("Location: index.php?action=tutorias");
		}
	}
?>
<h1 align="center">Alumnos</h1>
<div align="center">
<input type="button" name="registrar_btn" value="Registrar Alumno" class="button tiny success" style='width: 20%; font-size: 20px;'onclick="window.location='index.php?action=registrar_alumno'">
</div>

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center" class="display" width="80%" id="example">
		
	<thead>
			
		<tr>
			<th>Matricula</th>
			<th>Nombre</th>
			<th>Carrera</th>
			<th>Tutor</th>
			<th>Editar?</th>
			<th>Borrar?</th>
		</tr>

	</thead>
	</thead>

	<tbody>

		<?php
			//Se hace una instancia del objeto MvcController
			$vistaAlumnos = new MvcController();
			//Se manda llamar al metodo que traera la vista de los alumnos
			$vistaAlumnos->vistaAlumnosController();
			//Se manda llamar al metodo que eliminara a algun alumno
			$vistaAlumnos->borrarAlumnoController();

		?>
	</tbody>
</table>

<script type="text/javascript">

	//Funcion de JS para comprobar si realmente se quiere borrar el registro
	function confirmar()
	{
		var x = confirm("Seguro que deseas borrar el registro?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>