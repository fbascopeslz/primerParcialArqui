<?php
require_once "../datos/PropietarioDatos.php";

class PropietarioNegocio {
    // Properties
    public $propietarioDatos;    

    public function __construct()
	{
        $this->propietarioDatos = new PropietarioDatos();
	}
  /*
    public function insertar($nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->PropietarioDatos->setNombre($nombre);
        $this->PropietarioDatos->setIndicaciones($indicaciones);
        $this->PropietarioDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->PropietarioDatos->insertar();
        return $rspta;
    }

    public function editar($idPropietario, $nombre, $indicaciones, $fechaVencimiento) 
    {
        $this->PropietarioDatos->setIdPropietario($idPropietario);
        $this->PropietarioDatos->setNombre($nombre);
        $this->PropietarioDatos->setIndicaciones($indicaciones);
        $this->PropietarioDatos->setFechaVencimiento($fechaVencimiento);
        $rspta = $this->PropietarioDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idPropietario) 
    {
        $this->PropietarioDatos->setIdPropietario($idPropietario);
        $rspta = $this->PropietarioDatos->mostrar();
        return $rspta;
    }
*/
    public function listar() 
    {
        $rspta = $this->propietarioDatos->listar();
        return $rspta;
    }    
}

?>