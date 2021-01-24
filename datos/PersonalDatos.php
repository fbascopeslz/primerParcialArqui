<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class PersonalDatos
{
	public $idPersonal;	
	public $nombre;
	public $ci;
	public $telefono;
	public $email;
	public $idPersona;
	public $cargo;
	public $profesion;


	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	
	public function getIdPersonal()
	{
		return $this->idPersonal;
	}

	public function setIdPersonal($idPersonal)
	{
		$this->idPersonal = $idPersonal;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function getCi()
	{
		return $this->ci;
	}

	public function setCi($ci)
	{
		$this->ci = $ci;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getIdPersona()
	{
		return $this->idPersona;
	}

	public function setIdPersona($idPersona)
	{
		$this->idPersona = $idPersona;
	}

	public function getCargo()
	{
		return $this->cargo;
	}

	public function setCargo($cargo)
	{
		$this->cargo = $cargo;
	}

	public function getProfesion()
	{
		return $this->profesion;
	}

	public function setProfesion($profesion)
	{
		$this->profesion = $profesion;
	}



	//Implementamos un método para insertar registros
	public function insertar()
	{
		$sql = "INSERT INTO persona (nombre, ci, telefono, email) 
			VALUES ('$this->nombre','$this->ci', $this->telefono, '$this->email')";
		$idPersona = ejecutarConsulta_retornarID($sql);		

		$sql = "INSERT INTO personal (cargo, profesion, idPersona) 
			VALUES ('$this->cargo', '$this->profesion', $idPersona)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar()
	{
		$sql = "UPDATE persona 
				SET nombre ='$this->nombre', ci = '$this->ci', telefono = $this->telefono, email = '$this->email' 
				WHERE id = $this->idPersona";
		ejecutarConsulta($sql);

		$sql = "UPDATE personal
				SET cargo ='$this->cargo', profesion = '$this->profesion'
				WHERE id = $this->idPersonal";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar()
	{
		$sql = "SELECT Pl.id, Per.nombre, Per.ci, Per.telefono, Per.email, Pl.idPersona AS idPersona, Pl.cargo, Pl.profesion
				FROM persona Per, personal Pl
				WHERE Pl.idPersona = Per.id AND Pl.id = $this->idPersonal";			
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT Pl.id, Per.nombre, Per.ci, Per.telefono, Per.email, Pl.cargo, Pl.profesion
				FROM persona Per, personal Pl
				WHERE Pl.idPersona = Per.id";
		return ejecutarConsulta($sql);		
	}
	
}

?>