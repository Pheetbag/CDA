<?php

global $consultar;

class pedidos{

    public $vista = 'vistas/pedidos/';

    public function index(){

		global $consultar;

		$pedidos     = $consultar -> pedidos_resumen();
		$proveedores = $consultar -> proveedores_resumen();
        require $this->vista . 'index.php';
    }

    public function p($id){

		global $consultar;

		$pedido  = $consultar -> pedido($id);
		$detalles = $consultar -> detalles($id);

        require $this->vista . 'pedido.php';
    }
}
