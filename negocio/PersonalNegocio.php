<?php
require_once "../datos/PersonalDatos.php";

class PersonalNegocio {
    // Properties
    public $personalDatos;    

    public function __construct()
	{
        $this->personalDatos = new PersonalDatos();
	}
  
    public function insertar($nombre, $ci, $telefono, $email, $cargo, $profesion) 
    {
        $this->personalDatos->setNombre($nombre);
        $this->personalDatos->setCi($ci);
        $this->personalDatos->setTelefono($telefono);
        $this->personalDatos->setEmail($email);
        $this->personalDatos->setCargo($cargo);
        $this->personalDatos->setProfesion($profesion);
        $rspta = $this->personalDatos->insertar();
        return $rspta;
    }

    public function editar($idPersonal, $nombre, $ci, $telefono, $email, $idPersona, $cargo, $profesion)
    {
        $this->personalDatos->setIdpersonal($idPersonal);
        $this->personalDatos->setNombre($nombre);
        $this->personalDatos->setCi($ci);
        $this->personalDatos->setTelefono($telefono);
        $this->personalDatos->setEmail($email);
        $this->personalDatos->setIdPersona($idPersona);
        $this->personalDatos->setCargo($cargo);
        $this->personalDatos->setProfesion($profesion);
        $rspta = $this->personalDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idPersonal) 
    {
        $this->personalDatos->setIdpersonal($idPersonal);
        $rspta = $this->personalDatos->mostrar();
        return $rspta;
    }

    public function listar() 
    {
        $rspta = $this->personalDatos->listar();
        return $rspta;
    }    
}

?>