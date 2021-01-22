<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class CartillaVacunacionDatos
{
	public $idCartillaVacunacion;
	public $fechaVacuna;
	public $fechaProximaVacuna;
	public $idPaciente;
	public $idVacuna;

	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	

	public function getIdCartillaVacunacion()
	{
		return $this->idCartillaVacunacion;
	}

	public function setIdCartillaVacunacion($idCartillaVacunacion)
	{
		$this->idCartillaVacunacion = $idCartillaVacunacion;
	}

	public function getfechaVacuna()
	{
		return $this->fechaVacuna;
	}

	public function setfechaVacuna($fechaVacuna)
	{
		$this->fechaVacuna = $fechaVacuna;
	}

	public function getfechaProximaVacuna()
	{
		return $this->fechaProximaVacuna;
	}

	public function setfechaProximaVacuna($fechaProximaVacuna)
	{
		$this->fechaProximaVacuna = $fechaProximaVacuna;
	}

	public function getIdPaciente()
	{
		return $this->idPaciente;
	}

	public function setIdPaciente($idPaciente)
	{
		$this->idPaciente = $idPaciente;
	}

	public function getidVacuna()
	{
		return $this->idVacuna;
	}

	public function setIdVacuna($idVacuna)
	{
		$this->idVacuna = $idVacuna;
	}

	
/*
	//Implementamos un método para insertar registros
	public function insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_venta,$idarticulo,$cantidad,$precio_venta,$descuento)
	{
		$sql="INSERT INTO venta (idcliente,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_venta,estado)
		VALUES ('$idcliente','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_venta','Aceptado')";
		//return ejecutarConsulta($sql);
		$idventanew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_venta(idventa, idarticulo,cantidad,precio_venta,descuento) VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	
	//Implementamos un método para anular la venta
	public function anular($idventa)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idventa)
	{
		$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idventa)
	{
		$sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,(dv.cantidad*dv.precio_venta-dv.descuento) as subtotal FROM detalle_venta dv inner join articulo a on dv.idarticulo=a.idarticulo where dv.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	
	public function ventacabecera($idventa){
		$sql="SELECT v.idventa,v.idcliente,p.nombre as cliente,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,v.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,date(v.fecha_hora) as fecha,v.impuesto,v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function ventadetalle($idventa){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}
	*/

	public function listar($idPaciente)
	{
		$sql = "SELECT V.nombre AS vacuna, V.indicaciones, CV.fechaVacuna, CV.fechaProximaVacuna
				FROM vacuna V, cartillavacunacion CV
				WHERE CV.idVacuna = V.id
					AND CV.idPaciente = $idPaciente";
		return ejecutarConsulta($sql);		
	}
}

?>