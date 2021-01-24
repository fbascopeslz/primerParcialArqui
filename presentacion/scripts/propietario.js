var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e) {
		guardaryeditar(e);	
	});
}

//Función limpiar
function limpiar() {
	$("#idPropietario").val("");
	$("#idPersona").val("");
	$("#nombre").val("");
	$("#ci").val("");
	$("#telefono").val(0);
	$("#email").val("");
	$("#fechaUnion").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		$("#btnagregar").hide();
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform() {
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar() {
	tabla = $('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../PropietarioPresentacion.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e) {
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../PropietarioPresentacion.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
			bootbox.alert(datos);	          
			mostrarform(false);
			tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idPropietario) {
	$.post("../PropietarioPresentacion.php?op=mostrar", {idPropietario: idPropietario}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idPropietario").val(data.id);
		$("#nombre").val(data.nombre);
		$("#ci").val(data.ci);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
		//$("#fechaUnion").val(data.fechaUnion);
		$("#idPersona").val(data.idPersona);
 	})
}


init();