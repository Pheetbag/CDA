<?php

global $consultar;

class inventario{

    public $vista = 'vistas/inventario/';

    public function index($pagina = 1){

        global $consultar;

        $limite     = 16;

        $resultado  = $consultar -> productos($limite, $pagina);
        $paginacion = $consultar -> productos_total();

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

        require $this->vista . 'index.php';
    }

    public function pag($pagina){

        //si no se definio una id, envia a la pagina principal, en caso de que si se definiera una id, llamará al metodo index, usando la id de la pagina.
        if($pagina == null){
            header('location:'. HTTP . '/inventario');
        }else{
            $this -> index($pagina);
        }
    }


    public function producto($id){

        global $consultar;

        $resultado   = $consultar -> producto($id);

		if($resultado == null){

			require 'controladores/error.php';
			$controlador = new error;
			$controlador->id_inexistente();
			exit();
		}

		$movimientos = $consultar -> producto_movimientos($id);
        //verificamos si se desea realizar alguna acción con este producto, de no ser asi mostramos la vista por defecto
        //sino, dependiendo de la accion mostramos la vista de esa accion
        if(isset($_GET['action'])){

            switch ($_GET['action']) {

                case 'editar':
                    require $this->vista . 'producto-editar.php';
                    break;

                case 'eliminar':
                    $consultar -> producto_eliminar($id);
                    require $this->vista . 'producto-eliminado.php';
                    break;

                case 'guardar':

                    if(isset($_POST['nombre'])){
                        $consultar -> producto_actualizar($id, $_POST['nombre'], $_POST['tipo'], $_POST['marca'],$_POST['modelo'], $_POST['existencias'], $_POST['precio']);

                        $resultado = $consultar -> producto($id);
                        require $this->vista . 'producto-actualizado.php';

                    }else{

                        header('location:' . HTTP . '/inventario/producto/' . $id);
                    }
                    break;

                case 'creado':

	                require $this->vista . 'producto-creado.php';
	                break;

                default:

                    require $this->vista . 'producto.php';
                    break;
            }

        }else{

            require $this->vista . 'producto.php';
        }
    }

    public function buscar($id){

        if($id == null){ $id = 1; }
        if(!isset($_GET['busqueda']) OR is_null($_GET['busqueda']) OR $_GET['busqueda'] == ''){ header('location:'. HTTP . '/inventario'); }

        global $consultar;

        $busqueda = $_GET['busqueda'];
        $busqueda_url = urlencode($_GET['busqueda']);
        $query = transformar_regexp($_GET['busqueda']);

        $pagina     = $id;
        $limite     = 25;

        $resultado  = $consultar -> buscar($query,$limite, $pagina);
        $paginacion = $consultar -> buscar_total($query);

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

        $resultado_min = 1 + ($pagina - 1) * $limite;
        $resultado_max = 25 + ($pagina - 1) * $limite;

        require $this->vista . 'buscar.php';
    }
}
