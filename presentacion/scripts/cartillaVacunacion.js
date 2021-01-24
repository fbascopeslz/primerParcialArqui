var tabla;
var cont = 0;


//Función que se ejecuta al inicio
function init()
{
	mostrarform(1);	

	$("#formularioSeleccionarPropietario").on("submit", function(e)
	{		
		propietarioSeleccionado(e);
	});

	$("#formularioInsertarCartillaVacunacion").on("submit", function(e)
	{
		guardar(e);		
	});

	//Cargamos los items al select Propietario
	$.post("../CartillaVacunacionPresentacion.php?op=seleccionarPropietario", function(r) {
		$("#idPropietario").html(r);
		$('#idPropietario').selectpicker('refresh');
	});	
}

//Función mostrar formulario
function mostrarform(flag)
{
	switch (flag) {
		case 1:
			$("#formularioSeleccionarPaciente").hide();
			$("#listadoCartillaVacunacion").hide();
			$("#insertarCartillaVacunacion").hide();

			$("#btnAgregarVacuna").hide();
			
			$("#listarCartillaVacunacion").show();

			break;

		case 2:
			$("#formularioSeleccionarPaciente").show();			
			$("#btnAgregarVacuna").hide();						

			break;

		case 3:
			$("#btnAgregarVacuna").show();			
			$("#listadoCartillaVacunacion").show();						

			break;

		case 4:
			//ocultar panel listarCartillaVacunacion
			$("#listarCartillaVacunacion").hide();		
			//mosttrar panel insertarCartillaVacunacion
			$("#insertarCartillaVacunacion").show();						
			
			agregarVacunas();

			break;
		
		case 5:
			$("#insertarCartillaVacunacion").hide();
			$("#listarCartillaVacunacion").show();

			//limpiar
			$(".filas").remove();
			$("#fechaProximaVacuna").val("");
			$("#idVacuna").empty();

	
		default:
			break;
	}
}

function propietarioSeleccionado(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	
	mostrarform(2);

	var idPropietario = $("#idPropietario").val();

	//Cargamos los items al select Paciente
	$.post("../CartillaVacunacionPresentacion.php?op=seleccionarPaciente&idPropietario=" + idPropietario, function(r) {
		$("#idPaciente").html(r);
		$('#idPaciente').selectpicker('refresh');
	});

	$("#formularioSeleccionarPaciente").on("submit",function(e)
	{
		pacienteSeleccionado(e);
	});
}

function pacienteSeleccionado(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	
	mostrarform(3);

	listar();
}

function listar() {
	var idPaciente = $("#idPaciente").val();

	tabla = $('#tblListadoCartillaVacunacion').dataTable(
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
					url: '../CartillaVacunacionPresentacion.php?op=listar&idPaciente=' + idPaciente,
					type : "get",
					dataType : "json",					
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
		"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function agregarVacunas() {			
	var idPaciente = $("#idPaciente").val();

	//Cargamos los items al select Vacuna
	$.post("../CartillaVacunacionPresentacion.php?op=seleccionarVacuna&idPaciente=" + idPaciente, function(r) {
		$("#idVacuna").html(r);
		$('#idVacuna').selectpicker('refresh');
	});	
}


function agregarVacunaTabla() {	

	if (!$('#idVacuna').val()) { //comprobar que ya se agregaron todas las vacunas
		alert("Ya se agregaron todas las vacunas!");
		return;
	}
	if (!$('#fechaProximaVacuna').val()) { //comprobar que el input date tenga una fecha
		alert("Se debe elegir la fecha de la proxima vacuna!");
		return;
	} 				

	var idVacuna = $("#idVacuna").val();
	var nombreVacuna = $("#idVacuna option:selected").text();
	var fechaProximaVacuna = $("#fechaProximaVacuna").val();

	//quitar esa opcion del select
	$("#idVacuna option[value='" + idVacuna + "']").remove();
	//$('.remove-example').find('[value=Mustard]').remove();
	$('#idVacuna').selectpicker('refresh');

	var fila =
		'<tr class="filas" id="fila'+cont+'">'+
			'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
			'<td id=filaNombreVacuna' + cont + '><input type="hidden" id=filaVacuna' + cont + ' name="idVacuna[]" value="'+idVacuna+'">'+nombreVacuna+'</td>'+
			'<td><input type="date" readonly value=' + getDate() + '>' + '</td>'+
			'<td><input type="date" name="fechaProximaVacuna[]" id="fechaProximaVacuna[]" value="'+fechaProximaVacuna+'"></td>'+						
		'</tr>';
		
	cont++;  
	$('#tablaDetallesVacuna').append(fila);
	
}

function eliminarDetalle(index) {	
	//agregar esa opcion al select
	var idVacuna = $('input#filaVacuna' + index).val();
	console.log(idVacuna);
	var nombreVacuna = $("#filaNombreVacuna" + index).text();
	console.log(nombreVacuna);

	$("#idVacuna").append('<option value="' + idVacuna +'">' + nombreVacuna + '</option>');
	$('#idVacuna').selectpicker('refresh');

	$("#fila" + index).remove();	
	cont=cont-1;
	
}

function getDate() {
	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day);
	return today;
}

function guardar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento

	if (cont > 0) {
		var formData = new FormData($("#formularioInsertarCartillaVacunacion")[0]);
		var idPaciente = $("#idPaciente").val();
		$.ajax({
			url: "../CartillaVacunacionPresentacion.php?op=insertar&idPaciente=" + idPaciente,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos)
			{                    
				bootbox.alert(datos);	          
				mostrarform(5);
				//tabla.ajax.reload();
				listar();
			}
		});
	} else {
		alert("Porfavor agregue almenos una vacuna");
	}
}


init();