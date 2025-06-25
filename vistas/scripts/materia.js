var tabla;

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function limpiar() {
    $("#idmateria").val("");
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
            url: '../ajax/materia.php?op=listar',
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
        url: "../ajax/materia.php?op=guardaryeditar",
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
            bootbox.alert("Hubo un error al guardar/editar la materia. Revisa la consola.");
            $("#btnGuardar").prop("disabled", false); // Habilita el botón en caso de error
        }
    });
    limpiar(); // Limpia el formulario después de enviar (incluso si hubo error)
}

function mostrar(idmateria) {
    $.post("../ajax/materia.php?op=mostrar", { idmateria: idmateria }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true); // Muestra el formulario para editar
        $("#idmateria").val(data.idmateria);
        $("#nombre").val(data.nombre);
    });
}

function desactivar(idmateria) {
    bootbox.confirm("¿Está seguro de desactivar la materia?", function(result) {
        if (result) { // Si el usuario confirma
            $.post("../ajax/materia.php?op=desactivar", { idmateria: idmateria }, function(e) {
                bootbox.alert(e); // Muestra la respuesta del servidor
                tabla.ajax.reload(); // Recarga la tabla
            });
        }
    });
}

function activar(idmateria) {
    bootbox.confirm("¿Está seguro de activar la materia?", function(result) {
        if (result) { // Si el usuario confirma
            $.post("../ajax/materia.php?op=activar", { idmateria: idmateria }, function(e) {
                bootbox.alert(e); // Muestra la respuesta del servidor
                tabla.ajax.reload(); // Recarga la tabla
            });
        }
    });
}

init(); // Inicializa el script cuando el DOM está listo