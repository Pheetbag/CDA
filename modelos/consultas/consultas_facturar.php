<?php

class consultas_facturar{

    private $conexion;

    public function __construct(){

        require 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

    public function facturas_resumen(){

        $sql_values     = null;

        $sql = "SELECT f.`codigo_factura`, f.`fecha_venta`, f.`ci_cliente`, f.`total`, c.`nombre_cliente`, c.`apellido_cliente`, (SELECT COUNT(`codigo_producto`) FROM `detalles_facturacion` WHERE `codigo_factura` = f.`codigo_factura`) AS `cantidad_productos` FROM `facturacion` f INNER JOIN `clientes` c ON c.`ci_cliente` = f.`ci_cliente`  ORDER BY `fecha_venta` DESC LIMIT 5";

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

}
