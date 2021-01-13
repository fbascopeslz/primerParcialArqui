<?php
require_once "../negocio/VacunaNegocio.php";

class VacunaPresentacion {
    // Properties
    public $vacunaNegocio;    

    public function __construct()
	{
        $this->vacunaNegocio = new VacunaNegocio();
	}
  
    // Methods
    public function insertar($nombre, $indicaciones, $fechaVencimiento) 
    {        
		$rspta = $this->vacunaNegocio->insertar($nombre, $indicaciones, $fechaVencimiento);
		echo $rspta ? "Vacuna registrada" : "Vacuna no se pudo registrar";		
	}
	
	public function editar($idVacuna, $nombre, $indicaciones, $fechaVencimiento) 
    {        
		$rspta = $this->vacunaNegocio->editar($idVacuna, $nombre, $indicaciones, $fechaVencimiento);
		echo $rspta ? "Vacuna actualizada" : "Vacuna no se pudo actualizar";		
    }
    
    public function mostrar($idVacuna) 
    {
        $rspta = $this->vacunaNegocio->mostrar($idVacuna);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    }

    public function listar() 
    {
        $rspta = $this->vacunaNegocio->listar();
 		//Vamos a declarar un array
 		$data = [];

 		while ($reg = $rspta->fetch_object()) {
 			$data[] = array(
 				"0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>',
 				"1" => $reg->nombre,
				"2" => $reg->indicaciones,
				"3" => $reg->fechaVencimiento		
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




$idVacuna = isset($_POST["idVacuna"]) ? limpiarCadena($_POST["idVacuna"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$indicaciones = isset($_POST["indicaciones"]) ? limpiarCadena($_POST["indicaciones"]) : "";
$fechaVencimiento = isset($_POST["fechaVencimiento"]) ? limpiarCadena($_POST["fechaVencimiento"]) : "";

$vacunaPresentacion = new VacunaPresentacion();
switch ($_GET["op"]) 
{
	case 'guardaryeditar':		
		if (empty($idVacuna)) {
			$vacunaPresentacion->insertar($nombre, $indicaciones, $fechaVencimiento);
		} else {
			$vacunaPresentacion->editar($idVacuna, $nombre, $indicaciones, $fechaVencimiento);
		}				
	break;

	case 'mostrar':
		$vacunaPresentacion->mostrar($idVacuna);
	break;

	case 'listar':
		$vacunaPresentacion->listar();
	break;
}

?>