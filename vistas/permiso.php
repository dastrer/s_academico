<?php
require 'header.php';
?>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Permisos 
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                <i class="fa fa-plus-circle"></i> Agregar
              </button>
            </h1>
          </div>

          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                
                <th>Nombre del Permiso</th>
              </thead>
              <tbody></tbody>
              <tfoot>
          
                <th>Nombre del Permiso</th>
              </tfoot>
            </table>
          </div>

          <div class="panel-body" style="height: 200px;" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="form-group col-lg-6">
                <label>Nombre del Permiso:</label>
                <input type="hidden" name="idpermiso" id="idpermiso">
                <input type="text" class="form-control" name="nombre_permiso" id="nombre_permiso" maxlength="70" placeholder="Nombre del permiso" required>
              </div>

              <div class="form-group col-lg-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar">
                  <i class="fa fa-save"></i> Guardar
                </button>
                <button class="btn btn-danger" onclick="cancelarform()" type="button">
                  <i class="fa fa-arrow-circle-left"></i> Cancelar
                </button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<?php
require 'footer.php';
?>

<script type="text/javascript" src="scripts/permiso.js"></script>
