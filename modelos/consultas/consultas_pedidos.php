<?php

class consultas_pedidos{

    private $conexion;

    public function __construct(){

        require 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

    public function pedidos_resumen(){

        $sql_values     = null;

        $sql = "SELECT pd.`codigo_pedido`, pd.`fecha`, pd.`fecha_llegada`, pd.`codigo_proveedor`, pd.`total`, p.`nombre_empresa`, (SELECT COUNT(`codigo_producto`) FROM `detalles_pedido` WHERE `codigo_pedido` = pd.`codigo_pedido`) AS `cantidad_productos` FROM `pedidos` pd INNER JOIN `proveedores` p ON p.`rif` = pd.`codigo_proveedor` ORDER BY `fecha` DESC LIMIT 5";

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

	public function proveedores_resumen(){

        $sql_values     = null;

        $sql = "SELECT * FROM `proveedores` ORDER BY `nombre_empresa` LIMIT 5";

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

	public function pedido($id){

		$sql = "SELECT * FROM `pedidos` pd INNER JOIN `proveedores` p ON p.`rif` = pd.`codigo_proveedor` WHERE pd.`codigo_pedido` = :id";
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

		$sql = "SELECT pd.`codigo_pedido`, pd.`codigo_producto`, pd.`cantidad`, pd.`subtotal`, p.`nombre_producto` FROM `detalles_pedido` pd INNER JOIN `productos` p ON p.`codigo_producto` = pd.`codigo_producto` WHERE pd.`codigo_pedido` = :id";

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
