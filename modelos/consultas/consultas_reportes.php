<?php

class consultas_reportes{

    private $conexion;

    public function __construct(){

        require_once 'libs/conexion.php';
        $this-> conexion = new conexion;
    }


    public function pedido($fecha_min, $fecha_max)
    {
        $sql = "SELECT * FROM `pedidos` WHERE `fecha` BETWEEN :min AND :max ORDER BY `fecha` ASC";
        $sql_values = [
            ':min' => $fecha_min . ' 00:00:00',
            ':max' => $fecha_max . ' 23:59:59'
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
    
    public function detalle_pedido($id)
    {
        $sql_values = [
            ':id' => $id
        ];
        $sql = "SELECT COUNT(`codigo_pedido`) AS `cantidad`, SUM(`cantidad`) AS `unidades` FROM `detalles_pedido` WHERE `codigo_pedido` = :id";

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }
   
        return $datos;
        $conexion -> desconectar();
    }

    public function factura($fecha_min, $fecha_max)
    {
        $sql = "SELECT * FROM `facturacion` WHERE `fecha_venta` BETWEEN :min AND :max ORDER BY `fecha_venta` ASC";
        $sql_values = [
            ':min' => $fecha_min . ' 00:00:00',
            ':max' => $fecha_max . ' 23:59:59'
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
    
    public function detalle_factura($id)
    {
        $sql_values = [
            ':id' => $id
        ];
        $sql = "SELECT COUNT(`codigo_factura`) AS `cantidad`, SUM(`cantidad`) AS `unidades` FROM `detalles_facturacion` WHERE `codigo_factura` = :id";

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() > 0){
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }
   
        return $datos;
        $conexion -> desconectar();      
    }

    public function get_totales($type)
    {
              
        switch ($type) {
            case 'venta':
                $sql = "SELECT SUM(`total`) AS total FROM `facturacion` WHERE `fecha_venta` BETWEEN :min AND :max";
                break;
            
            case 'compra':
                $sql = "SELECT SUM(`subtotal`) AS total FROM `pedidos`  WHERE `fecha` BETWEEN :min AND :max";
                break;
        }  

        $sql_values = [ 
            ':min' => date('Y-m-d', strtotime('6 days ago')) . ' 00:00:00',
            ':max' => date('Y-m-d') . ' 23:59:59'
        ];

        $consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = [ 'total' => '0.00' ];
		}

		return $datos;
		$this -> conexion -> desconectar();
    }

    public function get_semanal($type, $days)
    {
        
        switch ($type) {
            case 'venta':
                $sql = "SELECT COUNT(`codigo_factura`) AS cantidad FROM `facturacion` WHERE `fecha_venta` BETWEEN :min AND :max";
                break;
            
            case 'compra':
                $sql = "SELECT COUNT(`codigo_pedido`) AS cantidad FROM `pedidos` WHERE `fecha` BETWEEN :min AND :max";
                break;
            
        }

        $fecha = date('Y-m-d', strtotime( $days . ' days ago'));

		$sql_values = [ 
            ':min' => $fecha . ' 00:00:00',
            ':max' => $fecha . ' 23:59:59'
        ];

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = [ 'cantidad' => '0' ];
		}

		return $datos;
		$this -> conexion -> desconectar();
	}


}
