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

	public function setIdPaciente($IdPaciente)
	{
		$this->IdPaciente = $IdPaciente;
	}

	
/*
	//Implementamos un método para insertar registros
	public function insertar()
	{
		$sql = "INSERT INTO vacuna (nombre, indicaciones, fechaVencimiento) 
			VALUES ('$this->nombre','$this->indicaciones','$this->fechaVencimiento')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar()
	{
		$sql = "UPDATE vacuna SET nombre ='$this->nombre', indicaciones = '$this->indicaciones', fechaVencimiento = '$this->fechaVencimiento' 
			WHERE id = '$this->idVacuna'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar()
	{
		$sql="SELECT * FROM vacuna WHERE id = '$this->idVacuna'";
		return ejecutarConsultaSimpleFila($sql);
	}
*/
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT id, nombre, sexo, raza, especie, idPropietario
				FROM paciente";
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