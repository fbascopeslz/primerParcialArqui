<?php
require_once "../datos/PropietarioDatos.php";

class PropietarioNegocio {
    // Properties
    public $propietarioDatos;    

    public function __construct()
	{
        $this->propietarioDatos = new PropietarioDatos();
	}
  
    public function insertar($nombre, $ci, $telefono, $email) 
    {
        //set Timezone PHP
        date_default_timezone_set('America/La_Paz');
        
        $this->propietarioDatos->setNombre($nombre);
        $this->propietarioDatos->setCi($ci);
        $this->propietarioDatos->setTelefono($telefono);
        $this->propietarioDatos->setEmail($email);
        $this->propietarioDatos->setFechaUnion(date('Y-m-d'));    
        $rspta = $this->propietarioDatos->insertar();
        return $rspta;
    }

    public function editar($idPropietario, $nombre, $ci, $telefono, $email, $idPersona) 
    {
        $this->propietarioDatos->setIdPropietario($idPropietario);
        $this->propietarioDatos->setNombre($nombre);
        $this->propietarioDatos->setCi($ci);
        $this->propietarioDatos->setTelefono($telefono);
        $this->propietarioDatos->setEmail($email);
        $this->propietarioDatos->setIdPersona($idPersona);
        $rspta = $this->propietarioDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idPropietario) 
    {
        $this->propietarioDatos->setIdPropietario($idPropietario);
        $rspta = $this->propietarioDatos->mostrar();
        return $rspta;
    }

    public function listar() 
    {
        $rspta = $this->propietarioDatos->listar();
        return $rspta;
    }    
}

?>