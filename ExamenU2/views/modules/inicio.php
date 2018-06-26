<?php
  $mvc = new MvcController();
?>
    <!-- Content Header (Page header) -->
    <section style="background-color: #f06292" class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="color:white;"><b><b>Danz</b></b>life</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Inicio</li>
              <li class="breadcrumb-item"><a href="index.php?action=lugares">Lugares</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

		<section class="content">
      <div class="row">
        <div class="col-12">
					<div class="card">
            <div class="card-header">
              <h3 class="card-title">Registrar Lugar</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" style="font-family: Arial; width: 50%; margin-left: 425px" enctype="multipart/form-data">
      
                <div class="card card-success">
                  <div class="card-header" style="background-color: #f06292">
                      <h3 class="card-title">Nuevo Lugar</h3>
                  </div>
                  <div class="card-body">
                      <select class="form-control select2" style="width: 100%;" name="grupo" id="grupo">
                      <?php
                            //OBtener los grupos de la BD para registrarla en la tabla pagos al momento de reistrar una alumna nueva
                            $mvc->obtenerGruposController(); 
                      ?>
                      </select>
                      <br>
                      <br>
                      <select class="form-control select2" style="width: 100%;" name="alumnas" id="alumnas">
                      <?php
                              //OBtener los alumnas de la BD para registrarla en la tabla pagos al momento de reistrar una alumna nueva
                            $mvc->obtenerAlumnasController(); 
                      ?>
                      </select>
                      <br>
                      <br>
                      <input type="text" name="mama" class="form-control form-control-lg" style="height:32px;" placeholder="Nombre de mamá">
                      <br>
                      <input type="date" name="fecha_pago" class="form-control form-control-lg" style="height:40px;" placeholder="Fecha de pago">
                      <br>
                      <input type="text" name="folio" class="form-control form-control-lg" style="height:32px;" placeholder="Folio">
                      <br>
                      <div class="custom-file">
                        <input name="fileToUpload" id="fileToUpload" type="file" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <br>
                      <br>
                      <input type="submit" value="Registrar" class="btn btn-block btn-outline-secondary" name="registrar">
                    </div>
                </div>

              </form>
          </div>

 					</div>
 				</div>
 			</div>
 		</section>
<?php
  
  $mvc->registrarPagoController();
  
?>

<footer >
    <strong>Copyright &copy; 2014-2018. Fher Torres.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Danzlife</b>
    </div>
 </footer>