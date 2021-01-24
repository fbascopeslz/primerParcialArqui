<?php
require_once "../negocio/CartillaVacunacionNegocio.php";
require_once "../negocio/PropietarioNegocio.php";
require_once "../negocio/PacienteNegocio.php";
require_once "../negocio/VacunaNegocio.php";

class CartillaVacunacionPresentacion {
    // Properties	
	public $propietarioNegocio;
	public $pacienteNegocio;
	public $vacunaNegocio;
	public $cartillaVacunacionNegocio;

    public function __construct()
	{	
		$this->propietarioNegocio = new PropietarioNegocio();	
		$this->pacienteNegocio = new PacienteNegocio();
		$this->vacunaNegocio = new VacunaNegocio();
		$this->cartillaVacunacionNegocio = new CartillaVacunacionNegocio();
	}

  /*        	
	public function editar($idPropietario, $nombre, $indicaciones, $fechaVencimiento) 
    {        
		$rspta = $this->PropietarioNegocio->editar($idPropietario, $nombre, $indicaciones, $fechaVencimiento);
		echo $rspta ? "Propietario actualizada" : "Propietario no se pudo actualizar";		
    }
    
    public function mostrar($idPropietario) 
    {
        $rspta = $this->PropietarioNegocio->mostrar($idPropietario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    }
*/

	public function insertar($idPaciente, $arrayIdVacunas, $arrayFechaProximaVacuna) 
    {        
		$rspta = $this->cartillaVacunacionNegocio->insertar($idPaciente, $arrayIdVacunas, $arrayFechaProximaVacuna);
		echo $rspta ? "Cartilla de Vacunacion registrada" : "Cartilla de Vacunacion no se pudo registrar";		
	}

	public function seleccionarPropietario() 
    {
        $rspta = $this->propietarioNegocio->listar();
 		//Codificar el resultado utilizando json		 				 
		while ($reg = $rspta->fetch_object())
		{
			//var_dump($reg);
			echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
		}
	}

	public function seleccionarPaciente($idPropietario) 
    {		
        $rspta = $this->pacienteNegocio->seleccionarPaciente($idPropietario);		
		//Codificar el resultado utilizando json		 				 
		while ($reg = $rspta->fetch_object())
		{
			//var_dump($reg);
			echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
		}
	}

	public function seleccionarVacuna($idPaciente) 
    {
		$rspta = $this->vacunaNegocio->seleccionarVacuna($idPaciente);		
		//Codificar el resultado utilizando json		 				 
		while ($reg = $rspta->fetch_object())
		{
			//var_dump($reg);
			echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
		}		
	}
		
    public function listar($idPaciente) 
    {
		$rspta = $this->cartillaVacunacionNegocio->listar($idPaciente);

 		//Vamos a declarar un array
 		$data = [];

 		while ($reg = $rspta->fetch_object()) {
 			$data[] = array(
 				//"0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>',
 				"0" => $reg->vacuna,
				"1" => $reg->indicaciones,
				"2" => $reg->fechaVacuna,
				"3" => $reg->fechaProximaVacuna	
 			);
 		}
 		$results = array(
 			"sEcho" => 1, //Información para el datatables
 			"iTotalRecords" => count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
			"aaData" => $data
		);
			 
 		echo json_encode($results);
	}
	
}


$cartillaVacunacionPresentacion = new CartillaVacunacionPresentacion();
switch ($_GET["op"]) 
{
	case 'insertar':		
		$idPaciente = isset($_GET["idPaciente"]) ? limpiarCadena($_GET["idPaciente"]) : "";
		$arrayIdVacunas = $_POST["idVacuna"];
		$arrayFechaProximaVacuna = $_POST["fechaProximaVacuna"];
		$cartillaVacunacionPresentacion->insertar($idPaciente, $arrayIdVacunas, $arrayFechaProximaVacuna);
	break;

	case 'listar':
		$idPaciente = isset($_GET["idPaciente"]) ? limpiarCadena($_GET["idPaciente"]) : "";
		$cartillaVacunacionPresentacion->listar($idPaciente);
	break;

	case 'seleccionarPropietario':
		$cartillaVacunacionPresentacion->seleccionarPropietario();
	break;

	case 'seleccionarPaciente':
		$idPropietario = isset($_GET["idPropietario"]) ? limpiarCadena($_GET["idPropietario"]) : "";		
		$cartillaVacunacionPresentacion->seleccionarPaciente($idPropietario);
	break;

	case 'seleccionarVacuna':
		$idPaciente = isset($_GET["idPaciente"]) ? limpiarCadena($_GET["idPaciente"]) : "";		
		$cartillaVacunacionPresentacion->seleccionarVacuna($idPaciente);
	break;

}

?>