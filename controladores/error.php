<?php

class error{

    public $vista = 'vistas/error/';

    public function controlador(){

        require $this->vista . 'controlador.php';
    }

    public function metodo($controlador){

        require $this->vista . 'metodo.php';
    }

    public function max_param(){

        require $this->vista . 'max_param.php';
    }

	public function id_inexistente(){

        require $this->vista . 'id_inexistente.php';
	}
}
