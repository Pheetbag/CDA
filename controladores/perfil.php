<?php

global $consultar;

class perfil{

    public $vista = 'vistas/perfil/';

    public function index(){

		$this -> id($_SESSION['usuario']['id']);
    }

	public function id($id){

		global $consultar;
		if($id == null){ header('location:' . HTTP . '/perfil'); }

		$usuario = $consultar -> get($id);

		if($usuario == null){

			require 'controladores/error.php';
			$controlador = new error;
			$controlador->id_inexistente();
			exit();
		}

		switch ($usuario['rango']) {
			case 1:
				$usuario['rango_nombre'] = 'Administrador';
				$usuario['rango_desc'] = 'Acceso a todos las areas del sistema, incluyendo los espacios administrativos.';
				break;

			case 2:
				$usuario['rango_nombre'] = 'Operador';
				$usuario['rango_desc'] = 'Acceso a los sistemas de facturación, inventario y pedidos.';
				break;

			default:
				# code...
				break;
		}

        require $this->vista . 'index.php';
	}

	public function cambiar_contra(){

		global $consultar;
		if(!isset($_POST['antigua']) OR !isset($_POST['nueva'])){ header('location:' . HTTP . '/perfil'); }

		$usuario = $consultar -> validar($_POST['antigua'], $_SESSION['usuario']['id']);

		if($usuario == null){
			header('location:' . HTTP . '/perfil?err=contra');
		}else{

			$consultar -> cambiar_clave($_POST['nueva'], $_SESSION['usuario']['id']);
			header('location:' . HTTP . '/perfil?action=clave-cambiada');
		}
	}

}
