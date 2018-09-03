<?php

class consultas_administracion{

    private $conexion;

    public function __construct(){

        require_once 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

    public function usuarios()
    {
        $sql_values     = null;
        $sql = "SELECT * FROM `usuarios`";
        $consulta = $this->conexion->get_consulta($sql, $sql_values);
        if($consulta->rowCount() > 0){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }
        return $datos;
        $conexion -> desconectar(); 
    } 

    public function eliminar($id)
    {
        $sql_values = [
            ':id' => $id
        ];
        $sql = "DELETE FROM `usuarios` WHERE `usuarios`.`id` = :id";
        $consulta = $this->conexion->get_consulta($sql, $sql_values);
    }

}
