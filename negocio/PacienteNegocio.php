<?php
require_once "../datos/PacienteDatos.php";

class PacienteNegocio {
    // Properties
    public $pacienteDatos;    

    public function __construct()
	{
        $this->pacienteDatos = new PacienteDatos();
	}
  /*
    public function insertar($nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->PacienteDatos->setNombre($nombre);
        $this->PacienteDatos->setIndicaciones($indicaciones);
        $this->PacienteDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->PacienteDatos->insertar();
        return $rspta;
    }

    public function editar($idPaciente, $nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->PacienteDatos->setIdPaciente($idPaciente);
        $this->PacienteDatos->setNombre($nombre);
        $this->PacienteDatos->setIndicaciones($indicaciones);
        $this->PacienteDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->PacienteDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idPaciente) 
    {
        $this->PacienteDatos->setIdPaciente($idPaciente);
        $rspta = $this->PacienteDatos->mostrar();
        return $rspta;
    }
*/
    public function listar() 
    {
        $rspta = $this->pacienteDatos->listar();
        return $rspta;
    } 

    public function seleccionarPaciente($idPropietario) 
    {
        $rspta = $this->pacienteDatos->seleccionarPaciente($idPropietario);
        return $rspta;
    } 
}

?>