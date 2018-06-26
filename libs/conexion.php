<?php

class conexion{
    
    private $conexion;
    private $consulta;
    
    function __construct(){
        
        require ('modelos/config.php');
        
        try{
            
        $this->conexion = new PDO(DB_HOST, DB_USUARIO, DB_CONTRA);
            
        $this->conexion ->exec("SET CHARACTER SET ". DB_CHARSET);
            
        $this->conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(Exception $e){
            
        echo ("error conexion: " . $e->getMessage());
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
            
            echo ("error consulta: " . $e->getMessage());
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


