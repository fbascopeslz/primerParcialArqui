<?php
require_once "../negocio/ConsultaNegocio.php";
require_once "../negocio/PersonalNegocio.php";
require_once "../negocio/PacienteNegocio.php";

class ConsultaPresentacion {
    // Properties
	public $consultaNegocio;
	public $personalNegocio;
	public $pacienteNegocio;

    public function __construct()
	{
		$this->consultaNegocio = new ConsultaNegocio();
		$this->personalNegocio = new PersonalNegocio();
		$this->pacienteNegocio = new PacienteNegocio();
	}
  
    // Methods
    public function insertar($estado, $motivo, $diagnostico, $idPersonal, $idPaciente) 
    {        
		$rspta = $this->consultaNegocio->insertar($estado, $motivo, $diagnostico, $idPersonal, $idPaciente);
		echo $rspta ? "Consulta registrada" : "Consulta no se pudo registrar";		
	}
	
	public function editar($idConsulta, $estado, $motivo, $diagnostico, $idPersonal, $idPaciente) 
    {        
		$rspta = $this->consultaNegocio->editar($idConsulta, $estado, $motivo, $diagnostico, $idPersonal, $idPaciente);
		echo $rspta ? "Consulta actualizada" : "Consulta no se pudo actualizar";		
    }
    
    public function mostrar($idConsulta) 
    {
        $rspta = $this->consultaNegocio->mostrar($idConsulta);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    }

    public function listar() 
    {
        $rspta = $this->consultaNegocio->listar();
 		//Vamos a declarar un array
 		$data = [];

 		while ($reg = $rspta->fetch_object()) {
 			$data[] = array(
 				"0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>',
 				"1" => $reg->fecha,
				"2" => $reg->hora,
				"3" => $reg->estado,
				"4" => $reg->motivo,
				"5" => $reg->diagnostico,
				"6" => $reg->Personal,
				"7" => $reg->Paciente
 			);
 		}
 		$results = array(
 			"sEcho" => 1, //Información para el datatables
 			"iTotalRecords" => count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
			 "aaData" => $data);
			 
 		echo json_encode($results);
	} 
	
	public function seleccionarPersonal() 
    {
        $rspta = $this->personalNegocio->listar();
 		//Codificar el resultado utilizando json		 				 
		while ($reg = $rspta->fetch_object())
		{			
			echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
		}
	}

	public function seleccionarPaciente() 
    {
        $rspta = $this->pacienteNegocio->listar();
 		//Codificar el resultado utilizando json		 				 
		while ($reg = $rspta->fetch_object())
		{			
			echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
		}
	}
}




$idConsulta = isset($_POST["idConsulta"]) ? limpiarCadena($_POST["idConsulta"]) : "";
$estado = isset($_POST["estado"]) ? limpiarCadena($_POST["estado"]) : "";
$motivo = isset($_POST["motivo"]) ? limpiarCadena($_POST["motivo"]) : "";
$diagnostico = isset($_POST["diagnostico"]) ? limpiarCadena($_POST["diagnostico"]) : "";
$idPersonal = isset($_POST["idPersonal"]) ? limpiarCadena($_POST["idPersonal"]) : "";
$idPaciente = isset($_POST["idPaciente"]) ? limpiarCadena($_POST["idPaciente"]) : "";

$consultaPresentacion = new ConsultaPresentacion();
switch ($_GET["op"]) 
{
	case 'guardaryeditar':		
		if (empty($idConsulta)) {
			$consultaPresentacion->insertar($estado, $motivo, $diagnostico, $idPersonal, $idPaciente);
		} else {
			$consultaPresentacion->editar($idConsulta, $estado, $motivo, $diagnostico, $idPersonal, $idPaciente);
		}				
	break;

	case 'mostrar':
		$consultaPresentacion->mostrar($idConsulta);
	break;

	case 'listar':
		$consultaPresentacion->listar();
	break;

	case 'seleccionarPersonal':
		$consultaPresentacion->seleccionarPersonal();
	break;

	case 'seleccionarPaciente':
		$consultaPresentacion->seleccionarPaciente();
	break;
}

?>