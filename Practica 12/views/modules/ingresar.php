<h1>INGRESAR</h1>

	<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
		
		<input type="text" placeholder="Usuario" name="usuarioIngreso" required>

		<input type="password" placeholder="Contraseña" name="passwordIngreso" required>

		<input type="submit" value="Iniciar Sesion" class="tiny button" style='width: 100%; font-size: 14px;'>

	</form>

<?php

//Se hace una instancia del controlador
$ingreso = new MvcController();
//Se manda llamar el metodo para hacer el login
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

}

?>