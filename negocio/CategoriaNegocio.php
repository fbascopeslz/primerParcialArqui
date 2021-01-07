<?php
require_once "../datos/CategoriaDatos.php";

class CategoriaNegocio {
    // Properties
    public $categoriaDatos;    

    public function __construct()
	{
        $this->categoriaDatos = new CategoriaDatos();
	}
  
    public function insertar($nombre, $descripcion) 
    {
        $rspta = $this->categoriaDatos->insertar($nombre, $descripcion);
        return $rspta;
    }

    public function editar($idCategoria, $nombre, $descripcion) 
    {
        $rspta = $this->categoriaDatos->editar($idCategoria, $nombre, $descripcion);
        return $rspta;
    }

    public function desactivar($idCategoria) 
    {
        $rspta = $this->categoriaDatos->desactivar($idCategoria);
        return $rspta;
    }

    public function activar($idCategoria) 
    {
        $rspta = $this->categoriaDatos->activar($idCategoria);
        return $rspta;
    }
    
    public function mostrar($idCategoria) 
    {
        $rspta = $this->categoriaDatos->mostrar($idCategoria);
        return $rspta;
    }

    public function listar() 
    {
        $rspta = $this->categoriaDatos->listar();
        return $rspta;
    }    
}

?>