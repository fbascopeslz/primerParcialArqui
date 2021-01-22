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
    public function insertar($nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->cartillaVacunacionDatos->setNombre($nombre);
        $this->cartillaVacunacionDatos->setIndicaciones($indicaciones);
        $this->cartillaVacunacionDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->cartillaVacunacionDatos->insertar();
        return $rspta;
    }

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
    public function listar($idPaciente) 
    {        
        $rspta = $this->cartillaVacunacionDatos->listar($idPaciente);
        return $rspta;
    }    
}

?>