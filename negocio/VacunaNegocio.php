<?php
require_once "../datos/VacunaDatos.php";

class VacunaNegocio {
    // Properties
    public $vacunaDatos;    

    public function __construct()
	{
        $this->vacunaDatos = new VacunaDatos();
	}
  
    public function insertar($nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->vacunaDatos->setNombre($nombre);
        $this->vacunaDatos->setIndicaciones($indicaciones);
        $this->vacunaDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->vacunaDatos->insertar();
        return $rspta;
    }

    public function editar($idVacuna, $nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->vacunaDatos->setIdVacuna($idVacuna);
        $this->vacunaDatos->setNombre($nombre);
        $this->vacunaDatos->setIndicaciones($indicaciones);
        $this->vacunaDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->vacunaDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idVacuna) 
    {
        $this->vacunaDatos->setIdVacuna($idVacuna);
        $rspta = $this->vacunaDatos->mostrar();
        return $rspta;
    }

    public function listar() 
    {
        $rspta = $this->vacunaDatos->listar();
        return $rspta;
    }

    public function seleccionarVacuna($idPaciente) 
    {
        $rspta = $this->vacunaDatos->seleccionarVacuna($idPaciente);
        return $rspta;
    } 
}

?>