<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
} else {
require 'header.php';

//if ($_SESSION['ventas']==1)
//{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Cartilla Vacunacion</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <!-- centro -->
                    <div class="panel-body" id="listarCartillaVacunacion">
                      <form name="formularioSeleccionarPropietario" id="formularioSeleccionarPropietario" method="POST">
                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">                                                  
                          <select id="idPropietario" name="idPropietario" class="form-control selectpicker" data-live-search="true" required>
                            
                          </select>                          
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">                          
                          <button class="btn btn-primary" type="submit" id="btnSeleccionarPropietario"><i class="fa fa-save"></i> Seleccionar Propietario</button>
                        </div>
                      </form>

                      <form name="formularioSeleccionarPaciente" id="formularioSeleccionarPaciente" method="POST">
                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">                                                  
                          <select id="idPaciente" name="idPaciente" class="form-control selectpicker" data-live-search="true" required>
                            
                          </select>                          
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">                          
                          <button class="btn btn-primary" type="submit" id="btnSeleccionarPaciente"><i class="fa fa-save"></i> Seleccionar Paciente</button>
                        </div>
                      </form>

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                          
                        <button class="btn btn-primary" type="submit" id="btnAgregarVacuna" onclick="mostrarform(4)"><i class="fa fa-save"></i> Agregar Vacunas</button>
                      </div>

                      <div class="panel-body table-responsive" id="listadoCartillaVacunacion">
                        <table id="tblListadoCartillaVacunacion" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>                          
                            <th>Vacuna</th>
                            <th>Indicaciones</th>
                            <th>Fecha Vacuna</th>
                            <th>Fecha Proxima Vacuna</th>                          
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>                         
                            <th>Vacuna</th>
                            <th>Indicaciones</th>
                            <th>Fecha Vacuna</th>
                            <th>Fecha Proxima Vacuna</th>                          
                          </tfoot>
                        </table>
                      </div>
                    </div>
                   


                    <div class="panel-body" id="insertarCartillaVacunacion">
                      <form name="formularioInsertarCartillaVacunacion" id="formularioInsertarCartillaVacunacion" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Selecciona una vacuna(*):</label>                            
                          <select id="idVacuna" name="idVacuna" class="form-control selectpicker" data-live-search="true" required>
                            
                          </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Fecha Proxima Vacuna(*):</label>
                          <input type="date" class="form-control" name="fechaProximaVacuna" id="fechaProximaVacuna" required>
                        </div>
                      
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">                            
                          <button class="btn btn-primary" type="button" onclick="agregarVacunaTabla()"><i class="fa fa-save" ></i> Añadir Vacuna</button>                                            
                        </div>
                                              
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                          <table id="tablaDetallesVacuna" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                              <th>Opciones</th>
                              <th>Vacuna</th>                              
                              <th>Fecha Vacuna</th>
                              <th>Fecha Proxima Vacuna</th>                                  
                            </thead>                          
                            <tbody>
                              
                            </tbody>
                            <tfoot>                                
                                                          
                            </tfoot>
                          </table>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          <button id="btnCancelar" class="btn btn-danger" onclick="mostrarform(5)" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>                      
                      </form>                      
                    </div>
                                        
                    <!--Fin centro -->

                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->


<?php
//} else {
  //require 'noacceso.php';
//}

require 'footer.php';
?>
<script type="text/javascript" src="../scripts/cartillaVacunacion.js"></script>
<?php 
}
ob_end_flush();
?>