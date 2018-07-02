<?php

global $consultar;

class facturar{

    public $vista = 'vistas/facturar/';

    public function index(){

		global $consultar;

		$facturas = $consultar -> facturas_resumen();
		$clientes = $consultar -> clientes_resumen();

        require $this->vista . 'index.php';
    }

    public function f($id){

		global $consultar;

		$factura  = $consultar -> factura($id);
		$detalles = $consultar -> detalles($id);

        require $this->vista . 'factura.php';
    }
}
