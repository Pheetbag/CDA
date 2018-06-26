<?php

global $consultar;

class registrar{

    public $vista = 'vistas/registrar/';

    public function index(){

        require $this->vista . 'index.php';
    }

    public function producto(){

        global $consultar;

        if(isset($_POST['nuevo-producto'])){

            $resultado = $consultar -> producto($_POST['nombre'], $_POST['tipo'], $_POST['marca'], $_POST['modelo'], $_POST['existencias'], $_POST['precio']);

            header('location:' . HTTP . '/inventario/producto/' . $resultado[0] . '?action=creado');
        }else{

            require $this->vista . 'producto.php';
        }

    }

    public function cliente(){

        global $consultar;

        if(isset($_POST['nuevo-cliente'])){

            $resultado = $consultar -> cliente($_POST['nombre'], $_POST['apellido'], $_POST['ci'], $_POST['direccion'], $_POST['telefono']);

            header('location:' . HTTP . '/facturar/cliente/' . $_POST['ci'] . '?action=creado');
        }else{

            require $this->vista . 'cliente.php';
        }
    }

    public function proveedor(){

        global $consultar;

        if(isset($_POST['nuevo-proveedor'])){

            $resultado = $consultar -> proveedor($_POST['nombre'], $_POST['telefono'], $_POST['rif'], $_POST['direccion']);

            header('location:' . HTTP . '/pedidos/proveedor/' . $resultado[0] . '?action=creado');
        }else{

            require $this->vista . 'proveedor.php';
        }
    }

    public function usuario(){

        require $this->vista . 'usuario.php';
    }

    public function factura($id){

        global $consultar;

		//Aqui guardamos todos los datos de el proceso de facturación para ser recuperados luego y agregarse como datos get en la consulta (este trabajo será realizado por la función datos_url)
        $datos = [
			'error'      => null,
            'ci'         => null,
            'fecha'      => date('Y-m-d'),
			'cliente'    => null,
			'productos'  => null,
			'cantidades' => null,
			'subtotal'   => 0
        ];

        if(isset($_GET['ci']))       {  $datos['ci']           = $_GET['ci']; }
        if(isset($_GET['fecha']))    {  $datos['fecha']        = $_GET['fecha']; }
        if(isset($_GET['err']))      {  $datos['error']        = $_GET['err']; }
		if(isset($_GET['producto'])) {  $datos['productos']    = $_GET['producto']; }
		if(isset($_GET['cantidad'])) {  $datos['cantidades']   = $_GET['cantidad']; }

        function datos_url($datos){

			//Esta función devuelve la url con los datos via get, para ser utilizados por la siguiente pagina. De esta forma recuperamos los datos ya declarados y los enviamos a la siguiente pagina (esta función será utilizada en la vista para todos los links de los botones a los que dirigirá la pagina)

			$url = '';

			if($datos['ci'] != null){

				$url .= 'ci=' . urlencode($datos['ci']);
			}

			if($datos['fecha'] != null){

				$url .= '&fecha=' . urlencode($datos['fecha']);
			}

			if($datos['productos'] != null){

				for ($i=0; $i < count($datos['productos']); $i++) {

					$url .= '&producto[]=' . urlencode($datos['productos'][$i]);
				}

			}

			if($datos['cantidades'] != null){

				for ($i=0; $i < count($datos['cantidades']); $i++) {

					$url .= '&cantidad[]=' . urlencode($datos['cantidades'][$i]);
				}
			}
			return $url;

        }

		switch ($id) {

			case null:

				header('location:' . HTTP . '/registrar/factura/paso-1');
				break;

			case 'paso-1':

				//consultamos al cliente si esta definido
				if($datos['ci'] != null){

					$datos['cliente'] = $consultar->get('cliente', $datos['ci']);
				}

				//Requerimos la vista.
				require $this->vista . 'factura-1.php';
				break;

			case 'validar-cliente':

				if(!isset($_POST['ci']) AND $datos['ci'] == null){
					header('location:' . HTTP . '/registrar/factura/');
				}
				else if(isset($_POST['ci'])){

					$datos['ci'] = $_POST['ci'];
					$datos['fecha'] = $_POST['fecha'];
				}

				if($consultar->get('cliente', $datos['ci']) != null){

					header('location:' . HTTP . '/registrar/factura/paso-2?' . datos_url($datos));
				}else{

					//print_r(datos_url($datos));

					header('location:' . HTTP . '/registrar/factura/paso-1?err=cliente&' . datos_url($datos));
				}
				break;

			case 'registrar-cliente':

				if($datos['ci'] == null OR !isset($_POST['nombre']) OR !isset($_POST['apellido']) OR !isset($_POST['dir']) OR !isset($_POST['tlf'])){

					header('location:' . HTTP . '/registrar/factura/paso-1?err=cliente&' . datos_url($datos));
				}

				$consultar->cliente($_POST['nombre'], $_POST['apellido'], $datos['ci'], $_POST['dir'], $_POST['tlf']);
				header('location:' . HTTP . '/registrar/factura/validar-cliente?' . datos_url($datos));
				break;

			case 'paso-2':

				if($datos['ci'] == null){
					header('location:' . HTTP . '/registrar/factura/paso-1?'. datos_url($datos));
				}
				$datos['cliente'] = $consultar->get('cliente', $datos['ci']);
				require $this->vista . 'factura-2.php';
				break;

			case 'agregar-producto':

				if(!isset($_POST['codigo']) OR !isset($_POST['cantidad'])){
					header('location:' . HTTP . '/registrar/factura/paso-2?'. datos_url($datos));
				}

				$productos_cantidad = count($datos['productos']);
				$producto_repetido  = false;

				for ($i=0; $i < $productos_cantidad; $i++) {

					if($datos['productos'][$i] == $_POST['codigo']){

						$producto_repetido = true;
						header('location:' . HTTP . '/registrar/factura/paso-2?err=repetido&datacodigo='. $_POST['codigo'] .'&dataext='. $_POST['cantidad'] .'&'. datos_url($datos));
						break;
					}
				}


				if($producto_repetido == false){

					$resultado = $consultar-> get('producto', $_POST['codigo']);

					if($resultado == null){

						header('location:' . HTTP . '/registrar/factura/paso-2?err=producto&datacodigo='. $_POST['codigo'] .'&dataext='. $_POST['cantidad'] .'&'. datos_url($datos));
					}

					else if($resultado['existencias'] < $_POST['cantidad']){

						header('location:' . HTTP . '/registrar/factura/paso-2?err=existencia&errext='. $resultado['existencias'] . '&datacodigo='. $_POST['codigo'] .'&dataext='. $_POST['cantidad'] .'&'. datos_url($datos));
					}else{

						$datos['productos'][] = $_POST['codigo'];
						$datos['cantidades'][] = $_POST['cantidad'];

						header('location:' . HTTP . '/registrar/factura/paso-2?'. datos_url($datos));
					}

				}

				break;

			case 'eliminar-producto':

				if(!isset($_GET['eliminar'])){

					header('location:' . HTTP . '/registrar/factura/paso-2?'. datos_url($datos));
				}

				unset($datos['productos'][$_GET['eliminar']]);
				unset($datos['cantidades'][$_GET['eliminar']]);

				$datos['productos']  = array_values($datos['productos']);
				$datos['cantidades'] = array_values($datos['cantidades']);

				header('location:' . HTTP . '/registrar/factura/paso-2?'. datos_url($datos));
				break;

			case 'editar-producto':

				if(!isset($_POST['editar'])){

					header('location:' . HTTP . '/registrar/factura/paso-2?'. datos_url($datos));
				}

				$datos['cantidades'][$_POST['id']] = $_POST['editar'];

				header('location:' . HTTP . '/registrar/factura/paso-2?'. datos_url($datos));
				break;
		}

    }

    public function pedido($id){

        global $consultar;

		//Aqui guardamos todos los datos de el proceso de facturación para ser recuperados luego y agregarse como datos get en la consulta (este trabajo será realizado por la función datos_url)
        $datos = [
            'rif'          => null,
            'fecha'        => date('Y-m-d'),
            'llegada'      => date('Y-m-d'),
			'proveedor'    => null,
			'productos'    => null,
			'cantidades'   => null,
			'costos'       => null,
			'precios'      => null,
			'subtotal'     => 0
        ];

        if(isset($_GET['rif']))      {  $datos['rif']          = $_GET['rif']; }
        if(isset($_GET['fecha']))    {  $datos['fecha']        = $_GET['fecha']; }
		if(isset($_GET['llegada']))  {  $datos['llegada']      = $_GET['llegada']; }
		if(isset($_GET['producto'])) {  $datos['productos']    = $_GET['producto']; }
		if(isset($_GET['cantidad'])) {  $datos['cantidades']   = $_GET['cantidad']; }
		if(isset($_GET['costo']))    {  $datos['costos']       = $_GET['costo']; }
		if(isset($_GET['precio']))   {  $datos['precios']      = $_GET['precio']; }

        function datos_url($datos){

			//Esta función devuelve la url con los datos via get, para ser utilizados por la siguiente pagina. De esta forma recuperamos los datos ya declarados y los enviamos a la siguiente pagina (esta función será utilizada en la vista para todos los links de los botones a los que dirigirá la pagina)

			$url = '';

			if($datos['rif'] != null){

				$url .= 'rif=' . urlencode($datos['rif']);
			}

			if($datos['fecha'] != null){

				$url .= '&fecha=' . urlencode($datos['fecha']);
			}

			if($datos['llegada'] != null){

				$url .= '&llegada=' . urlencode($datos['llegada']);
			}

			if($datos['productos'] != null){


				for ($i=0; $i < count($datos['productos']); $i++) {

					$url .= '&producto[]=' . urlencode($datos['productos'][$i]);
				}

			}

			if($datos['cantidades'] != null){

				for ($i=0; $i < count($datos['cantidades']); $i++) {

					$url .= '&cantidad[]=' . urlencode($datos['cantidades'][$i]);
				}
			}


			if($datos['costos'] != null){


				for ($i=0; $i < count($datos['costos']); $i++) {

					$url .= '&costo[]=' . urlencode($datos['costos'][$i]);
				}
			}

			if($datos['precios'] != null){


				for ($i=0; $i < count($datos['precios']); $i++) {

					$url .= '&precio[]=' . urlencode($datos['precios'][$i]);
				}
			}
			return $url;

        }

		switch ($id) {

			case null:

				header('location:' . HTTP . '/registrar/pedido/paso-1');
				break;

			case 'paso-1':

				//consultamos al cliente si esta definido
				if($datos['rif'] != null){

					$datos['proveedor'] = $consultar->get('proveedor', $datos['rif']);
				}

				//Requerimos la vista.
        		require $this->vista . 'pedido-1.php';
				break;

			case 'validar-proveedor':


				if(!isset($_POST['rif']) AND $datos['rif'] == null){
					header('location:' . HTTP . '/registrar/proveedor/');

				}
				else if(isset($_POST['rif'])){

					$datos['rif']     = $_POST['rif'];
					$datos['fecha']   = $_POST['fecha'];
					$datos['llegada'] = $_POST['llegada'];

				}

				if($consultar->get('proveedor', $datos['rif']) != null){

					header('location:' . HTTP . '/registrar/pedido/paso-2?' . datos_url($datos));
				}else{

					header('location:' . HTTP . '/registrar/pedido/paso-1?error=proveedor&' . datos_url($datos));
				}

				break;

			case 'registrar-proveedor':

				if($datos['rif'] == null OR !isset($_POST['nombre']) OR !isset($_POST['dir']) OR !isset($_POST['tlf'])){

					header('location:' . HTTP . '/registrar/pedido/paso-1?error=proveedor&' . datos_url($datos));
				}

				$consultar->proveedor($_POST['nombre'], $_POST['tlf'], $datos['rif'], $_POST['dir']);
				header('location:' . HTTP . '/registrar/pedido/validar-proveedor?' . datos_url($datos));
				break;

			case 'paso-2':

				if($datos['rif'] == null){
					header('location:' . HTTP . '/registrar/pedido/paso-1?'. datos_url($datos));
				}
				$datos['proveedor'] = $consultar->get('proveedor', $datos['rif']);
				require $this->vista . 'pedido-2.php';
				break;

			case 'agregar-producto':

				if(!isset($_POST['codigo']) OR !isset($_POST['cantidad']) OR !isset($_POST['costo'])){
					header('location:' . HTTP . '/registrar/pedido/paso-2?'. datos_url($datos));
				}

				$productos_cantidad = count($datos['productos']);
				$producto_repetido  = false;

				for ($i=0; $i < $productos_cantidad; $i++) {

					if($datos['productos'][$i] == $_POST['codigo']){

						$producto_repetido = true;
						header('location:' . HTTP . '/registrar/pedido/paso-2?err=repetido&datacodigo='. $_POST['codigo'] .'&dataext='. $_POST['cantidad'] .'&datacost='. $_POST['costo'] .'&'. datos_url($datos));
						break;
					}
				}


				if($producto_repetido == false){

					$resultado = $consultar-> get('producto', $_POST['codigo']);

					if($resultado == null){

						header('location:' . HTTP . '/registrar/pedido/paso-2?err=producto&datacodigo='. $_POST['codigo'] .'&dataext='. $_POST['cantidad'] .'&datacost='. $_POST['costo'] .'&'. datos_url($datos));

					}else{

						$datos['productos'][]  = $_POST['codigo'];
						$datos['cantidades'][] = $_POST['cantidad'];
						$datos['costos'][]     = $_POST['costo'];
						$datos['precios'][]    = $resultado['precio_venta'];
						header('location:' . HTTP . '/registrar/pedido/paso-2?'. datos_url($datos));
					}

				}

				break;

			case 'eliminar-producto':

				if(!isset($_GET['eliminar'])){

					header('location:' . HTTP . '/registrar/pedido/paso-2?'. datos_url($datos));
				}

				unset($datos['productos']  [$_GET['eliminar']]);
				unset($datos['cantidades'] [$_GET['eliminar']]);
				unset($datos['costos']     [$_GET['eliminar']]);
				unset($datos['precios']    [$_GET['eliminar']]);

				$datos['productos']  = array_values($datos['productos']);
				$datos['cantidades'] = array_values($datos['cantidades']);
				$datos['costos']     = array_values($datos['costos']);
				$datos['precios']    = array_values($datos['precios']);

				header('location:' . HTTP . '/registrar/pedido/paso-2?'. datos_url($datos));
				break;

			case 'editar-producto':

				if(!isset($_POST['editar'])){

					header('location:' . HTTP . '/registrar/pedido/paso-2?'. datos_url($datos));
				}

				$datos['cantidades'][$_POST['id']] = $_POST['cantidad'];
				$datos['costos'][$_POST['id']]     = $_POST['costo'];
				$datos['precios'][$_POST['id']]    = $_POST['precio'];
				
				header('location:' . HTTP . '/registrar/pedido/paso-2?'. datos_url($datos));
				break;
		}

    }

}
