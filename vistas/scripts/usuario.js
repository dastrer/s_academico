var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#imagenmuestra").hide();

	// Si usas permisos u otro contenido en el div permisos, déjalo o quítalo
	$.post("../ajax/usuario.php?op=permisos&id=",function(r){
	    $("#permisos").html(r);
	});

	$('#mAcceso').addClass("treeview active");
    $('#lUsuarios').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#cedula").val("");
	$("#direccion").val("");
	$("#celular").val("");
	$("#email").val("");
	$("#cargo").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenmuestra").hide();
	$("#imagenactual").val("");
	$("#idusuario").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla = $('#tbllistado').dataTable({
		"lengthMenu": [5, 10, 25, 75, 100], // menú registros
		"aProcessing": true, // activar procesamiento
	    "aServerSide": true, // paginación por servidor
	    dom: '<Bl<f>rtip>', // elementos tabla
	    buttons: [
	        'copyHtml5',
	        'excelHtml5',
	        'csvHtml5',
	        'pdf'
	    ],
		"ajax": {
			url: '../ajax/usuario.php?op=listar',
			type: "get",
			dataType: "json",
			error: function(e) {
				console.log(e.responseText);
			}
		},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
                "copyTitle": "Tabla Copiada",
                "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 5,
	    "order": [[ 0, "desc" ]]
	}).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos) {
	        bootbox.alert(datos);
	        mostrarform(false);
	        tabla.ajax.reload();
	    }
	});
	limpiar();
}

//Función mostrar usuario para editar
function mostrar(idusuario)
{
	$.post("../ajax/usuario.php?op=mostrar", {idusuario: idusuario}, function(data, status) {
		data = JSON.parse(data);
		mostrarform(true);

		$("#idusuario").val(data.idusuario);
		$("#nombre").val(data.nombre);
		$("#cedula").val(data.cedula);
		$("#direccion").val(data.direccion);
		$("#celular").val(data.celular);
		$("#email").val(data.email);
		$("#cargo").val(data.cargo);
		$("#login").val(data.login);
		// No mostramos la clave por seguridad, deja el campo vacío para cambiar si quiere
		$("#clave").val("");
		if (data.imagen) {
			$("#imagenmuestra").show();
			$("#imagenmuestra").attr("src", "../files/usuarios/" + data.imagen);
			$("#imagenactual").val(data.imagen);
		} else {
			$("#imagenmuestra").hide();
			$("#imagenactual").val("");
		}
	});
	
	// Si usas permisos o no, esta línea puede quitarse si no existe la funcionalidad
	$.post("../ajax/usuario.php?op=permisos&id=" + idusuario, function(r){
	    $("#permisos").html(r);
	});
}

//Función para desactivar registros
function desactivar(idusuario)
{
	bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/usuario.php?op=desactivar", {idusuario: idusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idusuario)
{
	bootbox.confirm("¿Está Seguro de activar el Usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/usuario.php?op=activar", {idusuario: idusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();



