<h1>EDITAR ALUMNO</h1>

<form method="post">
	
	<?php

		$editarAlumno = new MvcController();
		$editarAlumno -> editarAlumnoController();
		$editarAlumno -> actualizarAlumnoController();

	?>

</form>

<script type="text/javascript">
	function confirmar()
	{
		var x = confirm("Deseas guardar los datos?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>