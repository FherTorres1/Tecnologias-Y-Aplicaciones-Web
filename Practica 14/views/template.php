<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Inventarios</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="views/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="views/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="views/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="views/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="views/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="views/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="views/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="views/css/buttons.dataTables.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <script src="views/dist/js/plugins/sweetalert/sweetalert.js"></script>
  
  <script src="views/js/jquery-3.3.1.js"></script>

  
    <!--script src="view/dist/js/plugins/sweetalert/sweetalert.min.js"></script-->
  <link rel="stylesheet" href="views/dist/js/plugins/sweetalert/sweetalert.css">
</head>

	<?php
    //Se inicia la sesion
		session_start();
    //Si la variable de sesion validar esta encendida entonces se incluye la cabecera, pie de pagina y navegacion, esto nos sirve para solo mostrar el logion a la hora de no haber iniciado sesion
    if(isset($_SESSION["validar"]))
    { 
      require_once('modules/header.php');
		  require_once("modules/navegacion.php");
    }
		require_once("controllers/controller.php");
		$mvc = new MvcController();
		$mvc->enlazarPagina();
    if(isset($_SESSION["validar"]))
    {  
      require_once('modules/footer.php');
    }

	?>




<!-- jQuery -->
<script src="views/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="views/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="views/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="views/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="views/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="views/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="views/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="views/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="views/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="views/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="views/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="views/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="views/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="views/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="views/plugins/datatables/jquery.dataTables.js"></script>
<script src="views/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="views/plugins/datatables/dataTables.min.js"></script>
<script src="views/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="views/plugins/datatables/buttons.flash.min.js"></script>
<script src="views/plugins/datatables/jszip.min.js"></script>
<script src="views/plugins/datatables/pdfmake.min.js"></script>
<script src="views/plugins/datatables/vfs_fonts.js"></script>
<script src="views/plugins/datatables/buttons.html5.min.js"></script>
<script src="views/plugins/datatables/buttons.print.min.js"></script>
<script src="views/plugins/select2/select2.full.min.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.js"></script>


<script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="views/plugins/iCheck/icheck.min.js"></script>





</body>
</html>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    
    //Inicializa los datatable
    $("#example1").DataTable();
    
    $('#example2').DataTable();
  })

  //Funcion para ordenar el datatable en base al ultimo registro creado (Historial Y Ventas)
  $(document).ready(function() {
    $('#historialT').DataTable( {
        "order": [[0,"desc"]],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} ); 

  //Funcion Jquery para hacer una tabla clickeable
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});


</script>

<script type="text/javascript">

  var count=0;
  var tot=0;
  //Funcion de JS para confirmar si queremos borrar algun dato, este nos pide la contrasena para validarla
  function confirmar()
  {
    var x = prompt("Ingresa tu contrasena para la accion");

    var currentPassword ="<?php echo $_SESSION['password'];?>";

    if(x!="")
    {
      if(x!=currentPassword)
      {
        event.preventDefault();
        window.alert("Contrasena equivocada");
      }
      
    }



  }

  //Funcion JSCRIPT para cambiar las etiquetas al cambiar un producto en una venta, esto nos sirve
  //para ver el precio del producto, su stock, etc
  function changeLabels()
  {
    var e = document.getElementById("producto");
    var label1 = document.getElementById("label1");
    var label2 = document.getElementById("label2");
    var codigo = e.options[e.selectedIndex].value;

    var stock = document.getElementById("stock"+codigo).value;
    var precio = document.getElementById("precio"+codigo).value;

    label1.innerHTML="Stock disponible: "+stock;
    label2.innerHTML="Precio de venta $"+precio;
  }
  //Funcion de JSCRIPT para agregar los productos a la tabla
  function addProducts()
  {
    var e = document.getElementById("producto");
    var label1 = document.getElementById("label1");
    var label2 = document.getElementById("label2");
    var codigo = e.options[e.selectedIndex].value;
    var str = e.options[e.selectedIndex].text;
    var stock = document.getElementById("stock"+codigo).value;
    var precio = document.getElementById("precio"+codigo).value;
    var totalL = document.getElementById("total");

    var combined = str.split(' - ');
    var id = document.getElementById("id"+codigo).value;
    var cant = document.getElementById("cant"+codigo)
    var total = 0.0;
    var a = 0;
    flag = 0;
    var fila = '';
    if(cant)
    {
      var z = cant.value;
      a = parseInt(z, 10);
      a = a + 1;
      if(a<=parseInt(stock))
      {
        total = parseFloat(precio) * a;
        document.getElementById("cant"+codigo).value=a;
        document.getElementById("total"+codigo).value=total;
        tot = tot+ parseFloat(precio);
        totalL.innerHTML = "TOTAL: $" +  tot;
      }
      else
      {
                  swal({title: "Error", 
                    text: "No hay suficiente stock!", 
                     type: "error"});
      }
    }
    else
    {
      total = parseFloat(precio);
      a = 1;
      if(a<=parseInt(stock))
      {
        fila = '<tr><td style="background-color:white;"><input name="idC'+count+'" type="text" readonly value="'+id+'" style="width:50px; border:none;"></td><td style="background-color:white;"><input name="codigoC'+count+'" type="text" readonly value="'+codigo+'" style="width:100px; border:none"></td><td style="background-color:white;"><input name="nombreC'+count+'" type="text" readonly value="'+combined[1]+'" style="width:100px; border:none"></td><td style="background-color:white;"><input name="precioC'+count+'" type="text" readonly value="'+precio+'" style="width:100px; border:none"></td> <td style="background-color:white;"><input id="cant'+codigo+'" name="cantC'+count+'" type="text" readonly value="'+a+'" style="width:100px; border:none"></td><td style="background-color:white;"><input id="total'+codigo+'"name="totalC'+count+'" type="text" readonly value="'+total+'" style="width:100px; border:none"></td></tr>';

          document.getElementById("table1").getElementsByTagName("tbody")[0].insertRow(-1).innerHTML=fila;
          count++;
          document.getElementById("count").value=count;
          tot = tot+ parseFloat(precio);
          totalL.innerHTML = "TOTAL: $" +  tot;
      }
      else
      {
        swal({title: "Error", 
                    text: "No hay suficiente stock!", 
                     type: "error"});
      }  
    }
    document.getElementById("inTotal").value=tot;
  }

  //funcion de confirmacion de cierre de sesion, muestra un sweet alert
        function confirmarSesion()
        {
          event.preventDefault();
          swal({
          title: "Cerrar sesión",
          text: "¿Seguro que deseas cerrar la sesión?",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          confirmButtonClass: "btn-info",
          confirmButtonText: "Si, estoy seguro",
          closeOnConfirm: false
          },
          function(){
            window.location = 'index.php?action=salir';
          });
        }

        function confirmarTienda()
        {
          event.preventDefault();
          swal({
          title: "Salir de tienda",
          text: "¿Seguro que deseas salir de la tienda?",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          confirmButtonClass: "btn-info",
          confirmButtonText: "Si, estoy seguro",
          closeOnConfirm: false
          },
          function(){
            window.location = 'index.php?action=salir_tienda';
          });
        }

         //funcion encargada de mostrar un alert cuando el usuario da clic en el boton actualizar y pida la contraseña
        function confirmarUpdate(){
          var dbPassword = "<?php echo $_SESSION['password'] ?>";
          event.preventDefault();
          swal({
            title: "Confirmar acción",
            text: "<p>Ingresa tu contraseña para guardar los cambios</p><br><input type='password' class='form-control' id='pass' placeholder='Contraseña' autofocus><label id='err_sa' style='color:red'></label><br>",
            html: true,
            
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar",
            closeOnConfirm: false,
            inputPlaceholder: "Contraseña",
            inputValidator: (value) => {
              return !value && 'No puedes dejar el campo vacio!'
            }
          }, function () {
            var inputValue = document.getElementById("pass").value;
            if (inputValue === false) return false;
            if (inputValue != dbPassword) {
              document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
              return false
            }
             $( "#btn" ).click();
            swal("Exito!", "Registro modificado", "success");
          });
        }

        //Funcion de JSCRIPT para confirmar si queremos borrar un registro y nos pida la contrasena
        //para hacerlo
          function confirmarDelete(id){
          var dbPassword = "<?php echo $_SESSION['password'] ?>";
          event.preventDefault();
          swal({
            title: "Confirmar acción",
            text: "<p>Ingresa tu contraseña para borrar el registro</p><br><input type='password' class='form-control' id='pass' placeholder='Contraseña' autofocus><label id='err_sa' style='color:red'></label><br>",
            html: true,
            
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar",
            closeOnConfirm: false,
            inputPlaceholder: "Contraseña",
            inputValidator: (value) => {
              return !value && 'No puedes dejar el campo vacio!'
            }
          }, function () {
            var inputValue = document.getElementById("pass").value;
            if (inputValue === false) return false;
            if (inputValue != dbPassword) {
              document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
              return false
            }
            var url = document.getElementById("btn"+id).href;
            window.location = url;
            swal("Exito!", "Registro eliminado", "error");
          });

        }
        //Funcion de JSCRIPT para pedir la contrasena en caso de que se quiera desactivar o activar
        //una tienda
          function Desactivar(id){
          var dbPassword = "<?php echo $_SESSION['password'] ?>";
          event.preventDefault();
          swal({
            title: "Confirmar acción",
            text: "<p>Ingresa tu contraseña para DESACTIVAR la tienda.</p><br><input type='password' class='form-control' id='pass' placeholder='Contraseña' autofocus><label id='err_sa' style='color:red'></label><br>",
            html: true,
            
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar",
            closeOnConfirm: false,
            inputPlaceholder: "Contraseña",
            inputValidator: (value) => {
              return !value && 'No puedes dejar el campo vacio!'
            }
          }, function () {
            var inputValue = document.getElementById("pass").value;
            if (inputValue === false) return false;
            if (inputValue != dbPassword) {
              document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
              return false
            }
            var url = document.getElementById("btn"+id).href;
            window.location = url;
            swal("Exito!", "Tienda desactivada", "error");
          });
        }

          function Activar(id){
          var dbPassword = "<?php echo $_SESSION['password'] ?>";
          event.preventDefault();
          swal({
            title: "Confirmar acción",
            text: "<p>Ingresa tu contraseña para ACTIVAR la tienda.</p><br><input type='password' class='form-control' id='pass' placeholder='Contraseña' autofocus><label id='err_sa' style='color:red'></label><br>",
            html: true,
            
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar",
            closeOnConfirm: false,
            inputPlaceholder: "Contraseña",
            inputValidator: (value) => {
              return !value && 'No puedes dejar el campo vacio!'
            }
          }, function () {
            var inputValue = document.getElementById("pass").value;
            if (inputValue === false) return false;
            if (inputValue != dbPassword) {
              document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
              return false
            }
            var url = document.getElementById("btn"+id).href;
            window.location = url;
            swal("Exito!", "Tienda activada", "success");
          });
      
      }


</script>


