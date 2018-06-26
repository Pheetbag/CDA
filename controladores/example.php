<?php

global $consultar; 

class example{
    
    public $vista = 'vistas/example/'; 
    
    function __construct(){
        
        //El uso de el constructor para imprimir estas estructuras se encuentra ahora depreciado pues puede dar errores en casos en los que intenta imprimir datos antes de enviar los headers por lo que el uso de estas funciones debe hacerse manualmente en cada vista.

        //Aqui vamos a llamar al controlador de las vistas de la cabecera y otros elementos comunes a todo el sistema.
        include_head('CDA - Example');
        include_header(0, 'Example');

    }
    
    public function index(){
        
        require $this->vista . 'index.php';
    }
    
    public function other($id = null){
        
        require $this->vista . 'other.php';
    }
    
}