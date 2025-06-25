<?php
require 'header.php';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Docente <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Dirección</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Nivel Academico</th>
                                <th>Estado</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Dirección</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Nivel Academico</th>
                                <th>Estado</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombre:</label>
                                <input type="hidden" name="iddocente" id="iddocente">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre">
                                <small id="error-nombre" class="text-danger"></small>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Apellido:</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" maxlength="50" placeholder="Apellido">
                                <small id="error-apellido" class="text-danger"></small>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Cédula:</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" maxlength="50" placeholder="Cédula">
                                <small id="error-cedula" class="text-danger"></small>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Celular:</label>
                                <input type="text" class="form-control" name="celular" id="celular" maxlength="15" placeholder="Celular">
                                <small id="error-celular" class="text-danger"></small>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Dirección:</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" placeholder="Dirección">
                                <small id="error-direccion" class="text-danger"></small>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Correo:</label>
                                <input type="text" class="form-control" name="correo" id="correo" maxlength="100" placeholder="Correo">
                                <small id="error-correo" class="text-danger"></small>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nivel Academico:</label>
                                <input type="text" class="form-control" name="nivel_est" id="nivel_est" maxlength="15" placeholder="Nivel Académico">
                                <small id="error-nivel_est" class="text-danger"></small>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="scripts/docente.js"></script>