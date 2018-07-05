<?php

class consultas_inventario{

    private $conexion;

    public function __construct(){

        require 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

    public function productos($limite, $pagina){

        $sql_values     = null;
        $limite_inicial = 0 + ($limite * ($pagina - 1));

        $sql = "SELECT * FROM `productos` ORDER BY `codigo_producto` DESC LIMIT " . $limite_inicial . ',' . $limite;

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

    public function productos_total(){

        $sql_values = null;
        $sql = ' SELECT COUNT(`codigo_producto`) AS `total` FROM `productos` ';
        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();

    }

    public function producto($id){

        $sql = "SELECT * FROM `productos` WHERE codigo_producto = :id";
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

	public function producto_movimientos($id){


		$sql = "SELECT dp.`codigo_pedido` as `codigo`, 'compra' as `tipo`, dp.`cantidad`, dp.`subtotal`, p.`fecha`
		FROM `detalles_pedido` dp INNER JOIN `pedidos` p ON dp.`codigo_pedido` = p.`codigo_pedido` WHERE dp.`codigo_producto` = :id

		UNION ALL

		SELECT df.`codigo_factura` as `codigo`, 'venta' as `tipo` , df.`cantidad`, df.`subtotal`, f.`fecha_venta` AS `fecha` FROM `detalles_facturacion` df INNER JOIN `facturacion` f ON df.`codigo_factura` = f.`codigo_factura` WHERE df.`codigo_producto` = :id

		ORDER BY `fecha` DESC, `subtotal` DESC, `codigo` DESC

		LIMIT 15";

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

    public function producto_eliminar($id){

        $sql= "DELETE FROM `productos` WHERE codigo_producto = :id";
        $sql_values = [':id' => $id];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);
    }

    public function producto_actualizar($id, $nombre, $tipo, $marca, $modelo, $existencias, $precio){

        $sql= "UPDATE `productos` SET `nombre_producto`= :nombre,`tipo_producto`= :tipo,`marca_producto`= :marca,`modelo_producto`= :modelo,`existencias`= :existencias, `precio_venta`= :precio WHERE codigo_producto = :id";

        $sql_values = [
            ':nombre'     => $nombre,
            ':tipo'       => $tipo,
            ':marca'      => $marca,
            'modelo'      => $modelo,
            'existencias' => $existencias,
            ':precio'     => $precio,
            ':id'         => $id
        ];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);
    }

    public function buscar($busqueda, $limite, $pagina){

        $limite_inicial = 0 + ($limite * ($pagina - 1));

        $sql = 'SELECT * FROM `productos` WHERE `nombre_producto` RLIKE :buscar OR `tipo_producto` RLIKE :otros OR `marca_producto` RLIKE :otros OR `modelo_producto` RLIKE :otros LIMIT ' . $limite_inicial . ',' . $limite ;
        $sql_values = [
            ':buscar' => $busqueda[1],
            ':otros'  => $busqueda[0]
        ];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

    public function buscar_total($busqueda){

        $sql = 'SELECT COUNT(`codigo_producto`) AS `total` FROM `productos` WHERE `nombre_producto` RLIKE :buscar OR `tipo_producto` RLIKE :otros OR `marca_producto` RLIKE :otros OR `modelo_producto` RLIKE :otros';
        $sql_values = [
            ':buscar' => $busqueda[1],
            ':otros'  => $busqueda[0]
        ];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }
}
