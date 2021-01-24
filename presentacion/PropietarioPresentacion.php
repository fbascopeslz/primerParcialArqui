<?php
require_once "../negocio/PropietarioNegocio.php";

class PropietarioPresentacion {
    // Properties
    public $propietarioNegocio;    

    public function __construct()
	{
        $this->propietarioNegocio = new PropietarioNegocio();
	}
  
    // Methods
    public function insertar($nombre, $ci, $telefono, $email) 
    {        
		$rspta = $this->propietarioNegocio->insertar($nombre, $ci, $telefono, $email);
		echo $rspta ? "Propietario registrado" : "Propietario no se pudo registrar";		
	}
	
	public function editar($idPropietario, $nombre, $ci, $telefono, $email, $idPersona) 
    {        
		$rspta = $this->propietarioNegocio->editar($idPropietario, $nombre, $ci, $telefono, $email, $idPersona);
		echo $rspta ? "Propietario actualizado" : "Propietario no se pudo actualizar";		
    }
    
    public function mostrar($idPropietario) 
    {
		$rspta = $this->propietarioNegocio->mostrar($idPropietario);		
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    }

    public function listar() 
    {
        $rspta = $this->propietarioNegocio->listar();
 		//Vamos a declarar un array
 		$data = [];

 		while ($reg = $rspta->fetch_object()) {
 			$data[] = array(
 				"0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>',
 				"1" => $reg->nombre,
				"2" => $reg->ci,
				"3" => $reg->telefono,
				"4" => $reg->email,
				"5" => $reg->fechaUnion		
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




$idPropietario = isset($_POST["idPropietario"]) ? limpiarCadena($_POST["idPropietario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$ci = isset($_POST["ci"]) ? limpiarCadena($_POST["ci"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$idPersona = isset($_POST["idPersona"]) ? limpiarCadena($_POST["idPersona"]) : "";

$propietarioPresentacion = new PropietarioPresentacion();
switch ($_GET["op"]) 
{
	case 'guardaryeditar':		
		if (empty($idPropietario)) {
			$propietarioPresentacion->insertar($nombre, $ci, $telefono, $email);
		} else {
			$propietarioPresentacion->editar($idPropietario, $nombre, $ci, $telefono, $email, $idPersona);
		}				
	break;

	case 'mostrar':
		$propietarioPresentacion->mostrar($idPropietario);
	break;

	case 'listar':
		$propietarioPresentacion->listar();
	break;
}

?>