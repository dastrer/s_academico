var tabla;

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function limpiar() {
    $("#idturno").val("");
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
        "aProcessing": true, // Activamos el procesamiento de DataTables
        "aServerSide": true, // Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', // Definimos los elementos del control de tabla
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        "ajax": {
            url: '../ajax/turno.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText); // Esto es CLAVE para depurar errores de PHP
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, // Paginación
        "order": [[0, "desc"]] // Ordenar los registros de forma descendente
    });
}

function guardaryeditar(e) {
    e.preventDefault(); // No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true); // Deshabilita el botón mientras se procesa
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/turno.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            bootbox.alert(datos); // Muestra la respuesta del servidor (éxito/error)
            mostrarform(false); // Oculta el formulario y muestra el listado
            tabla.ajax.reload(); // Recarga los datos de la tabla
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en AJAX:", textStatus, errorThrown, jqXHR.responseText);
            bootbox.alert("Hubo un error al guardar/editar el turno. Revisa la consola.");
            $("#btnGuardar").prop("disabled", false); // Habilita el botón en caso de error
        }
    });
    limpiar(); // Limpia el formulario después de enviar (incluso si hubo error)
}

function mostrar(idturno) {
    $.post("../ajax/turno.php?op=mostrar", { idturno: idturno }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true); // Muestra el formulario para editar
        $("#idturno").val(data.idturno);
        $("#nombre").val(data.nombre);
    });
}

function desactivar(idturno) {
    bootbox.confirm("¿Está seguro de desactivar el turno?", function(result) {
        if (result) { // Si el usuario confirma
            $.post("../ajax/turno.php?op=desactivar", { idturno: idturno }, function(e) {
                bootbox.alert(e); // Muestra la respuesta del servidor
                tabla.ajax.reload(); // Recarga la tabla
            });
        }
    });
}

function activar(idturno) {
    bootbox.confirm("¿Está seguro de activar el turno?", function(result) {
        if (result) { // Si el usuario confirma
            $.post("../ajax/turno.php?op=activar", { idturno: idturno }, function(e) {
                bootbox.alert(e); // Muestra la respuesta del servidor
                tabla.ajax.reload(); // Recarga la tabla
            });
        }
    });
}

init(); // Inicializa el script cuando el DOM está listo
