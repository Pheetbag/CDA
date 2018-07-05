<?php

class consultas_facturar{

    private $conexion;

    public function __construct(){

        require 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

	public function clientes($limite, $pagina){

		$limite_inicial = 0 + ($limite * ($pagina - 1));

        $sql = "SELECT * FROM `clientes` ORDER BY `nombre_cliente` LIMIT " . $limite_inicial . ',' . $limite;
		$sql_values     = null;

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();

	}

	public function clientes_total(){

		$sql_values = null;

		$sql = "SELECT COUNT(`ci_cliente`) AS `total` FROM `clientes` ORDER BY `nombre_cliente`";

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$conexion -> desconectar();
	}

	public function facturas($limite, $pagina){

        $limite_inicial = 0 + ($limite * ($pagina - 1));

        $sql = "SELECT f.`codigo_factura`, f.`fecha_venta`, f.`ci_cliente`, f.`total`, c.`nombre_cliente`, c.`apellido_cliente`, (SELECT COUNT(`codigo_producto`) FROM `detalles_facturacion` WHERE `codigo_factura` = f.`codigo_factura`) AS `cantidad_productos` FROM `facturacion` f INNER JOIN `clientes` c ON c.`ci_cliente` = f.`ci_cliente`  ORDER BY `fecha_venta` DESC LIMIT " . $limite_inicial . ',' . $limite;
		$sql_values     = null;

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

	public function facturas_total(){

		$sql_values = null;

		$sql = "SELECT COUNT(f.`codigo_factura`) AS `total` FROM `facturacion` f INNER JOIN `clientes` c ON c.`ci_cliente` = f.`ci_cliente`  ORDER BY `fecha_venta` DESC";

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$conexion -> desconectar();
	}

	public function facturas_resumen($limite = 5){

        $sql = "SELECT f.`codigo_factura`, f.`fecha_venta`, f.`ci_cliente`, f.`total`, c.`nombre_cliente`, c.`apellido_cliente`, (SELECT COUNT(`codigo_producto`) FROM `detalles_facturacion` WHERE `codigo_factura` = f.`codigo_factura`) AS `cantidad_productos` FROM `facturacion` f INNER JOIN `clientes` c ON c.`ci_cliente` = f.`ci_cliente`  ORDER BY `fecha_venta` DESC LIMIT 5";

        $sql_values     = null;

        $consulta = $this->conexion->get_consulta($sql, $sql_values);
        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }
        return $datos;
        $conexion -> desconectar();
    }


	public function clientes_resumen(){
        $sql_values     = null;
        $sql = "SELECT * FROM `clientes` ORDER BY `nombre_cliente` LIMIT 5";
        $consulta = $this->conexion->get_consulta($sql, $sql_values);
        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }
        return $datos;
        $conexion -> desconectar();
    }

	public function factura($id){

        $sql = "SELECT * FROM `facturacion` f INNER JOIN `clientes` c ON c.`ci_cliente` = f.`ci_cliente` WHERE f.`codigo_factura` = :id";
		$sql_values = [':id' => $id];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();

	}

	public function detalles($id){

		$sql = "SELECT f.`codigo_factura`, f.`codigo_producto`, f.`cantidad`, f.`subtotal`, p.`nombre_producto` FROM `detalles_facturacion` f INNER JOIN `productos` p ON p.`codigo_producto` = f.`codigo_producto` WHERE f.`codigo_factura` = :id";

		$sql_values = [':id' => $id];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();

	}

	public function cliente($id){

		$sql = "SELECT * FROM `clientes` WHERE `ci_cliente` = :id";

		$sql_values = [':id' => $id];

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$conexion -> desconectar();
	}

	public function movimientos($id){

		$sql = "SELECT `codigo_factura`, `fecha_venta`, `subtotal`, `iva`, `total` FROM `facturacion` WHERE `ci_cliente`= :id ORDER BY `fecha_venta` DESC, `subtotal` DESC, `codigo_factura` DESC LIMIT 15";

		$sql_values = [':id' => $id];

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$conexion -> desconectar();
	}
}
