<?php
require_once "../negocio/PacienteNegocio.php";
require_once "../negocio/PropietarioNegocio.php";

class PacientePresentacion {
    // Properties
	public $pacienteNegocio;
	public $propietarioNegocio;

    public function __construct()
	{
		$this->pacienteNegocio = new PacienteNegocio();
		$this->propietarioNegocio = new PropietarioNegocio();
	}
  
    // Methods
    public function insertar($nombre, $sexo, $raza, $especie, $idPropietario) 
    {        
		$rspta = $this->pacienteNegocio->insertar($nombre, $sexo, $raza, $especie, $idPropietario);
		echo $rspta ? "Paciente registrado" : "Paciente no se pudo registrar";		
	}
	
	public function editar($idPaciente, $nombre, $sexo, $raza, $especie, $idPropietario) 
    {        
		$rspta = $this->pacienteNegocio->editar($idPaciente, $nombre, $sexo, $raza, $especie, $idPropietario);
		echo $rspta ? "Paciente actualizado" : "Paciente no se pudo actualizar";		
    }
    
    public function mostrar($idPaciente) 
    {
        $rspta = $this->pacienteNegocio->mostrar($idPaciente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    }

    public function listar() 
    {
        $rspta = $this->pacienteNegocio->listar();
 		//Vamos a declarar un array
 		$data = [];

 		while ($reg = $rspta->fetch_object()) {
 			$data[] = array(
 				"0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>',
 				"1" => $reg->nombre,
				"2" => $reg->sexo,
				"3" => $reg->raza,
				"4" => $reg->especie,
				"5" => $reg->propietario
 			);
 		}
 		$results = array(
 			"sEcho" => 1, //Información para el datatables
 			"iTotalRecords" => count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
			 "aaData" => $data);
			 
 		echo json_encode($results);
	} 
	
	public function seleccionarPropietario() 
    {
        $rspta = $this->propietarioNegocio->listar();
 		//Codificar el resultado utilizando json		 				 
		while ($reg = $rspta->fetch_object())
		{			
			echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
		}
	}
}




$idPaciente = isset($_POST["idPaciente"]) ? limpiarCadena($_POST["idPaciente"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$sexo = isset($_POST["sexo"]) ? limpiarCadena($_POST["sexo"]) : "";
$raza = isset($_POST["raza"]) ? limpiarCadena($_POST["raza"]) : "";
$especie = isset($_POST["especie"]) ? limpiarCadena($_POST["especie"]) : "";
$idPropietario = isset($_POST["idPropietario"]) ? limpiarCadena($_POST["idPropietario"]) : "";

$pacientePresentacion = new PacientePresentacion();
switch ($_GET["op"]) 
{
	case 'guardaryeditar':		
		if (empty($idPaciente)) {
			$pacientePresentacion->insertar($nombre, $sexo, $raza, $especie, $idPropietario);
		} else {
			$pacientePresentacion->editar($idPaciente, $nombre, $sexo, $raza, $especie, $idPropietario);
		}				
	break;

	case 'mostrar':
		$pacientePresentacion->mostrar($idPaciente);
	break;

	case 'listar':
		$pacientePresentacion->listar();
	break;

	case 'seleccionarPropietario':
		$pacientePresentacion->seleccionarPropietario();
	break;
}

?>