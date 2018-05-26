<h1 align="center">Alumnos</h1>
<input type="button" name="registrar_btn" value="Registrar Alumno" onclick="window.location='index.php?action=registrar_alumno'">

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center">
		
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

	<tbody>

		<?php
			$vistaAlumnos = new MvcController();
			$vistaAlumnos->vistaAlumnosController();
			$vistaAlumnos->borrarAlumnoController();

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