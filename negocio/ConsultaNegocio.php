<?php
require_once "../datos/ConsultaDatos.php";

class ConsultaNegocio {
    // Properties
    public $consultaDatos;    

    public function __construct()
	{
        $this->consultaDatos = new ConsultaDatos();
	}

    public function insertar($estado, $motivo, $diagnostico, $idPersonal, $idPaciente) 
    {
        //set Timezone PHP
        date_default_timezone_set('America/La_Paz');

        $this->consultaDatos->setFecha(date('Y-m-d'));
        $this->consultaDatos->setHora(date('H:i:s'));
        $this->consultaDatos->setEstado($estado);
        $this->consultaDatos->setMotivo($motivo);
        $this->consultaDatos->setDiagnostico($diagnostico);
        $this->consultaDatos->setIdPersonal($idPersonal);
        $this->consultaDatos->setIdPaciente($idPaciente);
        $rspta = $this->consultaDatos->insertar();
        return $rspta;
    }

    public function editar($idConsulta, $estado, $motivo, $diagnostico, $idPersonal, $idPaciente) 
    {
        $this->consultaDatos->setIdConsulta($idConsulta);
        $this->consultaDatos->setEstado($estado);
        $this->consultaDatos->setMotivo($motivo);
        $this->consultaDatos->setDiagnostico($diagnostico);
        $this->consultaDatos->setIdPersonal($idPersonal);
        $this->consultaDatos->setIdPaciente($idPaciente);
        $rspta = $this->consultaDatos->editar();
        return $rspta;
    }  
    
    public function mostrar($idConsulta) 
    {
        $this->consultaDatos->setIdConsulta($idConsulta);
        $rspta = $this->consultaDatos->mostrar();
        return $rspta;
    }

    public function listar() 
    {
        $rspta = $this->consultaDatos->listar();
        return $rspta;
    }   
}

?>