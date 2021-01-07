<?php
require_once "../negocio/CategoriaNegocio.php";

class CategoriaPresentacion {
    // Properties
    public $categoriaNegocio;    

    public function __construct()
	{
        $this->categoriaNegocio = new CategoriaNegocio();
	}
  
    // Methods
    public function guardarYEditar($idCategoria, $nombre, $descripcion) 
    {
        if (empty($idCategoria)){
			$rspta = $this->categoriaNegocio->insertar($nombre, $descripcion);
			echo $rspta ? "Categoría registrada" : "Categoría no se pudo registrar";
		}
		else {
			$rspta = $this->categoriaNegocio->editar($idCategoria, $nombre, $descripcion);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
    }

    public function desactivar($idCategoria) 
    {
        $rspta = $this->categoriaNegocio->desactivar($idCategoria);
 		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
    }

    public function activar($idCategoria) 
    {
        $rspta = $this->categoriaNegocio->activar($idCategoria);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
    }
    
    public function mostrar($idCategoria) 
    {
        $rspta = $this->categoriaNegocio->mostrar($idCategoria);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
    }

    public function listar() 
    {
        $rspta = $this->categoriaNegocio->listar();
 		//Vamos a declarar un array
 		$data = Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
 				"3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
    }    
}



$idCategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]):"";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]):"";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]):"";

$categoriaPresentacion = new CategoriaPresentacion();
switch ($_GET["op"]){
	case 'guardaryeditar':
		$categoriaPresentacion->guardarYEditar($idCategoria, $nombre, $descripcion);
	break;

	case 'desactivar':
		$categoriaPresentacion->desactivar($idCategoria);
	break;

	case 'activar':
		$categoriaPresentacion->activar($idCategoria);
	break;

	case 'mostrar':
		$categoriaPresentacion->mostrar($idCategoria);
	break;

	case 'listar':
		$categoriaPresentacion->listar();
	break;
}

?>