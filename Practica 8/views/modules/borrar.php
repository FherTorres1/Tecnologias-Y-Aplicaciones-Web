<!DOCTYPE html>
<html>
<head>
	<title>Registrar empleado</title>
</head>
<body>
	<h1>Registrar empleado</h1>
	<table width="100%">
        <thead>
            <td>Id</td>
             <td>Nombre</td>
             <td>Telefono</td>
              <td></td>
            
        </thead>
           	<tbody>
              <?php 
              		$mvc = new MVC();
              		$mvc->obtenerDatosUsuarioController(); 
               ?>
            </tbody>
    </table>
</body>
</html>

