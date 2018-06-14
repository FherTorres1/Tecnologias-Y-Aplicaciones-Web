<?php
	//Clase MvcController (CONTROLADOR)
	class MvcController
	{
		//Funcion plantilla que trae toda la plantilla y su navegacion
		public function plantilla()
		{
			require("views/template.php");
		}

		//Funcion para enlazar pagina donde tendremos una accion y esta nos permitira obtener la vista deseada
		public function enlazarPagina()
		{
			if(isset($_GET['action']))
			{
				$enlace = $_GET['action'];
			}
			else
			{
				$enlace = 'inicio';
			}

			$respuesta = Informacion::enlazador($enlace);
			include($respuesta);
		}
		//Funcion para registrar un producto
		public function registrarProductoController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{
				if(!empty($_POST['nombre']))
				{
					$today = date("Y-m-d H:i:s"); 
					$datosController = array('codigo'=>$_POST['codigo'],
											 'nombre'=>$_POST['nombre'],
											 'date'=>$today,
											 'precio'=>$_POST['precio'],
											 'unidades'=>$_POST['unidades'],
											 'categoria'=>$_POST['categoria'],
											 'id_tienda'=>$_SESSION['id_tienda']);

					$respuesta = Datos::registrarProductoModel($datosController,'producto');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
						window.location = 'index.php?action=productos';
					 </script>";
			}
		}

		//Funcion para registrar una categoria nueva
		public function registrarCategoriaController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{

				if(!empty($_POST['nombre']))
				{
					$today = date("Y-m-d H:i:s"); 
					$datosController = array('nombre'=>$_POST['nombre'],
											 'descripcion'=>$_POST['descripcion'],
											 'date'=>$today,
											 'id_tienda'=>$_SESSION['id_tienda']);

					$respuesta = Datos::registrarCategoriaModel($datosController,'categoria');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
						window.location = 'index.php?action=categorias';
					</script>";
			}
		}

		//Funcion para registrar un usuario nuevo
		public function registrarUsuarioController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{
				if(!empty($_POST['email']))
				{
					$today = date("Y-m-d H:i:s"); 
					$datosController = array('nombre'=>$_POST['nombre'],
											 'apellido'=>$_POST['apellido'],
											 'user'=>$_POST['user'],
											 'password'=>($_POST['password']),
											 'email'=>$_POST['email'],
											 'date'=>$today,
											 'id_tienda'=>$_SESSION['id_tienda']);

					$respuesta = Datos::registrarUsuarioModel($datosController,'user');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
							window.location = 'index.php?action=usuarios';
						</script>";
			}
		}

		//Funcion para registrar una tienda nueva siendo el SUPERADMIN quien realiza la accion
		public function registrarTiendaController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{
				if(!empty($_POST['nombre']))
				{
					$datosController = array('nombre'=>$_POST['nombre'],
											 'direccion'=>$_POST['direccion']);

					$respuesta = Datos::registrarTiendaModel($datosController,'tienda');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
							window.location = 'index.php?action=tiendas';
						</script>";
			}
		}

		public function vistaVentasController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta=Datos::vistaVentasModel("venta",$datosController);

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_venta"].'</td>
					<td>'.$item["fecha_venta"].'</td>
					<td>'.$item["total_venta"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="confirmarDelete('.$item["id_venta"].');" href="index.php?action=ventas&idBorrar='.$item["id_venta"].'" id="btn'.$item["id_venta"].'">Eliminar</a>
                            <a class="dropdown-item" href="index.php?action=detalle_venta&idDetalle='.$item["id_venta"].'">Detalles de Venta</a>
                          </div></td>
				</tr>';
			}
		}

		//Funcion que muestra todos los detalles de una venta
		public function vistaDetalleController()
		{
			if(isset($_GET['idDetalle']))
			{
				$datosController = $_GET['idDetalle'];
				$respuesta=Datos::vistaDetalleModel("venta_producto",$datosController);

				foreach($respuesta as $row => $item){
				echo'<tr>
						<td>'.$item["codigo_producto"].'</td>
						<td>'.$item["nombre_producto"].'</td>
						<td>'.$item["cantidad"].'</td>
					</tr>';
				}
			}
		}
		//Funcion para registrar una venta siempre y cuando almenos un producto se haya elegido
		public function registrarVentaController()
		{
			if(isset($_POST['idC0']))
			{	
				$fecha = date("Y-m-d H:i:s");
				$datosController = array("tienda"=>$_SESSION['id_tienda'],
										 "fecha"=>$fecha,
										 "total"=>$_POST['total']);

				$respueta=Datos::registrarVentaModel("venta",$datosController);
				$idController = $_SESSION['id_tienda'];
				$respuesta2=Datos::vistaVentasModel("venta",$idController);
				$idVenta=$respuesta2[count($respuesta2)-1][0];

				for($i = 0; $i<$_POST['count'];$i++)
				{
					$datosController = array("id"=>$_POST['idC'.$i],
											 "codigo"=>$_POST['codigoC'.$i],
											 "nombre"=>$_POST['nombreC'.$i],
											 "cantidad"=>$_POST['cantC'.$i],
											 "stock"=>$_POST['stock'.$_POST['codigoC'.$i]],
											 "venta"=>$idVenta);

					$respueta=Datos::registrarProductosVentasModel("venta_producto",$datosController);
					$respuesta2=Datos::updateStockModelForSales($datosController,"producto");

					$fecha = date("Y-m-d H:i:s");
					$nota = 'El empleado ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . ' vendió ' . $_POST['cantC'.$i] . ' producto(s)';
					$datosController2=array("idProducto"=>$_POST['idC'.$i],
										    "idUser"=>$_SESSION['id'],
										    "fecha"=>$fecha,
										    "nota"=>$nota,
										    "referencia"=>"venta",
										    "cantidad"=>$_POST['cantC'.$i],
										    "id_tienda"=>$_SESSION['id_tienda']);
					$respuesta3 = Datos::insertarHistorialModel($datosController2,"historial");

					echo '<script>
									swal({title: "Exito!", 
									text: "Stock realizada!!", 
										 type: "success"});
									window.location = "index.php?action=ventas";
								</script>';


				}
			}
		}
		//Funcion para obtener los datos de todos los productos de su respectiva tienda y hacer
		//una venta
		public function obtenerDatosVentaController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::vistaProductosModel("producto",$datosController);
				echo '<section class="content">
      					<div class="container-fluid">
        					<div class="col-12">
        						<div class="card card-default">
          							<div class="card-header">
            							<h3 class="card-title">'.$respuesta[0][2] .'</h3>
														<div class="card-tools">
              								<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            								</div>
          							</div>
          							<!-- /.card-header -->
          							<div class="card-body">
            							<div class="row">
              							<div class="col-md-6">
                							<div class="form-group">
                  							<center><img src="views/dist/img/stock.png" width="275" height="200" alt="Imagen de producto"></center>
                							</div>
                							<!-- /.form-group -->
                							<div class="form-group">
	                									<h4 id="label1">Stock disponible: '.$respuesta[0]['stock'].'</h4>
                  									<h4 id="label2" style="color:green;">Precio de venta: $'.$respuesta[0]['precio_producto'].'</h4>
                							</div>
                							<div class="form-group">
                							</div>
                							<!-- /.form-group -->
              							</div>
              							<!-- /.col -->
              							<div class="col-md-6">
                							<div class="form-group">
                							<h4>Producto: </h4>
                  							<select id="producto" onchange="changeLabels();"class="form-control select2" style="width: 100%;" name="producto">
                  							';
                  							foreach($respuesta as $row => $item)
                  							{
                  								echo'<option value='.$item["codigo_producto"].'>'.$item["codigo_producto"].' - ' .$item["nombre_producto"].'</option>';
                  							}
                  							foreach($respuesta as $row => $item)
                  							{
                  								echo '<input type="hidden" name="precio'.$item['codigo_producto'].'" id="precio'.$item['codigo_producto'].'" value="'.$item['precio_producto'].'">';
                  								echo '<input type="hidden" name="stock'.$item['codigo_producto'].'" id="stock'.$item['codigo_producto'].'" value="'.$item['stock'].'">';
                  								echo '<input type="hidden" name="id'.$item['id_producto'].'" id="id'.$item['codigo_producto'].'" value="'.$item['id_producto'].'">';
                  							}
                  							echo '
                  							</select><br>
                  							<input type="button" onclick="addProducts();" class="btn btn-success" value="Agregar Producto"></button>
                							</div>
							                <!-- /.form-group -->
							                
                							<!-- /.form-group -->
              							</div>
              							<!-- /.col -->
            							</div>

            							<!-- /.row -->
          							</div>
          							<br>
          							<h4 id="total" style="color:green;"></h4>
          							<input type="hidden" name="total" id="inTotal">
          							<input type="hidden" name="count" id="count">
          							<table id="table1" class="table table-bordered table-striped">
                						<thead class="bg-success">
                							<tr>
                  								<th>ID</th>
								                <th>Codigo</th>
								                <th>Descripción</th>
								                <th>Precio de Venta</th>
								                <th>Cantidad</th>
								                <th>Total</th>
                							</tr>
                						</thead >
										<tbody>';
								   echo'</tbody>
										</table>
										<center>
		                  				<input type="submit" class="btn btn-success" value="Agregar Venta"></button>
		                  				<input type="button" class="btn btn-danger" value="Cancelar Venta"></button>
		                  			</center>
		                  			<br>
		                  			<br>
    								</div>
										</section>';
			
			
		}


		//Funcion del controlador que sirve para hacer la vista de todos los productos
		public function vistaProductosController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::vistaProductosModel("producto",$datosController);

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
			foreach($respuesta as $row => $item){
			echo'<tr>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["id_producto"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["codigo_producto"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["nombre_producto"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["precio_producto"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["stock"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["nombre_categoria"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_producto&id='.$item["id_producto"].'">Actualizar</a>
                            <a class="dropdown-item" onclick="confirmarDelete('.$item["id_producto"].');" href="index.php?action=productos&idBorrar='.$item["id_producto"].'" id="btn'.$item["id_producto"].'">Eliminar</a>
                            <a class="dropdown-item" href="index.php?action=movimiento&id='.$item["id_producto"].'">
                            	Realizar movimiento</a>
                          </div></td>
				</tr>';
			}

		}

		//Funcion para obtener los productos y mostrarlos en la interfaz para hacer un movimiento de inventario
		public function obtenerDatosProductoController()
		{

			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::obtenerProductoModel($datosController, "producto");

				echo '<section class="content">
      					<div class="container-fluid">
        					<div class="col-12">
        						<div class="card card-default">
          							<div class="card-header">
            							<h3 class="card-title">'.$respuesta[0][2] .'</h3>
														<div class="card-tools">
              								<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            								</div>
          							</div>
          							<!-- /.card-header -->
          							<div class="card-body">
            							<div class="row">
              							<div class="col-md-6">
                							<div class="form-group">
                  							<center><img src="views/dist/img/stock.png" width="275" height="200" alt="Imagen de producto"></center>
                							</div>
                							<!-- /.form-group -->
                							<div class="form-group">
	                							<div class="input-group-prepend">
	                							<input type="hidden" name="stockBd" value="'.$respuesta[0]['stock'].'"> 
	                							<input type="hidden" name="idProducto" value="'.$datosController.'"> 
		                  							<input required type="text" name="referencia" class="form-control" placeholder="Referencia" style="width:200px;">           
		                  							<span style="width:90px;" class="input-group-text">Unidades</span>
		                  							<input required name="cantidad" type="number" style="width:70px;"type="text" class="form-control">
		                  						</div>
                							</div>
                							<div class="form-group">
                							</div>
                							<!-- /.form-group -->
              							</div>
              							<!-- /.col -->
              							<div class="col-md-6">
                							<div class="form-group">
                							<h4>Categoria: '.$respuesta[0]['nombre_categoria'].'</h4>
                  							<h4>Descripcion: '.$respuesta[0]['descripcion_categoria'].'</h4>
                  							<h4>Stock disponible: '.$respuesta[0]['stock'].'</h4>
                  							<h4 style="color:green;">Precio de venta: $'.$respuesta[0]['precio_producto'].'</h4>
                							</div>
							                <!-- /.form-group -->
							                
                							<!-- /.form-group -->
              							</div>
              							<!-- /.col -->
            							</div>

            							<!-- /.row -->
          							</div>
          							<center>
		                  				<input type="image" src="views/dist/img/stock-in.png"name="entrada" value="Entrada">           
		                  				<input type="image" src="views/dist/img/stock-out.png" name="salida" value="Salida">
		                  			</center><br><br>
          							<table id="historialT" class="table table-bordered table-striped">
                						<thead class="bg-success">
                							<tr>
                  								<th>Fecha</th>
                  								<th>Producto</th>
								                <th>Descripcion</th>
								                <th>Referencia</th>
								                <th>Total</th>
                							</tr>
                						</thead >
										<tbody>';
										//Se manda llamar la tabla donde se mostrara el historial de los movimientos que se realizaron ese dia
										$this->vistaHistorialController();
								   echo'</tbody>
										</table>
    								</div>
										</section>';
			}
			
		}
		//Funcion para hacer la vista de los widget en base a la informacion obtenida de la base de datos (Se hacen counts y se hace un widget
		//para el control)
		public function vistaDashboardController()
		{

			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::countUsersModel("producto",$datosController);
			echo '<div class="col-lg-3 col-6">
                  	<div class="small-box bg-info">
                    	<div class="inner">
                      		<h3>'.$respuesta[0][0].'</h3>
							<p>Productos</p>
                    	</div>
                    	<div class="icon">
                      		<i class="fa fa-shopping-cart"></i>
                    	</div>
                    	<a href="index.php?action=productos" class="small-box-footer">
                      		More info <i class="fa fa-arrow-circle-right"></i>
                    	</a>
                  	</div>
                </div>';
            $respuesta = Datos::countProductsModel("user",$datosController);
            echo '<div class="col-lg-3 col-6">
            		<!-- small card -->
            		<div class="small-box bg-warning">
              			<div class="inner">
                			<h3>'.$respuesta[0][0].'</h3>
							<p>Usuarios</p>
              			</div>
              			<div class="icon">
                			<i class="ion ion-person-add"></i>
              			</div>
	              			<a href="index.php?action=usuarios" class="small-box-footer">
	                			More info <i class="fa fa-arrow-circle-right"></i>
	              			</a>
            			</div>
          		</div>';

          	$respuesta = Datos::countCategoriesModel("categoria",$datosController);

          	echo '<div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>'.$respuesta[0][0].'</h3>

                <p>Categorias</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="index.php?action=categorias" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>';
		}

		//Funcion para hacer el movimiento de stock
		public function controlarStockController()
		{
			//Si se oprime el boton de entrada
			if(isset($_POST['entrada']))
			{
				if(!empty($_POST['cantidad']) && !empty($_POST['referencia']))
				{	
					$stockBD = $_POST['stockBd'];
					$cantity = $_POST['cantidad'];
					//Se suma la cantidad con el stock anterior
					$newStock = $stockBD + $cantity;

					$datosController = array('cantidad'=>$newStock,
										     'id'=>$_POST['idProducto']);
					//Se actualiza el stock de ese producto
					$respuesta = Datos::updateStockModel($datosController,"producto");

					//Insercion del historial
					if($respuesta=="success")
					{	

						$fecha = date("Y-m-d H:i:s");
						$nota = 'El empleado ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . ' agrego ' . $cantity . ' producto(s) al inventario';
						$datosController = array('idProducto'=>$_POST['idProducto'],
												 'idUser'=>$_SESSION['id'],
												 'fecha'=>$fecha,
												 'nota'=>$nota,
												 'referencia'=>$_POST['referencia'],
												 'cantidad'=>$cantity,
												 'id_tienda'=>$_SESSION['id_tienda']);
						//Se hace la insercion en el historial con los datos de la actualizacion anterior
						$respuesta = Datos::insertarHistorialModel($datosController,"historial");
						if($respuesta=="success")
						{
							echo '<script>
									swal({title: "Exito!", 
									text: "Stock modificado!!", 
										 type: "success"});
									window.location = "index.php?action=productos";
								</script>';
						}
					}
				}
			}//Si se oprime el boton de salida
			else if(isset($_POST['salida']))
			{
				if(!empty($_POST['cantidad']) && !empty($_POST['referencia']))
				{
					$stockBD = $_POST['stockBd'];
					$cantity = $_POST['cantidad'];
					//Se hace la resta del stock anterior y la cantidad que se quiere sacar
					$newStock = $stockBD - $cantity;
					if($newStock < 0)
					{
						//Si la cantidad sobrepasa el stock entonces no se permite hacer la actualizacion y nos muestra un mensaje que no hay
						//suficiente stock
						echo '<script type="text/javascript">
									swal({title: "Error!", 
									text: "No hay suficiente stock!!", 
										 type: "error"});;
								event.preventDefault();
							  </script>';
					}
					else
					{	
						//Si hay suficiente stock entonces se hace la actualizacion
						$datosController = array('cantidad'=>$newStock,
												 'id'=>$_POST['idProducto']);
						$respuesta = Datos::updateStockModel($datosController,"producto");

						if($respuesta=="success")
						{
							//Se registra la actualizacion en el historial
							$fecha = date("Y-m-d H:i:s");
							$nota = 'El empleado ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . ' elimino ' . $cantity . ' producto(s) del inventario';
							$datosController = array('idProducto'=>$_POST['idProducto'],
												 	'idUser'=>$_SESSION['id'],
												 	'fecha'=>$fecha,
												 	'nota'=>$nota,
												 	'referencia'=>$_POST['referencia'],
												 	'cantidad'=>$cantity,
												 	'id_tienda'=>$_SESSION['id_tienda']);
							$respFuesta = Datos::insertarHistorialModel($datosController,"historial");
							if($respuesta=="success")
							{
								echo '<script>
									swal({title: "Exito!", 
									text: "Stock modificado!!", 
										 type: "success"});
									window.location = "index.php?action=productos";
								</script>';
							}
						}
					}
				}
			}

		}

		//Vista de las categorias para mostrarlo en la tabla
		public function vistaCategoriasController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::vistaCategoriasModel("categoria",$datosController);

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_categoria"].'</td>
					<td>'.$item["nombre_categoria"].'</td>
					<td>'.$item["descripcion_categoria"].'</td>
					<td>'.$item["date_added"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_categoria&id='.$item["id_categoria"].'">Actualizar</a>
                            <a class="dropdown-item" onclick="confirmarDelete('.$item["id_categoria"].');" href="index.php?action=categorias&idBorrar='.$item["id_categoria"].'" id="btn'.$item["id_categoria"].'">Eliminar</a>
                          </div></td>
				</tr>';
			}

		}

		//Se obtienen las categorias para ponerlos en un select2 a la hora de registrar un producto nuevo
		public function obtenerCategoriasController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::vistaCategoriasModel("categoria",$datosController);

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item)
			{
				echo'<option value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';
			}

		}

		//Funcion dle controlador para crear una vista de usuarios y mostrarlos en la tabla
		public function vistaUsuariosController()
		{

			$datosController = array('id_tienda'=>$_SESSION['id_tienda'],
									 'id_user'=>$_SESSION['id']);
			$respuesta = Datos::vistaUsuariosModel("user",$datosController);

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_user"].'</td>
					<td>'.$item["firstname"].'</td>
					<td>'.$item["lastname"].'</td>
					<td>'.$item["user_name"].'</td>
					<td>'.md5($item["user_password_hash"]).'</td>
					<td>'.$item["user_email"].'</td>
					<td>'.$item["date_added"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_usuario&id='.$item["id_user"].'">Actualizar</a>
                            <a class="dropdown-item" onclick="confirmarDelete('.$item["id_user"].');" href="index.php?action=usuarios&idBorrar='.$item["id_user"].'" id="btn'.$item["id_user"].'">Eliminar</a>
                          </div></td>
				</tr>';


			}

		}

		//Funcion dle controlador para crear una vista de usuarios y mostrarlos en la tabla
		public function vistaTiendasController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::vistaTiendasModel("tienda",$datosController);

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){

			if($item['estado_tienda'] == 1)
			{
				$label = 'Activada';
				$label2 = "Desactivar";
			}
			else
			{
				$label = 'Desactivada';
				$label2 = "Activar";
			}
			echo'<tr>
					<td>'.$item["id_tienda"].'</td>
					<td>'.$item["nombre_tienda"].'</td>
					<td>'.$item["direccion_tienda"].'</td>
					<td>'.$label.'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_tienda&id='.$item["id_tienda"].'">Actualizar</a>
                            <a class="dropdown-item" onclick="'.$label2.'('.$item["id_tienda"].');" href="index.php?action=tiendas&idBorrar='.$item["id_tienda"].'&estado='.$item["estado_tienda"].'" id="btn'.$item["id_tienda"].'">'.$label2.'</a>
                            <a class="dropdown-item" href="index.php?action=tiendas&idCambiar='.$item["id_tienda"].'">Ingresar a tienda</a>
                          </div></td>
				</tr>';
			}

		}


		//Funcion para hacer la vista del historial de actualizaciones que se hizo ese dia
		public function vistaHistorialController()
		{

			//Se obtienen dos variables que sera el rango para traer el historial de ese dia
			$hoy = date("Y-m-d");
			//Hoy sera el rango inicial y se tomara el primer segundo del dia como inico
			$today = $hoy . " 00:00:00";
			//Se tomara el ultimo segundo como rango para saber cuando termina el dia
			$later = $hoy . " 23:59:59";
			$datosController = array('hoy' =>$today,
								'later' =>$later,
								'id_tienda'=>$_SESSION['id_tienda']);


			//Se hace la consulta en base a esos dos rangos
			$respuesta = Datos::vistaHistorialModel($datosController,"historial");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["nombre_producto"].'</td>
					<td>'.$item["nota"].'</td>
					<td>'.$item["referencia"].'</td>
					<td>'.$item["cantidad"].'</td>
				</tr>';
			}

		}

		//Funcion para hacer la vista de todos los productos que no tienen stock y apreciarlos en el dashboard
		public function vistaProductosSinStock()
		{

			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::vistaProductosSinStock("producto",$datosController);

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["nombre_producto"].'</td>
					<td>'.$item["stock"].'</td>
				</tr>';
			}

		}

		//Funcion para borrar algun producto en base a su id
		public function borrarProductoController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarProductoModel($datosController,'producto');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=productos';
						</script>";
				}
			}
		}

		//Funcion para borrar una categoria en base a su id
		public function borrarCategoriaController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				//Primero se borran los productos de esa categoria
				$respuesta2 = Datos::borrarProductoPorCategoriaModel($datosController,'producto');
				//SE borra la categoria
				$respuesta = Datos::borrarCategoriaModel($datosController,'categoria');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=categorias';
						</script>";
				}
			}
		}

		//Funcion para desactivar una tienda en base a su id
		public function desactivarTiendaController()
		{
			if(isset($_GET['idBorrar']))
			{
				if($_GET['estado'] == 1)
				{
					$_GET['estado'] = 0;
				}
				else
				{
					$_GET['estado'] = 1;
				}
				$datosController = array('id' =>$_GET['idBorrar'],
										 'estado'=>$_GET['estado']);
				//Se desactiva la tienda
				$respuesta = Datos::desactivarTiendaModel($datosController,'tienda');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=tiendas';
						</script>";
				}
			}
		}


		//Funcion para crear un formulario y poner los datos del producto respecto a su id en caso de que se quiera actualizae
		public function editarProductoController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarProductoModel($datosController, "producto");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Producto</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_producto"].'">
              				<br>

                			<input name="codigoEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["codigo_producto"].'">
                			<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_producto"].'">
                			<br>
                			<input name="precioEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["precio_producto"].'">
                			<br>
                			<input name="unidadesEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["stock"].'">
                			<br>
							<label>Categoria</label>
                        	<select class="form-control select2" style="width: 100%;" name="categoria">';

                        	//Se hace una consulta a las categorias para traerlas en un select a la hora de editar un producto
                        	$datosController2 = $_SESSION['id_tienda'];
         					$respuesta2 = Datos::vistaCategoriasModel("categoria",$datosController2);
							#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

         					//Se hacen las opciones del select 
							foreach($respuesta2 as $row => $item)
							{
								//Si alguno de los distintos id de la categoria es igual al id de la categoria del producto entonces sera la opcion
								//seleccionada
								if($item['id_categoria'] == $respuesta['id_categoria'])
								{
									echo'<option selected value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';
								}
								else
								{
									echo'<option value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';
								}
							}
                        	echo '</select>
                        	<br>
                        	<br>
                			<button type="submit" name="btn_actualizar" id="btn"  class="btn btn-block btn-outline-primary" onclick="confirmarUpdate();" style="float:right;">Guardar cambios</button>
              			</div>
            		</div>';
			}

		}

		//Funcion para traer el formulario de para tener lo sdatos de la categoria en el y poder hacer actualizaciones
		public function editarCategoriaController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarCategoriaModel($datosController, "categoria");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Producto</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_categoria"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_categoria"].'">
                			<br>
                			<textarea name="descripcionEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg">'.$respuesta["descripcion_categoria"].'</textarea>
                			<br>
                			 <button type="submit" name="btn_actualizar" id="btn"  class="btn btn-block btn-outline-primary" onclick="confirmarUpdate();" style="float:right;">Guardar cambios</button>
              			</div>
            		</div>';
			}

		}

		//Funcion del controlador que hace un formulario con los respectivos datos de la tienda elegida
		//en base a su id
		public function editarTiendaController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarTiendaModel($datosController, "tienda");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Producto</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_tienda"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_tienda"].'">
                			<br>
                			<textarea name="direccionEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg">'.$respuesta["direccion_tienda"].'</textarea>
                			<br>
                			<button type="submit" name="btn_actualizar" id="btn"  class="btn btn-block btn-outline-primary" onclick="confirmarUpdate();" style="float:right;">Guardar cambios</button>
              			</div>
            		</div>';
			}

		}

		//Funcion para crear el formulario y traer los datos para poder editar dichos datos de usuario
		public function editarUsuarioController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarUsuarioModel($datosController, "user");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Usuario</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_user"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["firstname"].'">
                			<br>
                			<input name="apellidoEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["lastname"].'">
                			<br>
                			<input name="userEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["user_name"].'">
                			<br>
                			<input name="emailEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["user_email"].'">
                			<br>
                			<button type="submit" name="btn_actualizar" id="btn"  class="btn btn-block btn-outline-primary" onclick="confirmarUpdate();" style="float:right;">Guardar cambios</button>
              			</div>
            		</div>';
			}

		}

		//Funcion para hacer el update en la base de datos en base al formulario
		public function actualizarUsuarioController()
		{
			if(isset($_POST['emailEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "apellido"=>$_POST["apellidoEditar"],
										  "user"=>$_POST["userEditar"],
										  "emailEditar"=>$_POST['emailEditar']);

				$respuesta = Datos::actualizarUsuarioModel($datosController,"user");

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=usuarios';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}


		//Funcion para borrar el usuario
		public function borrarUsuarioController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarUsuarioModel($datosController,'user');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=usuarios';
						</script>";
				}
			}
		}
		//Funcion para borrar una venta
		public function borrarVentaController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarVentaModel($datosController,'venta_producto');
				$respuesta2 = Datos::borrarVentaModel($datosController,'venta');

				if($respuesta2 == "success")
				{
					echo"<script>
							window.location = 'index.php?action=ventas';
						</script>";
				}
			}
		}

		//Funcion para actualizar la BD con el nuevo producto en base a su ID
		public function actualizarProductoController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "precio"=>$_POST["precioEditar"],
										  "unidades"=>$_POST['unidadesEditar']);

				$respuesta = Datos::actualizarProductoModel($datosController,"producto");

				if($respuesta == "success")
				{

					echo"<script>
							window.location = 'index.php?action=productos';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}

		//Funcion para actualizar la BD con la nueva categoria en base a su id
		public function actualizarCategoriaController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "descripcion"=>$_POST["descripcionEditar"]);

				$respuesta = Datos::actualizarCategoriaModel($datosController,"categoria");

				if($respuesta == "success")
				{

					echo"<script>
							window.location = 'index.php?action=categorias';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}

		//Funcion para actualizar la BD con la nueva tienda en base a su id
		public function actualizarTiendaController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "direccion"=>$_POST["direccionEditar"]);

				$respuesta = Datos::actualizarTiendaModel($datosController,"tienda");

				if($respuesta == "success")
				{

					echo"<script>
							window.location = 'index.php?action=tiendas';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}

		

		//Funcion de login
		public function ingresoUsuarioController(){

			if(isset($_POST["email"]) && !empty($_POST['email'])){

				$datosController = array( "email"=>$_POST["email"], 
									      "password"=>$_POST['password']);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "user");
				//Valiación de la respuesta del modelo para ver si es un usuario correcto.

				//Si los datos traidos de la base de datos son iguales a los que el usuario ingreso en las cajas de texto
				if($respuesta["user_email"] == $_POST["email"] && $respuesta["user_password_hash"] == $_POST['password']){

					$datosController2 = $respuesta['id_tienda'];
					$respuesta2 = Datos::loginTiendasModel("tienda",$datosController2);
					if($respuesta2[0]['estado_tienda'] == 1)
					{
						//Entonces la variables de sesion se encienden
						$_SESSION["validar"] = true;
						$_SESSION['id'] = $respuesta['id_user'];
						$_SESSION["password"] = $respuesta["user_password_hash"];
						$_SESSION['nombre'] = $respuesta['firstname'];
						$_SESSION['apellido'] = $respuesta['lastname'];
						$_SESSION['id_tienda'] = $respuesta['id_tienda'];

						echo"<script>
								window.location = 'index.php';
							</script>";
					}
					else
					{
						echo '<script>
									swal({title: "Error", 
										text: "La tienda ha sido desactivada!", 
										 type: "error"});
								</script>';
					}
				}
				else
				{
					echo '<script>
										swal({title: "Error", 
										 		 text: "Usuario o contraseña erróneos!", 
										 		 type: "error"});
									</script>';
				}
			}
		}

		//Funcion que sirve para obtener los datos de la tienda y mostrarlos abajo en el nombre
		//de usuario
		public static function obtenerTiendaController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::obtenerTiendaModel($datosController, "tienda");
			echo $respuesta['nombre_tienda'] . '<br>' . $respuesta['direccion_tienda'];
		}

		//Funcion que sirve para controlar la barra izquierda que es la navegacion, cuando es superadmin se
		//muestran ciertos modulos, cuando es usuario normal otros, etc
		public function controlNav()
		{
			if(isset($_SESSION['id']))
			{
				if($_SESSION['id'] == '13')
				{
					if($_SESSION['id_tienda'] == 1000)
					{

						echo '<li class="nav-item">
	            				<a href="index.php?action=tiendas" class="nav-link">
	              					<i class="nav-icon fa fa-dashboard"></i>
	              					<p>Tiendas</p>
	            				</a>
	          				</li>
	          				<li class="nav-item">
				            	<a onclick="confirmarSesion();" href="index.php?action=salir" class="nav-link">
				              		<i class="nav-icon fa fa-sign-out"></i>
				              		<p>Logout</p>
				            	</a>
				          	</li>';
			        }
			        else
			        {	
			        	echo '<li class="nav-item">
            				<a href="index.php" class="nav-link">
              					<i class="nav-icon fa fa-dashboard"></i>
              					<p>Dashboard</p>
            				</a>
          				</li>
			            <li class="nav-item">
			            	<a href="index.php?action=productos" class="nav-link">
			              		<i class="nav-icon fa fa-tv"></i>
			              		<p>Inventario</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a href="index.php?action=ventas" class="nav-link">
			              		<i class="nav-icon fa fa-dollar"></i>
			              		<p>Ventas</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a href="index.php?action=usuarios" class="nav-link">
			              		<i class="nav-icon fa fa-users"></i>
			              		<p>Usuarios</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a href="index.php?action=categorias" class="nav-link">
			              		<i class="nav-icon fa fa-tags"></i>
			              		<p>Categorias</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a onclick="confirmarTienda();" class="nav-link">
			              		<i class="nav-icon fa fa-sign-out"></i>
			              		<p>Salir de tienda</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a onclick="confirmarSesion();" class="nav-link">
			              		<i class="nav-icon fa fa-sign-out"></i>
			              		<p>Logout</p>
			            	</a>
			          	</li>';
			        }
				}
				else
				{
					echo '<li class="nav-item">
            				<a href="index.php" class="nav-link">
              					<i class="nav-icon fa fa-dashboard"></i>
              					<p>Dashboard</p>
            				</a>
          			</li>
			          <li class="nav-item">
			            <a href="index.php?action=productos" class="nav-link">
			              		<i class="nav-icon fa fa-tv"></i>
			              		<p>Inventario</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a href="index.php?action=ventas" class="nav-link">
			              		<i class="nav-icon fa fa-dollar"></i>
			              		<p>Ventas</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a href="index.php?action=usuarios" class="nav-link">
			              		<i class="nav-icon fa fa-users"></i>
			              		<p>Usuarios</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a href="index.php?action=categorias" class="nav-link">
			              		<i class="nav-icon fa fa-tags"></i>
			              		<p>Categorias</p>
			            	</a>
			          	</li>
			          	<li class="nav-item">
			            	<a class="nav-link" onclick="confirmarSesion();">
			              		<i class="nav-icon fa fa-sign-out"></i>
			              		<p>Logout</p>
			            	</a>
			          	</li>';
				}
			}
		}

		//Funcion del controlador uqe se encarga de que el superadmin entre a la tienda deseada
		public function ingresarTiendaController()
		{
			if(isset($_GET['idCambiar']))
			{
				$_SESSION['id_tienda'] = $_GET['idCambiar'];

				echo"<script>
						window.location = 'index.php';
					</script>";

			}
		}

		//Funcion del controlador para al momento de salir de la tienda esta nos regrese a la interfaz
		//del super admin
		public function salirTiendaController()
		{
			$_SESSION['id_tienda'] = 1000;
			echo"<script>
					window.location = 'index.php?action=tiendas';
				</script>";
		}

		//Funcion que se encarga de buscar cuales productos no tienen stock y mostrarlo como
		//notificacion
		public function showNotificationsController()
		{
			$datosController = $_SESSION['id_tienda'];
			$respuesta = Datos::vistaProductosSinStock("producto",$datosController);

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			echo ' <li class="nav-item dropdown">
        			<a class="nav-link" data-toggle="dropdown" href="#">
          			<i class="fa fa-bell-o"></i>
          			<span class="badge badge-warning navbar-badge">';
          			if(count($respuesta)>0){echo count($respuesta);} echo'</span>
        			</a>
        		<div class="dropdown-menu dropdown-menu-dark dropdown-menu-right">
          	<span class="dropdown-item dropdown-header">'.count($respuesta).' producto(s) sin stock</span>';
			foreach($respuesta as $row => $item){
          	echo'<div class="dropdown-divider"></div>
          	<a href="index.php?action=productos" class="dropdown-item">
            	<i class="fa fa-tv mr-2" style="color:black;"></i> <i style="color:black;">El producto '.$item['nombre_producto'].' no tiene stock!</i>
            	<span class="float-right text-muted text-sm"></span>
          	</a>';
			}
			echo '</li>';
			
		}

		


	}



?>
