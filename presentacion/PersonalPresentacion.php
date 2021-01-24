<?php
require_once "../negocio/PersonalNegocio.php";

class PersonalPresentacion {
    // Properties
    public $personalNegocio;    

    public function __construct()
	{
        $this->personalNegocio = new PersonalNegocio();
	}
  
    // Methods
    public function insertar($nombre, $ci, $telefono, $email, $cargo, $profesion) 
    {        
		$rspta = $this->personalNegocio->insertar($nombre, $ci, $telefono, $email, $cargo, $profesion);
		echo $rspta ? "Personal registrado" : "Personal no se pudo registrar";		
	}
	
	public function editar($idPersonal, $nombre, $ci, $telefono, $email, $idPersona, $cargo, $profesion) 
    {        
		$rspta = $this->personalNegocio->editar($idPersonal, $nombre, $ci, $telefono, $email, $idPersona, $cargo, $profesion);
		echo $rspta ? "Personal actualizado" : "Personal no se pudo actualizar";		
    }
    
    public function mostrar($idPersonal) 
    {
		$rspta = $this->personalNegocio->mostrar($idPersonal);		
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    }

    public function listar() 
    {
        $rspta = $this->personalNegocio->listar();
 		//Vamos a declarar un array
 		$data = [];

 		while ($reg = $rspta->fetch_object()) {
 			$data[] = array(
 				"0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>',
 				"1" => $reg->nombre,
				"2" => $reg->ci,
				"3" => $reg->telefono,
				"4" => $reg->email,
				"5" => $reg->cargo,
				"6" => $reg->profesion		
 			);
 		}
 		$results = array(
 			"sEcho" => 1, //Información para el datatables
 			"iTotalRecords" => count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
			 "aaData" => $data);
			 
 		echo json_encode($results);
    }    
}




$idPersonal = isset($_POST["idPersonal"]) ? limpiarCadena($_POST["idPersonal"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$ci = isset($_POST["ci"]) ? limpiarCadena($_POST["ci"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$idPersona = isset($_POST["idPersona"]) ? limpiarCadena($_POST["idPersona"]) : "";
$cargo = isset($_POST["cargo"]) ? limpiarCadena($_POST["cargo"]) : "";
$profesion = isset($_POST["profesion"]) ? limpiarCadena($_POST["profesion"]) : "";

$personalPresentacion = new PersonalPresentacion();
switch ($_GET["op"]) 
{
	case 'guardaryeditar':		
		if (empty($idPersonal)) {
			$personalPresentacion->insertar($nombre, $ci, $telefono, $email, $cargo, $profesion);
		} else {
			$personalPresentacion->editar($idPersonal, $nombre, $ci, $telefono, $email, $idPersona, $cargo, $profesion);
		}				
	break;

	case 'mostrar':
		$personalPresentacion->mostrar($idPersonal);
	break;

	case 'listar':
		$personalPresentacion->listar();
	break;
}

?>