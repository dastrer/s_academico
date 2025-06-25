var tabla;

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function limpiar() {
    $("#idgrado").val("");
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
            url: '../ajax/grado.php?op=listar',
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
        url: "../ajax/grado.php?op=guardaryeditar",
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
            bootbox.alert("Hubo un error al guardar/editar el grado. Revisa la consola.");
            $("#btnGuardar").prop("disabled", false);
        }
    });
    limpiar();
}

function mostrar(idgrado) {
    $.post("../ajax/grado.php?op=mostrar", { idgrado: idgrado }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#idgrado").val(data.idgrado);
        $("#nombre").val(data.nombre);
    });
}

function desactivar(idgrado) {
    bootbox.confirm("¿Está seguro de desactivar el grado?", function(result) {
        if (result) {
            $.post("../ajax/grado.php?op=desactivar", { idgrado: idgrado }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(idgrado) {
    bootbox.confirm("¿Está seguro de activar el grado?", function(result) {
        if (result) {
            $.post("../ajax/grado.php?op=activar", { idgrado: idgrado }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
