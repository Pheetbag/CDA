<?php

global $consultar; 

class main{
    
    public $vista = 'vistas/main/'; 
    public $modelo;
    
    public function index(){
        
        require $this->vista . 'index.php';
    }
    
}