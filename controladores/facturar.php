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

		if($factura == null){

			require 'controladores/error.php';
			$controlador = new error;
			$controlador->id_inexistente();
			exit();
		}

		$detalles = $consultar -> detalles($id);

        require $this->vista . 'factura.php';
    }

	public function todas($pagina){

		global $consultar;
		if($pagina == null){ $pagina = '1';}

		$limite = 16;

		$facturas   = $consultar -> facturas($limite, $pagina);
		$paginacion = $consultar -> facturas_total();

		//Calculamos la cantidad de paginas que se necesitan.
		$paginacion = ceil($paginacion['total'] / $limite);

		$siguiente = null; $siguiente_link = $pagina + 1;
		$anterior  = null; $anterior_link  = $pagina - 1;

		if($pagina - 1 == 0){

			$anterior      = 'disabled';
			$anterior_link = '#';
		}

		if($pagina + 1 > $paginacion){

			$siguiente      = 'disabled';
			$siguiente_link = '#';
		}

		require $this->vista . 'facturas.php';

	}

	public function clientes($pagina){


		global $consultar;
		if($pagina == null){ $pagina = '1';}

		$limite = 16;

		$clientes   = $consultar -> clientes($limite, $pagina);
		$paginacion = $consultar -> clientes_total();

		//Calculamos la cantidad de paginas que se necesitan.
		$paginacion = ceil($paginacion['total'] / $limite);

		$siguiente = null; $siguiente_link = $pagina + 1;
		$anterior  = null; $anterior_link  = $pagina - 1;

		if($pagina - 1 == 0){

			$anterior      = 'disabled';
			$anterior_link = '#';
		}

		if($pagina + 1 > $paginacion){

			$siguiente      = 'disabled';
			$siguiente_link = '#';
		}

		require $this->vista . 'clientes.php';

	}

	public function cliente($id){

		global $consultar;
		$resultado   = $consultar -> cliente($id);

		if($resultado == null){

			require 'controladores/error.php';
			$controlador = new error;
			$controlador->id_inexistente();
			exit();
		}

		$movimientos = $consultar -> movimientos($id);

		require $this->vista . 'cliente.php';
	}

	public function buscar($tipo){

		global $consultar;

		switch ($tipo) {
			case 'factura':
				if(!isset($_POST['busqueda'])){ header('location:' . HTTP . '/facturar/todas');}
				$_POST['busqueda'] = str_replace([',', '.', '-', '+', 'e'], '', $_POST['busqueda']);

				$resultado = $consultar -> factura($_POST['busqueda']);

				if($resultado == null){
					header('location:' . HTTP . '/facturar/todas?err=busqueda&busqueda=' . $_POST['busqueda']);
				}else{

					header('location:' . HTTP . '/facturar/f/' . $_POST['busqueda']);
				}

				break;

			case 'cliente':
				if(!isset($_POST['busqueda'])){ header('location:' . HTTP . '/facturar/clientes');}
				$_POST['busqueda'] = str_replace([',', '.', '-', '+', 'e'], '', $_POST['busqueda']);

				$ci_cliente = $_POST['ci-prefijo'] . '-' . $_POST['busqueda'];
				$resultado = $consultar -> cliente($ci_cliente);

				if($resultado == null){
					header('location:' . HTTP . '/facturar/clientes?err=busqueda&busqueda=' . $ci_cliente);
				}else{

					header('location:' . HTTP . '/facturar/cliente/' . $ci_cliente);
				}

				break;

			default:

				header('location:' . HTTP . '/facturar');
				exit();
				break;
		}
	}
}
