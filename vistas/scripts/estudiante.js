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
    $("#idestudiante").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#edad").val("");
    $("#cedula").val("");
    $("#direccion").val("");
    $("#celular").val("");
    $("#correo").val("");
    $("#fecha_nac").val("");
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
            url: '../ajax/estudiante.php?op=listar',
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
            !regex.test(val) ? "Solo letras y espacios." : "");
    });

    $("#apellido").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
        $("#error-apellido").text(val === "" ? "El apellido es obligatorio." :
            !regex.test(val) ? "Solo letras y espacios." : "");
    });

    $("#edad").on("input", function () {
        const val = $(this).val().trim();
        const num = parseInt(val);
        $("#error-edad").text(val === "" ? "La edad es obligatoria." :
            (!/^\d+$/.test(val) || num < 1 || num > 99) ? "Edad debe ser un número entre 1 y 99." : "");
    });

    $("#cedula").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[0-9]+$/;
        $("#error-cedula").text(val === "" ? "La cédula es obligatoria." :
            !regex.test(val) ? "Solo números." : "");
    });

    $("#celular").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[0-9]{8}$/;
        $("#error-celular").text(val === "" ? "El celular es obligatorio." :
            !regex.test(val) ? "Debe tener 8 dígitos numéricos." : "");
    });

    $("#direccion").on("input", function () {
        const val = $(this).val().trim();
        $("#error-direccion").text(val === "" ? "La dirección es obligatoria." : "");
    });

    $("#correo").on("input", function () {
        const val = $(this).val().trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        $("#error-correo").text(val === "" ? "El correo es obligatorio." :
            !regex.test(val) ? "Formato de correo inválido." : "");
    });

    $("#fecha_nac").on("input", function () {
        const val = $(this).val().trim();
        $("#error-fecha_nac").text(val === "" ? "La fecha es obligatoria." : "");
    });
}

function validarFormulario() {
    var nombre = $("#nombre").val().trim();
    var apellido = $("#apellido").val().trim();
    var edad = $("#edad").val().trim();
    var cedula = $("#cedula").val().trim();
    var direccion = $("#direccion").val().trim();
    var celular = $("#celular").val().trim();
    var correo = $("#correo").val().trim();
    var fecha_nac = $("#fecha_nac").val().trim();

    if (nombre === "" || !/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre)) {
        alert("Nombre inválido."); $("#nombre").focus(); return false;
    }

    if (apellido === "" || !/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(apellido)) {
        alert("Apellido inválido."); $("#apellido").focus(); return false;
    }

    if (edad === "" || !/^\d+$/.test(edad) || parseInt(edad) < 1 || parseInt(edad) > 99) {
        alert("Edad inválida (1-99)."); $("#edad").focus(); return false;
    }

    if (cedula === "" || !/^\d+$/.test(cedula)) {
        alert("Cédula inválida."); $("#cedula").focus(); return false;
    }

    if (celular === "" || !/^[0-9]{8}$/.test(celular)) {
        alert("Celular inválido (8 dígitos)."); $("#celular").focus(); return false;
    }

    if (direccion === "") {
        alert("Dirección vacía."); $("#direccion").focus(); return false;
    }

    if (correo === "" || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
        alert("Correo inválido."); $("#correo").focus(); return false;
    }

    if (fecha_nac === "") {
        alert("Fecha de nacimiento obligatoria."); $("#fecha_nac").focus(); return false;
    }

    return true;
}

function guardaryeditar(e) {
    e.preventDefault();

    if (!validarFormulario()) return;

    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/estudiante.php?op=guardaryeditar",
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
            bootbox.alert("Hubo un error al guardar/editar el estudiante.");
            $("#btnGuardar").prop("disabled", false);
        }
    });

    limpiar();
}

function mostrar(idestudiante) {
    $.post("../ajax/estudiante.php?op=mostrar", { idestudiante: idestudiante }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#idestudiante").val(data.idestudiante);
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#edad").val(data.edad);
        $("#cedula").val(data.cedula);
        $("#direccion").val(data.direccion);
        $("#celular").val(data.celular);
        $("#correo").val(data.correo);
        $("#fecha_nac").val(data.fecha_nac);
    });
}

function desactivar(idestudiante) {
    bootbox.confirm("¿Está seguro de desactivar el estudiante?", function(result) {
        if (result) {
            $.post("../ajax/estudiante.php?op=desactivar", { idestudiante: idestudiante }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(idestudiante) {
    bootbox.confirm("¿Está seguro de activar el estudiante?", function(result) {
        if (result) {
            $.post("../ajax/estudiante.php?op=activar", { idestudiante: idestudiante }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();