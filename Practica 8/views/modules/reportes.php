<?php
	//Se comprueba si se ha iniciado sesion
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
<h1 align="center">Reportes</h1>
<link rel="stylesheet" href="./css/foundation.css"/><br><br><br>
<h3 align="center">Alumnos</h3>
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
			//Se hace una instancia del controlador
			$vistaAlumnos = new MvcController();
			//Se manda llamar al vista de alumnos
			$vistaAlumnos->vistaAlumnosController();
			$vistaAlumnos->borrarAlumnoController();

		?>
	</tbody>
</table>
<br>
<br>
<br>
<br>
<h3 align="center">Maestros</h3>
<table border="2" align="center" class="display" width="80%" id="example2">
		
	<thead>
			
		<tr>
			<th>Numero</th>
			<th>Carrera</th>
			<th>Nombre</th>
			<th>Correo</th>
			<th>Password</th>
			<th>Editar?</th>
			<th>Borrar?</th>
		</tr>

	</thead>
	</thead>

	<tbody>

		<?php
			//Se manda llamar la vista de maestros
			$vistaAlumnos->vistaMaestrosController();
			$vistaAlumnos->borrarAlumnoController();

		?>
	</tbody>
</table>

<br>
<br>
<br>
<br>
<h3 align="center">Tutorias</h3>
<table border="2" align="center" class="display" width="80%" id="example3">
		
	<thead>
			
		<tr>
			<th>Numero</th>
			<th>Nombre Alumno</th>
			<th>Nombre Maestro</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Tipo</th>
			<th>Descripcion</th>
		</tr>

	</thead>
	</thead>

	<tbody>

		<?php
			//Se manda llamar la vista de reportes
			$vistaAlumnos->vistaReporteTutoriasController();

		?>
	</tbody>
</table>



<script type="text/javascript">
	function confirmar()
	{
		var x = confirm("Seguro que deseas borrar el registro?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>