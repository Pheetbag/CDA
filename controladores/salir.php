<?php

global $consultar; 

class salir{
    
    public $vista = 'vistas/'; 
    
    public function index(){
        
        session_destroy();
        header('location:'. HTTP . '/entrar');
    }

}