<?php
require_once "../datos/CartillaVacunacionDatos.php";

class CartillaVacunacionNegocio {
    // Properties
    public $cartillaVacunacionDatos;    

    public function __construct()
	{
        $this->cartillaVacunacionDatos = new CartillaVacunacionDatos();
	}
  
    /*
    

    public function editar($idcartillaVacunacion, $nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->cartillaVacunacionDatos->setIdcartillaVacunacion($idcartillaVacunacion);
        $this->cartillaVacunacionDatos->setNombre($nombre);
        $this->cartillaVacunacionDatos->setIndicaciones($indicaciones);
        $this->cartillaVacunacionDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->cartillaVacunacionDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idcartillaVacunacion) 
    {
        $this->cartillaVacunacionDatos->setIdcartillaVacunacion($idcartillaVacunacion);
        $rspta = $this->cartillaVacunacionDatos->mostrar();
        return $rspta;
    }
*/

    public function insertar($idPaciente, $arrayIdVacunas, $arrayFechaProximaVacuna) 
    {
        //set Timezone PHP
        date_default_timezone_set('America/La_Paz');
        
        $rspta = null;        

        for ($i=0; $i < count($arrayIdVacunas); $i++) { 
            $this->cartillaVacunacionDatos->setIdVacuna($arrayIdVacunas[$i]);
            $this->cartillaVacunacionDatos->setIdPaciente($idPaciente);
            $this->cartillaVacunacionDatos->setFechaVacuna(date('Y-m-d')); //Fecha actual
            $this->cartillaVacunacionDatos->setFechaProximaVacuna($arrayFechaProximaVacuna[$i]);
            $rspta = $this->cartillaVacunacionDatos->insertar();
        }

        return $rspta;
    }

    public function listar($idPaciente) 
    {        
        $rspta = $this->cartillaVacunacionDatos->listar($idPaciente);
        return $rspta;
    }    
}

?>