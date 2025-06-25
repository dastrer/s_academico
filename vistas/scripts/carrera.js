var tabla;

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function limpiar() {
    $("#idcarrera").val("");
    $("#nombre").val("");
}

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}

function listar() {
    tabla = $('#tbllistado').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        "ajax": {
            url: '../ajax/carrera.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]]
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/carrera.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en AJAX:", textStatus, errorThrown, jqXHR.responseText);
            bootbox.alert("Hubo un error al guardar/editar la carrera. Revisa la consola.");
            $("#btnGuardar").prop("disabled", false);
        }
    });
    limpiar();
}

function mostrar(idcarrera) {
    $.post("../ajax/carrera.php?op=mostrar", { idcarrera: idcarrera }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#idcarrera").val(data.idcarrera);
        $("#nombre").val(data.nombre);
    });
}

function desactivar(idcarrera) {
    bootbox.confirm("¿Está seguro de desactivar la carrera?", function(result) {
        if (result) {
            $.post("../ajax/carrera.php?op=desactivar", { idcarrera: idcarrera }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(idcarrera) {
    bootbox.confirm("¿Está seguro de activar la carrera?", function(result) {
        if (result) {
            $.post("../ajax/carrera.php?op=activar", { idcarrera: idcarrera }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
