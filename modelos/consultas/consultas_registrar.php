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
            ':tipo'        => strtolower($tipo),
            ':marca'       => strtolower($marca),
            ':modelo'      => strtolower($modelo),
            ':existencias' => str_replace('.', '',$existencias),
            ':precio'      => str_replace('.', '',$precio)
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
            ':nombre'    => strtolower($nombre),
            ':apellido'  => strtolower($apellido),
            ':ci'        => intval(str_replace('.', '', $ci)),
            ':direccion' => $direccion,
            ':telefono'  => intval(str_replace('-', '', $telefono))
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

        $sql = "INSERT INTO `proveedores` (`nombre_empresa`,`telefono`,`rif`, `direccion`) VALUES (:nombre, :telefono, :rif, :direccion);";

        $sql_values = [
            ':nombre'    => strtolower($nombre),
            ':telefono'  => intval(str_replace('-', '',$telefono)),
            ':rif'        => intval($rif),
            ':direccion' => $direccion
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
        }

    }

}
