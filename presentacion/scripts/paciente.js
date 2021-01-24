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
	$("#idVacuna").val("");
	$("#nombre").val("");
	$("#sexo").val("M");
	$("#raza").val("");
	$("#especie").val("");
	$("#idPropietario").empty();
}

//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		$("#btnagregar").hide();
		
		//Cargamos los items al select Propietario
		$.post("../PacientePresentacion.php?op=seleccionarPropietario", function(r) {
			$("#idPropietario").html(r);									
			$('#idPropietario').selectpicker('refresh');
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
					url: '../PacientePresentacion.php?op=listar',
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
		url: "../PacientePresentacion.php?op=guardaryeditar",
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

function mostrar(idPaciente) {
	$.post("../PacientePresentacion.php?op=mostrar", {idPaciente: idPaciente}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idPaciente").val(data.id);//Asignar valor al input hidden
		$("#nombre").val(data.nombre);

		$("#sexo").val(data.sexo);
		$('#sexo').selectpicker('refresh');

		$("#raza").val(data.raza);
		$("#especie").val(data.especie);

		//Cargamos los items al select Propietario
		$.post("../PacientePresentacion.php?op=seleccionarPropietario", function(r) {
			$("#idPropietario").html(r);			
			
			$("#idPropietario").val(data.idPropietario);

			$('#idPropietario').selectpicker('refresh');
		});		
 	});
}


init();