<?php

class consultas_perfil{

    private $conexion;

    public function __construct(){

        require_once 'libs/conexion.php';
        $this-> conexion = new conexion;
    }

	public function get($id){

		$sql = 'SELECT `id`, `usuario`, `rango` FROM `usuarios` WHERE `id` = :id';
		$sql_values = [ ':id' => $id ];

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$this -> conexion -> desconectar();
	}

	public function validar($contra, $id){

		$sql = 'SELECT `id`, `usuario`, `rango` FROM `usuarios` WHERE `id` = :id AND `clave` = :clave';
		$sql_values = [ ':id' => $id, ':clave' => $contra ];

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		if($consulta->rowCount() > 0){
			$datos = $consulta->fetch(PDO::FETCH_ASSOC);
		}else{
			$datos = null;
		}

		return $datos;
		$this -> conexion -> desconectar();
	}

	public function cambiar_clave($contra, $id){

		$sql = 'UPDATE `usuarios` SET `clave`= :clave WHERE `id` = :id';
		$sql_values = [ ':id' => $id, ':clave' => $contra ];

		$consulta = $this->conexion->get_consulta($sql, $sql_values);

		$this -> conexion -> desconectar();
	}

}
