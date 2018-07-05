<?php

class consultas_registrar{

    private $conexion;

    public function __construct(){

        require 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

    public function producto($nombre, $tipo, $marca, $modelo, $existencias, $precio){

        $sql = "INSERT INTO `productos` (`nombre_producto`,`tipo_producto`,`marca_producto`,`modelo_producto`,`existencias`, `precio_venta`) VALUES (:nombre, :tipo, :marca, :modelo, :existencias, :precio);";
        $sql_values = [
            ':nombre'      => $nombre,
            ':tipo'        => $tipo,
            ':marca'       => $marca,
            ':modelo'      => $modelo,
            ':existencias' => $existencias,
            ':precio'      => $precio
        ];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        $sql = "SELECT LAST_INSERT_ID();";
        $sql_values = null;

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetch(PDO::FETCH_BOTH);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

    public function cliente($nombre, $apellido, $ci, $direccion, $telefono){

        $sql = "INSERT INTO `clientes` (`nombre_cliente`,`apellido_cliente`,`ci_cliente`,`direccion_cliente`, `telefono`) VALUES (:nombre, :apellido, :ci, :direccion, :telefono);";
        $sql_values = [
            ':nombre'    => $nombre,
            ':apellido'  => $apellido,
            ':ci'        => $ci,
            ':direccion' => $direccion,
            ':telefono'  => $telefono
        ];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        $sql = "SELECT * FROM `clientes` WHERE `ci_cliente` = :ci";
        $sql_values = [
            ':ci' => $ci
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

    public function proveedor($nombre, $telefono, $rif, $direccion){

        $sql = "INSERT INTO `proveedores` (`nombre_empresa`,`telefono`,`rif`, `direccion`) VALUES (:nombre, :telefono, :rif, :direccion)";

        $sql_values = [
            ':nombre'    => $nombre,
            ':telefono'  => $telefono,
            ':rif'        => $rif,
            ':direccion' => $direccion
        ];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);


        $sql = "SELECT LAST_INSERT_ID()";
        $sql_values = null;

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetch(PDO::FETCH_BOTH);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

    public function get($type, $value){

        switch ($type) {
            case 'cliente':

                $sql = "SELECT * FROM `clientes` WHERE `ci_cliente` = :ci";
                $sql_values = [
                    ':ci' => $value
                ];

                $consulta = $this->conexion->get_consulta($sql, $sql_values);

                if($consulta->rowCount() > 0){
                    $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                }else{
                    $datos = null;
                }

                return $datos;
                $conexion -> desconectar();
                break;

				case 'proveedor':

	                $sql = "SELECT * FROM `proveedores` WHERE `rif` = :rif";
	                $sql_values = [
	                    ':rif' => $value
	                ];

	                $consulta = $this->conexion->get_consulta($sql, $sql_values);

	                if($consulta->rowCount() > 0){
	                    $datos = $consulta->fetch(PDO::FETCH_ASSOC);
	                }else{
	                    $datos = null;
	                }

	                return $datos;
	                $conexion -> desconectar();
	                break;

			case 'producto':

				$sql = "SELECT * FROM `productos` WHERE `codigo_producto` = :id";
				$sql_values = [
					':id' => $value
				];

				$consulta = $this->conexion->get_consulta($sql, $sql_values);

                if($consulta->rowCount() > 0){
                    $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                }else{
                    $datos = null;
                }

                return $datos;
                $conexion -> desconectar();

				break;

			case 'select':

				$sql = "SELECT `nombre_producto` AS `nombre`, `codigo_producto` AS `codigo` FROM `productos` ORDER BY `nombre` ASC";
				$sql_values = null;
				$consulta = $this->conexion->get_consulta($sql, $sql_values);

				if($consulta->rowCount() > 0){
					$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
				}else{
					$datos = null;
				}

				return $datos;
				$conexion -> desconectar();

				break;
        }

    }

	public function factura($ci, $fecha, $productos, $cantidades, $subtotales, $subtotal, $iva, $total){

		//registramos primero la factura:

		$sql = "INSERT INTO `facturacion` (`ci_cliente`,`fecha_venta`,`subtotal`, `iva`, `total`) VALUES (:ci, :fecha, :subtotal, :iva, :total)";
		$sql_values = [
			':ci'       => $ci,
			':fecha'    => $fecha,
			':subtotal' => $subtotal,
			':iva'      => $iva,
			':total'    => $total
		];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

		//Obtenemos la id de la factura que acabamos de registrar, para usarla en los detalles.

		$sql = "SELECT LAST_INSERT_ID();";
        $sql_values = null;

        $resultado  = $this->conexion->get_consulta($sql, $sql_values);
		$id_factura = $resultado->fetch(PDO::FETCH_BOTH)[0];

		$cantidad_productos = count($productos);

		//creamos todos los detalles de facturación necesarios.
		for ($i=0; $i < $cantidad_productos; $i++) {

			$sql = "INSERT INTO `detalles_facturacion` (`codigo_factura`, `codigo_producto`,`cantidad`,`subtotal`) VALUES (:factura, :producto, :cantidad, :subtotal)";
			$sql_values = [
				':factura'  => $id_factura,
				':producto' => $productos[$i],
				':cantidad' => $cantidades[$i],
				':subtotal' => $subtotales[$i]
			];
	        $consulta = $this->conexion->get_consulta($sql, $sql_values);
		}

		return $id_factura;
	}

	public function pedido($rif, $fecha, $llegada, $productos, $cantidades, $costos, $precios, $subtotales, $subtotal, $iva, $total){

		//registramos primero el pedido

		$sql = "INSERT INTO `pedidos` (`codigo_proveedor`,`fecha`,`fecha_llegada`,`subtotal` , `iva`, `total`) VALUES (:rif, :fecha, :llegada, :subtotal, :iva, :total)";
		$sql_values = [
			':rif'      => $rif,
			':fecha'    => $fecha,
			':llegada'  => $llegada,
			':subtotal' => $subtotal,
			':iva'      => $iva,
			':total'    => $total
		];

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		//Obtenemos la id del pedido que acabamos de registrar, para usarla en los detalles.

		$sql = "SELECT LAST_INSERT_ID();";
		$sql_values = null;

		$resultado  = $this->conexion->get_consulta($sql, $sql_values);
		$id_pedido  = $resultado->fetch(PDO::FETCH_BOTH)[0];

		$cantidad_productos = count($productos);

		//creamos todos los detalles de facturación necesarios.
		for ($i=0; $i < $cantidad_productos; $i++) {

			$sql = "INSERT INTO `detalles_pedido` (`codigo_pedido`, `codigo_producto`, `precio_compra`, `cantidad`, `subtotal`) VALUES (:pedido, :producto, :costo, :cantidad, :subtotal)";
			$sql_values = [
				':pedido'   => $id_pedido,
				':producto' => $productos[$i],
				':costo'    => $costos[$i],
				':cantidad' => $cantidades[$i],
				':subtotal' => $subtotales[$i]
			];
	        $consulta = $this->conexion->get_consulta($sql, $sql_values);
		}

		//Actualizamos las existencias y costos de todos los productos comprados

		for ($i=0; $i < $cantidad_productos; $i++) {

			//Obtenemos los valores previos de el producto en la base de datos.
			$sql = "SELECT (`existencias`) FROM `productos` WHERE `codigo_producto` = :id";
			$sql_values = [
				':id' => $productos[$i]
			];

			$resultado    = $this->conexion->get_consulta($sql, $sql_values);
			$existencias  = $resultado->fetch(PDO::FETCH_BOTH)[0];

			$sql = "UPDATE `productos` SET `precio_venta` = :precio, `existencias` = :existencias WHERE `codigo_producto` = :id";
			$sql_values = [
				':precio'      => $precios[$i],
				':existencias' => $existencias + $cantidades[$i],
				':id'          => $productos[$i]
			];

	        $consulta = $this->conexion->get_consulta($sql, $sql_values);
		}


		return $id_pedido;
	}

}
