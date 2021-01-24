<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class PacienteDatos
{
	public $idPaciente;
	public $nombre;
	public $sexo;
	public $raza;
	public $especie;
	public $idPropietario;

	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	
	public function getIdPaciente()
	{
		return $this->idPaciente;
	}

	public function setIdPaciente($idPaciente)
	{
		$this->idPaciente = $idPaciente;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function getSexo()
	{
		return $this->sexo;
	}

	public function setSexo($sexo)
	{
		$this->sexo = $sexo;
	}

	public function getRaza()
	{
		return $this->raza;
	}

	public function setRaza($raza)
	{
		$this->raza = $raza;
	}

	public function getEspecie()
	{
		return $this->especie;
	}

	public function setEspecie($especie)
	{
		$this->especie = $especie;
	}

	public function getIdPropietario()
	{
		return $this->idPropietario;
	}

	public function setIdPropietario($idPropietario)
	{
		$this->idPropietario = $idPropietario;
	}

	
	//Implementamos un método para insertar registros
	public function insertar()
	{
		$sql = "INSERT INTO paciente (nombre, sexo, raza, especie, idPropietario) 
			VALUES ('$this->nombre','$this->sexo','$this->raza', '$this->especie', $this->idPropietario)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar()
	{
		$sql = "UPDATE paciente SET nombre ='$this->nombre', sexo = '$this->sexo', raza = '$this->raza', especie = '$this->especie', idPropietario = $this->idPropietario
			WHERE id = '$this->idPaciente'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar()
	{
		$sql="SELECT * FROM paciente WHERE id = $this->idPaciente";		
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT PA.id, PA.nombre, PA.sexo, PA.raza, PA.especie, PER.nombre AS propietario
				FROM paciente PA, propietario PRO, persona PER
				WHERE PA.idPropietario = PRO.id AND PRO.idPersona = PER.id";
		return ejecutarConsulta($sql);		
	}
	
	public function seleccionarPaciente($idPropietario)
	{
		$sql = "SELECT id, nombre, sexo, raza, especie, idPropietario
				FROM paciente
				WHERE idPropietario = $idPropietario";
		return ejecutarConsulta($sql);		
	}
	
}

?>