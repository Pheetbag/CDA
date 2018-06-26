<?php

global $consultar; 

class pedidos{
    
    public $vista = 'vistas/pedidos/'; 
    
    public function index(){
        
        require $this->vista . 'index.php';
    }  

    public function pedido($id){

        if($id == '0000'){
            require $this->vista . 'pedido.php';   
            return;
        }

        require $this->vista . 'pedido-creado.php';
    }
}