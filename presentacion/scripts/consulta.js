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
	$("#idConsulta").val("");
	$("#estado").val("");
	$("#motivo").val("");
	$("#diagnostico").val("");	
	$("#idPersonal").empty();
	$("#idPaciente").empty();
}

//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		$("#btnagregar").hide();
		
		//Cargamos los items al select Personal
		$.post("../ConsultaPresentacion.php?op=seleccionarPersonal", function(r) {
			$("#idPersonal").html(r);									
			$('#idPersonal').selectpicker('refresh');
		});

		//Cargamos los items al select Paciente
		$.post("../ConsultaPresentacion.php?op=seleccionarPaciente", function(r) {
			$("#idPaciente").html(r);									
			$('#idPaciente').selectpicker('refresh');
		});

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
					url: '../ConsultaPresentacion.php?op=listar',
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
		url: "../ConsultaPresentacion.php?op=guardaryeditar",
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

function mostrar(idConsulta) {
	$.post("../ConsultaPresentacion.php?op=mostrar", {idConsulta: idConsulta}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idConsulta").val(data.id);//Asignar valor al input hidden
		$("#estado").val(data.estado);		
		$("#motivo").val(data.motivo);
		$("#diagnostico").val(data.diagnostico);

		//Cargamos los items al select Personal
		$.post("../ConsultaPresentacion.php?op=seleccionarPersonal", function(r) {
			$("#idPersonal").html(r);						
			$("#idPersonal").val(data.idPersonal);
			$('#idPersonal').selectpicker('refresh');
		});
		
		//Cargamos los items al select Paciente
		$.post("../ConsultaPresentacion.php?op=seleccionarPaciente", function(r) {
			$("#idPaciente").html(r);						
			$("#idPaciente").val(data.idPaciente);
			$('#idPaciente').selectpicker('refresh');
		});
 	});
}


init();