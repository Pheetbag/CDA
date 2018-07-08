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

		if($pedido == null){

			require 'controladores/error.php';
			$controlador = new error;
			$controlador->id_inexistente();
			exit();
		}

		$detalles = $consultar -> detalles($id);

        require $this->vista . 'pedido.php';
    }

	public function todos($pagina){

		global $consultar;
		if($pagina == null){ $pagina = '1';}

		$limite = 16;

		$pedidos    = $consultar -> pedidos($limite, $pagina);
		$paginacion = $consultar -> pedidos_total();

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

		require $this->vista . 'pedidos.php';

	}

	public function proveedores($pagina){


		global $consultar;
		if($pagina == null){ $pagina = '1';}

		$limite = 16;

		$proveedores = $consultar -> proveedores($limite, $pagina);
		$paginacion  = $consultar -> proveedores_total();

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

		require $this->vista . 'proveedores.php';

	}

	public function proveedor($id){

		global $consultar;
        $resultado   = $consultar -> proveedor($id);

		if($resultado == null){

			require 'controladores/error.php';
			$controlador = new error;
			$controlador->id_inexistente();
			exit();
		}

		$movimientos = $consultar -> movimientos($resultado['rif']);

		require $this->vista . 'proveedor.php';
	}

	public function buscar($tipo){


		global $consultar;

		switch ($tipo) {
			case 'pedido':
				if(!isset($_POST['busqueda'])){ header('location:' . HTTP . '/pedidos/todos');}
				$_POST['busqueda'] = str_replace([',', '.', '-', '+', 'e'], '', $_POST['busqueda']);

				$resultado = $consultar -> pedido($_POST['busqueda']);

				if($resultado == null){
					header('location:' . HTTP . '/pedidos/todos?err=busqueda&busqueda=' . $_POST['busqueda']);
				}else{

					header('location:' . HTTP . '/pedidos/p/' . $_POST['busqueda']);
				}

				break;

			case 'proveedor':
				if(!isset($_POST['busqueda'])){ header('location:' . HTTP . '/pedidos/proveedores');}
				$_POST['busqueda'] = str_replace([',', '.', '-', '+', 'e'], '', $_POST['busqueda']);

				$rif_proveedor = 'J-' . $_POST['busqueda'];
				$resultado = $consultar -> proveedor($rif_proveedor);

				if($resultado == null){
					header('location:' . HTTP . '/pedidos/proveedores?err=busqueda&busqueda=' . $rif_proveedor);
				}else{

					header('location:' . HTTP . '/pedidos/proveedor/' . $resultado['rif']);
				}

				break;

			default:

				header('location:' . HTTP . '/pedidos');
				exit();
				break;
		}
	}

}
