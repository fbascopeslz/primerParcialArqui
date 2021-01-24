<?php
require_once "../datos/PacienteDatos.php";

class PacienteNegocio {
    // Properties
    public $pacienteDatos;    

    public function __construct()
	{
        $this->pacienteDatos = new PacienteDatos();
	}

    public function insertar($nombre, $sexo, $raza, $especie, $idPropietario) 
    {
        $this->pacienteDatos->setNombre($nombre);
        $this->pacienteDatos->setSexo($sexo);
        $this->pacienteDatos->setRaza($raza);
        $this->pacienteDatos->setEspecie($especie);
        $this->pacienteDatos->setIdPropietario($idPropietario);
        $rspta = $this->pacienteDatos->insertar();
        return $rspta;
    }

    public function editar($idPaciente, $nombre, $sexo, $raza, $especie, $idPropietario) 
    {
        $this->pacienteDatos->setIdPaciente($idPaciente);
        $this->pacienteDatos->setNombre($nombre);
        $this->pacienteDatos->setSexo($sexo);
        $this->pacienteDatos->setRaza($raza);
        $this->pacienteDatos->setEspecie($especie);
        $this->pacienteDatos->setIdPropietario($idPropietario);
        $rspta = $this->pacienteDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idPaciente) 
    {
        $this->pacienteDatos->setIdPaciente($idPaciente);
        $rspta = $this->pacienteDatos->mostrar();
        return $rspta;
    }

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