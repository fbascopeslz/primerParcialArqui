var tabla;

//Función que se ejecuta al inicio
function init()
{
	mostrarform(1);
	//listar();

	$("#formularioSeleccionarPropietario").on("submit",function(e)
	{
		//guardaryeditar(e);
		propietarioSeleccionado();
	});


	//Cargamos los items al select Propietario
	$.post("../CartillaVacunacionPresentacion.php?op=seleccionarPropietario", function(r) {
		$("#idPropietario").html(r);
		$('#idPropietario').selectpicker('refresh');
	});	
}

//Función limpiar
function limpiar()
{
	$("#idPropietario").val("");
	/*
	$("#cliente").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	$("#impuesto").val("0");

	$("#total_venta").val("");
	$(".filas").remove();
	$("#total").html("0");

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);

    //Marcamos el primer tipo_documento
    $("#tipo_comprobante").val("Boleta");
	$("#tipo_comprobante").selectpicker('refresh');
	*/
}

//Función mostrar formulario
function mostrarform(flag)
{
	//limpiar();
	/*
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles=0;
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
	*/

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
			$("#btnAgregarVacuna").show();						

			break;
	
		default:
			break;
	}
}

function propietarioSeleccionado() {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	
	mostrarform(2);

	var idPaciente = $("#idPaciente").val();

	//Cargamos los items al select Paciente
	$.post("../CartillaVacunacionPresentacion.php?op=seleccionarPaciente&idPropietario=" + idPaciente, function(r) {
		$("#idPaciente").html(r);
		$('#idPaciente').selectpicker('refresh');
	});
}

init();