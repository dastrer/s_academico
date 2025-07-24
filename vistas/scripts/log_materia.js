var tablaLogs;

function init() {
    listarLogs();
}

function listarLogs() {
    tablaLogs = $('#tbllogs').DataTable({
        "ajax": {
            url: '../ajax/log_materia.php?op=listar',
            type: 'GET',
            dataType: 'json',
            error: function(e) {
                console.error("Error al cargar los logs:", e.responseText);
            }
        },
        "bDestroy": true,
        "processing": true,
        "serverSide": false,
        "columns": [
            { "data": "0" }, // ID Log
            { "data": "1" }, // Acción
            { "data": "2" }  // Fecha
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });
}

init();

