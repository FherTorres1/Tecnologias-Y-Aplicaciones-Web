<h1 align="center">Mis Tutorias</h1>
<input type="button" name="registrar_btn" value="Registrar Maestro" onclick="window.location='index.php?action=registrar_tutoria'">

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center">
		
	<thead>
			
		<tr>
			<th>Id</th>
			<th>Alumno</th>
			<th>Tutor</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Tipo</th>
			<th>Descripcion</th>
			<th>Borrar?</th>
		</tr>

	</thead>

	<tbody>

		<?php
			$vistaTutoria = new MvcController();
			$vistaTutoria->vistaTutoriasController();
			//$vistaMaestro->borrarMaestroController();

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