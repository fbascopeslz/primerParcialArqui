<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

//if ($_SESSION['almacen']==1)
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
                          <h1 class="box-title">Consulta <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Motivo</th>
                            <th>Diagnostico</th>
                            <th>Personal</th>
                            <th>Paciente</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Motivo</th>
                            <th>Diagnostico</th>
                            <th>Personal</th>
                            <th>Paciente</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Estado:</label>
                          <input type="hidden" name="idConsulta" id="idConsulta">
                          <input type="text" class="form-control" name="estado" id="estado" maxlength="30" placeholder="Estado" required>
                        </div>
                        
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Motivo:</label>
                          <input type="text" class="form-control" name="motivo" id="motivo" maxlength="80" placeholder="Motivo" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Diagnostico:</label>
                          <input type="text" class="form-control" name="diagnostico" id="diagnostico" maxlength="255" placeholder="Diagnostico" required>
                        </div>
                        
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Personal:</label>
                          <select id="idPersonal" name="idPersonal" class="form-control selectpicker" data-live-search="true" required>
                            
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Paciente:</label>
                          <select id="idPaciente" name="idPaciente" class="form-control selectpicker" data-live-search="true" required>
                            
                          </select>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>Guardar</button>
                          <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>Cancelar</button>
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
//}
//else
//{
  //require 'noacceso.php';
//}

require 'footer.php';
?>
<script type="text/javascript" src="../scripts/consulta.js"></script>
<?php 
}
ob_end_flush();
?>

