<?php

class conexion{

    private $conexion;
    private $consulta;

    function __construct(){

        try{

        $this->conexion = new PDO(DB_HOST, DB_USUARIO, DB_CONTRA);

        $this->conexion ->exec("SET CHARACTER SET ". DB_CHARSET);

        $this->conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(Exception $e){

			$codigo = $e->getCode();

			switch ($codigo) {

				case '1049': //No existe la base de datos.

					//Creamos la base de datos, con todos sus elementos internos.Gracias a la función crear_db y crear_tablas de la libreria control_db.
					crear_db();
					crear_tablas();

					header('location:' . HTTP);

					break;

				default: //Comportamiento para cualquier error desconocido.

					require 'controladores/error.php';
		            $controlador = new error;
		            $controlador->db_conexion($e->getMessage());
					break;
			}

            exit();
        	$this->conexion = 'failed';

        }finally{
        return $this->conexion;
        }
    }

    private function consulta($sql, $param_array){

        try{

            $this -> consulta = $this->conexion->prepare($sql);

            if($param_array != null){

                foreach ($param_array as $clave => $valor){
                    $this->consulta->bindValue($clave, $valor);
                }

            }

            $this-> consulta -> execute();
        }catch (Exception $e){

			$codigo = $e->getCode();

			switch ($codigo) {

				case '42S02':
				case '1146':

					//Creamos las tablas, gracias a la función crear_tablas de la libreria control_db.
					crear_tablas();

					header('location:' . HTTP);

					break;

				default:

					require 'controladores/error.php';
		            $controlador = new error;
		            $controlador->db_consulta($e->getMessage());
					break;
			}

            exit();

            $this->consulta = 'failed';
        }

        return $this->consulta;

    }

    public function get_consulta( $sql, $param_array){

        $consulta = $this->consulta($sql, $param_array);
        return $consulta;
    }

    public function desconectar(){
        $this->conexion = null;
        $this->consulta->closeCursor();
        $this->consulta = null;
    }
}
