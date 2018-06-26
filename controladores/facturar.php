<?php

global $consultar; 

class facturar{
    
    public $vista = 'vistas/facturar/'; 
    
    public function index(){
        
        require $this->vista . 'index.php';
    }  

    public function factura($id){


        if($id == '0000'){

            require $this->vista . 'factura.php';
            return; 
        }
        require $this->vista . 'factura-creada.php';
    }
}