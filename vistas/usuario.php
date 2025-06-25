<?php require 'header.php'; ?>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Usuario 
              <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                <i class="fa fa-plus-circle"></i> Agregar
              </button>
            </h1>
          </div>

          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Imagen</th>
                <th>Estado</th>
              </thead>
              <tbody></tbody>
              <tfoot>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Imagen</th>
                <th>Estado</th>
              </tfoot>
            </table>
          </div>

          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="idusuario" id="idusuario">
              <div class="form-group col-lg-6">
                <label>Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
              </div>
              <div class="form-group col-lg-6">
                <label>Celular:</label>
                <input type="text" class="form-control" name="celular" id="celular">
              </div>
              <div class="form-group col-lg-6">
                <label>Dirección:</label>
                <input type="text" class="form-control" name="direccion" id="direccion">
              </div>
              <div class="form-group col-lg-6">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" id="email">
              </div>
              <div class="form-group col-lg-6">
                <label>Cargo:</label>
                <input type="text" class="form-control" name="cargo" id="cargo">
              </div>
              <div class="form-group col-lg-6">
                <label>Clave:</label>
                <input type="password" class="form-control" name="clave" id="clave">
              </div>
              <div class="form-group col-lg-6">
                <label>Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen">
                <input type="hidden" name="imagenactual" id="imagenactual">
                <img src="" width="150px" height="120px" id="imagenmuestra">
              </div>
              <div class="form-group col-lg-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar">
                  <i class="fa fa-save"></i> Guardar
                </button>
                <button class="btn btn-danger" type="button" onclick="cancelarform()">
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

<?php require 'footer.php'; ?>
<script type="text/javascript" src="scripts/usuario.js"></script>
