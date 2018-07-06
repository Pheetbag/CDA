<?php

class consultas_ingresar{

    private $conexion;

    public function __construct(){

        require_once 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

    public function log($usuario, $contraseña){

        $sql = "SELECT id,usuario FROM `usuarios` WHERE usuario = :user AND clave = :contra";

        $sql_values = [':user'   => $usuario,
                       ':contra' => $contraseña];

        $consulta = $this-> conexion->get_consulta($sql, $sql_values);

        if($consulta->rowCount() == 1){
            $datos = $consulta -> fetch(PDO::FETCH_ASSOC);
        }else{
            $datos = null;
        }

        return $datos;
        $conexion -> desconectar();
    }

}
