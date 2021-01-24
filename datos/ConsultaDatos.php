<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class ConsultaDatos
{
	public $idConsulta;
	public $fecha;
	public $hora;
	public $estado;
	public $motivo;
	public $diagnostico;
	public $idPersonal;
	public $idPaciente;

	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	
	public function getIdConsulta()
	{
		return $this->idConsulta;
	}

	public function setIdConsulta($idConsulta)
	{
		$this->idConsulta = $idConsulta;
	}

	public function getFecha()
	{
		return $this->fecha;
	}

	public function setFecha($fecha)
	{
		$this->fecha = $fecha;
	}

	public function getHora()
	{
		return $this->hora;
	}

	public function setHora($hora)
	{
		$this->hora = $hora;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function setEstado($estado)
	{
		$this->estado = $estado;
	}

	public function getMotivo()
	{
		return $this->motivo;
	}

	public function setMotivo($motivo)
	{
		$this->motivo = $motivo;
	}

	public function getDiagnostico()
	{
		return $this->diagnostico;
	}

	public function setDiagnostico($diagnostico)
	{
		$this->diagnostico = $diagnostico;
	}

	public function getIdPersonal()
	{
		return $this->idPersonal;
	}

	public function setIdPersonal($idPersonal)
	{
		$this->idPersonal = $idPersonal;
	}

	public function getIdPaciente()
	{
		return $this->idPaciente;
	}

	public function setIdPaciente($idPaciente)
	{
		$this->idPaciente = $idPaciente;
	}

	
	//Implementamos un método para insertar registros
	public function insertar()
	{
		$sql = "INSERT INTO consulta (fecha, hora, estado, motivo, diagnostico, idPersonal, idPaciente) 
			VALUES ('$this->fecha','$this->hora','$this->estado', '$this->motivo', '$this->diagnostico', $this->idPersonal, $this->idPaciente)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar()
	{
		$sql = "UPDATE consulta 
				SET estado ='$this->estado', 
					motivo = '$this->motivo', 
					diagnostico = '$this->diagnostico', 					
					idPersonal = $this->idPersonal,
					idPaciente = $this->idPaciente 
				WHERE id = '$this->idConsulta'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar()
	{
		$sql = "SELECT C.id, C.fecha, C.hora, C.estado, C.motivo, C.diagnostico, PER.nombre as Personal, PAC.nombre AS Paciente
				FROM consulta C, personal PL, persona PER, paciente PAC
				WHERE C.idPersonal = PL.id AND PL.idPersona = PER.id AND C.idPaciente = PAC.id AND C.id = $this->idConsulta";	
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT C.id, C.fecha, C.hora, C.estado, C.motivo, C.diagnostico, PER.nombre as Personal, PAC.nombre AS Paciente
				FROM consulta C, personal PL, persona PER, paciente PAC
				WHERE C.idPersonal = PL.id AND PL.idPersona = PER.id AND C.idPaciente = PAC.id";
		return ejecutarConsulta($sql);		
	}	
}

?>