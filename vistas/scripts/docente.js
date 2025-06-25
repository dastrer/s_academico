var tabla;

function init() {
    mostrarform(false);
    listar();
    agregarValidacionesEnTiempoReal();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function limpiar() {
    $("#iddocente").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#cedula").val("");
    $("#direccion").val("");
    $("#celular").val("");
    $("#correo").val("");
    $("#nivel_est").val("");

    $(".text-danger").text("");
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
            url: '../ajax/docente.php?op=listar',
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

function agregarValidacionesEnTiempoReal() {
    $("#nombre").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
        $("#error-nombre").text(val === "" ? "El nombre es obligatorio." :
            !regex.test(val) ? "Solo se permiten letras." : "");
    });

    $("#apellido").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
        $("#error-apellido").text(val === "" ? "El apellido es obligatorio." :
            !regex.test(val) ? "Solo se permiten letras." : "");
    });

    $("#cedula").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[0-9]+$/;
        $("#error-cedula").text(val === "" ? "La cédula es obligatoria." :
            !regex.test(val) ? "Solo se permiten números." : "");
    });

    $("#celular").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[0-9]{8}$/;
        $("#error-celular").text(val === "" ? "El celular es obligatorio." :
            !regex.test(val) ? "Debe tener 8 dígitos numéricos." : "");
    });

    $("#correo").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        $("#error-correo").text(val === "" ? "El correo es obligatorio." :
            !regex.test(val) ? "Correo no válido." : "");
    });

    $("#nivel_est").on("input", function () {
        const val = $(this).val().trim();
        $("#error-nivel_est").text(val === "" ? "El nivel académico es obligatorio." : "");
    });

    $("#direccion").on("input", function () {
        const val = $(this).val().trim();
        $("#error-direccion").text(val === "" ? "La dirección no puede estar vacía." : "");
    });
}

function validarFormulario() {
    var nombre = $("#nombre").val().trim();
    var apellido = $("#apellido").val().trim();
    var cedula = $("#cedula").val().trim();
    var direccion = $("#direccion").val().trim();
    var celular = $("#celular").val().trim();
    var correo = $("#correo").val().trim();
    var nivel_est = $("#nivel_est").val().trim();

    var soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
    var soloNumeros = /^[0-9]+$/;
    var soloCelular = /^[0-9]{8}$/;
    var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (nombre === "" || !soloLetras.test(nombre)) {
        alert("Nombre inválido.");
        $("#nombre").focus();
        return false;
    }

    if (apellido === "" || !soloLetras.test(apellido)) {
        alert("Apellido inválido.");
        $("#apellido").focus();
        return false;
    }

    if (cedula === "" || !soloNumeros.test(cedula)) {
        alert("Cédula inválida.");
        $("#cedula").focus();
        return false;
    }

    if (celular === "" || !soloCelular.test(celular)) {
        alert("Celular inválido.");
        $("#celular").focus();
        return false;
    }

    if (direccion === "") {
        alert("Dirección vacía.");
        $("#direccion").focus();
        return false;
    }

    if (correo === "" || !correoRegex.test(correo)) {
        alert("Correo inválido.");
        $("#correo").focus();
        return false;
    }

    if (nivel_est === "") {
        alert("Nivel académico requerido.");
        $("#nivel_est").focus();
        return false;
    }

    return true;
}

function guardaryeditar(e) {
    e.preventDefault();

    if (!validarFormulario()) return;

    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/docente.php?op=guardaryeditar",
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
            bootbox.alert("Hubo un error al guardar/editar el docente.");
            $("#btnGuardar").prop("disabled", false);
        }
    });

    limpiar();
}

function mostrar(iddocente) {
    $.post("../ajax/docente.php?op=mostrar", { idestudiante: iddocente }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#iddocente").val(data.idestudiante);
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#cedula").val(data.cedula);
        $("#direccion").val(data.direccion);
        $("#celular").val(data.celular);
        $("#correo").val(data.correo);
        $("#nivel_est").val(data.fecha_nac);
    });
}

function desactivar(iddocente) {
    bootbox.confirm("¿Está seguro de desactivar el estudiante?", function(result) {
        if (result) {
            $.post("../ajax/docente.php?op=desactivar", { idestudiante: iddocente }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(iddocente) {
    bootbox.confirm("¿Está seguro de activar el estudiante?", function(result) {
        if (result) {
            $.post("../ajax/docente.php?op=activar", { idestudiante: iddocente }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();