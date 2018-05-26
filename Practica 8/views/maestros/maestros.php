<h1 align="center">Maestros</h1>
<input type="button" name="registrar_btn" value="Registrar Maestro" onclick="window.location='index.php?action=registrar_maestro'">

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center">
		
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
			$vistaMaestro = new MvcController();
			$vistaMaestro->vistaMaestrosController();
			$vistaMaestro->borrarMaestroController();

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