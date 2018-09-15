<?php

class consultas_pedidos{

    private $conexion;

    public function __construct(){

        require_once 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

	public function proveedores($limite, $pagina){

		$limite_inicial = 0 + ($limite * ($pagina - 1));

        $sql = "SELECT * FROM `proveedores` ORDER BY `nombre_empresa` LIMIT " . $limite_inicial . ',' . $limite;
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

	public function proveedores_total(){

		$sql_values = null;
		$sql = "SELECT COUNT(`rif`) AS `total` FROM `proveedores` ORDER BY `nombre_empresa`";

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$conexion -> desconectar();
	}

	public function pedidos($limite, $pagina){

        $limite_inicial = 0 + ($limite * ($pagina - 1));

        $sql = "SELECT pd.`codigo_pedido`, pd.`fecha`, pd.`fecha_llegada`, pd.`codigo_proveedor`, pd.`subtotal`, p.`nombre_empresa`, (SELECT COUNT(`codigo_producto`) FROM `detalles_pedido` WHERE `codigo_pedido` = pd.`codigo_pedido`) AS `cantidad_productos` FROM `pedidos` pd INNER JOIN `proveedores` p ON p.`rif` = pd.`codigo_proveedor` ORDER BY `fecha` DESC LIMIT " . $limite_inicial . ',' . $limite;

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

	public function pedidos_total(){

		$sql_values = null;

        $sql = "SELECT COUNT(pd.`codigo_pedido`) AS `total` FROM `pedidos` pd INNER JOIN `proveedores` p ON p.`rif` = pd.`codigo_proveedor` ORDER BY `fecha` DESC";

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$conexion -> desconectar();
	}

    public function pedidos_resumen(){

        $sql_values     = null;

        $sql = "SELECT pd.`codigo_pedido`, pd.`fecha`, pd.`fecha_llegada`, pd.`codigo_proveedor`, pd.`subtotal`, p.`nombre_empresa`, (SELECT COUNT(`codigo_producto`) FROM `detalles_pedido` WHERE `codigo_pedido` = pd.`codigo_pedido`) AS `cantidad_productos` FROM `pedidos` pd INNER JOIN `proveedores` p ON p.`rif` = pd.`codigo_proveedor` ORDER BY `fecha` DESC LIMIT 5";

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

	public function proveedor($id){

		$sql = "SELECT * FROM `proveedores` WHERE `rif` = :id";
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

		$sql = "SELECT `codigo_pedido`, `fecha`, `fecha_llegada`, `subtotal` FROM `pedidos` WHERE `codigo_proveedor`= :id ORDER BY `fecha` DESC, `subtotal` DESC, `fecha_llegada` DESC LIMIT 15";

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
