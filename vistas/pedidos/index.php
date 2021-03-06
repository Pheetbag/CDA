<?php include_head('CDA - Pedidos'); ?>

</head>
<body>

<?php include_header('pedidos','Pedidos'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="card mb-4">
                <h6 class="card-header">Ultimos pedidos</h6>
                <ul class="list-group list-group-flush">

				<?php

				if ($pedidos == null) {

					echo'

						<div class="card-body center font-weight-bold text-center">
							<div class="ico-no-resultados"></div>
							No se han encontrado resultados.
						</div>

					';
				}else{

					$cantidad_pedidos = count($pedidos);

					for ($i=0; $i < $cantidad_pedidos; $i++) {

						$codigo    = $pedidos[$i]['codigo_pedido'];
						$fecha     = date('d/m/Y',strtotime($pedidos[$i]['fecha']));
						$llegada   = date('d/m/Y',strtotime($pedidos[$i]['fecha_llegada']));

						$rif_div   = explode('-', $pedidos[$i]['codigo_proveedor']);
						$rif       = $rif_div[0] . '-' . number_format( $rif_div[1] ,0, ',','.');

						$total     = number_format( $pedidos[$i]['subtotal'] ,2,',', '.');
						$nombre    = $pedidos[$i]['nombre_empresa'];
						$cantidad  = number_format( $pedidos[$i]['cantidad_productos'] ,0,',', ' ');

						echo '

						<a href="'.   HTTP.'/pedidos/p/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
							<div class="row">
								<div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
									<div class="font-weight-bold">'. $nombre .'</div>
									<div>'. $rif .'</div>
									<div>Pedido #'. $codigo .'</div>
								</div>
								<div class="col-6 col-sm-4 d-flex flex-column justify-content-around">
									<div class="text-muted">Emitido: '. $fecha .'</div>
									<div class="text-muted">Llegada: '. $llegada .'</div>
								</div>
								<div class="col-6 col-sm-4 d-flex flex-column justify-content-around">
									<div class="producto-precio text-success font-weight-bold">Total Bs.S '. $total .'</div>
									<div class="producto-existencias text-muted">Productos adquiridos: '. $cantidad .'</div>
								</div>
							</div>
						</a>

						';
					}

				}

				?>

                </ul>

                <div class="card-footer text-muted text-center">
					<ul class="pagination justify-content-center m-0">
                        <li class="page-item">
                        <a class="page-link" href="<?php echo HTTP ?>/pedidos/todos">Ver todos</a>
                        </li>
                    </ul>
                </div>
            </div>

			<div class="card mb-4">
                <h6 class="card-header">Proveedores</h6>
                <ul class="list-group list-group-flush">

				<?php

				if ($proveedores == null) {

					echo'

						<div class="card-body center font-weight-bold text-center">
							<div class="ico-no-resultados"></div>
							No se han encontrado resultados.
						</div>

					';
				}else{

					$cantidad_proveedores = count($proveedores);

					for ($i=0; $i < $cantidad_proveedores; $i++) {

						$nombre    = $proveedores[$i]['nombre_empresa'];
						$codigo    = $proveedores[$i]['rif'];
						$rif_div   = explode('-', $proveedores[$i]['rif']);
						$rif       = $rif_div[0] . '-' . number_format( $rif_div[1] ,0, ',','.');
						$direccion = $proveedores[$i]['direccion'];
						$telefono  = $proveedores[$i]['telefono'];


						echo'
						<a href="'. HTTP .'/pedidos/proveedor/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">'. $nombre .'</div>
                                    <div>'. $rif .'</div>
                                </div>
                                <div class="col-6 col-sm-4 d-flex align-items-center flex-column justify-content-around align-items-end">
                                    <div class="text-muted">'. $direccion .'</div>

                                </div>
                                <div class="col-6 col-sm-4 d-flex align-items-center flex-column justify-content-around align-items-end">
                                    <div class="text-muted">'. $telefono .'</div>
                                </div>
                            </div>
                        </a>
						';

					}

				}

				 ?>

                </ul>

                <div class="card-footer text-muted text-center">
					<ul class="pagination justify-content-center m-0">
                        <li class="page-item">
                        <a class="page-link" href="<?php echo HTTP ?>/pedidos/proveedores">Ver todos</a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="col-md-3 col-sm-12 mb-4">

			<?php

			if($_SESSION['usuario']['rango'] < 3) {

				echo '

				<div class="card mb-4">
	                <h6 class="card-header">Registrar</h6>
	                <div class="card-body">
	                    <a class="btn btn-primary mt-3 d-block" href="'. HTTP .'/registrar/proveedor">Nuevo proveedor</a>
	                    <a class="btn btn-primary mt-3 d-block" href="'. HTTP .'/registrar/pedido">Nuevo pedido</a>
	                </div>
	            </div>
				';
			}

			?>


			<div class="card mb-4">
                <h6 class="card-header">Buscar pedido</h6>
                <form  novalidate method="post" action="<?php echo HTTP ?>/pedidos/buscar/pedido" class="card-body validar">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">#</span>
						</div>
                        <input required type="number" name="busqueda" class="form-control" placeholder="Codigo">
						<div class="invalid-feedback">
						  Ingrese el codigo de pedido a buscar.
						</div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 btn-block">Buscar</button>
                </form>
            </div>

            <div class="card">
                <h6 class="card-header">Buscar proveedor</h6>
                <form novalidate method="post" action="<?php echo HTTP ?>/pedidos/buscar/proveedor" class="card-body validar">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">J-</span>
						</div>
                        <input required type="number" name="busqueda" class="form-control" placeholder="Rif">
						<div class="invalid-feedback">
						  Ingrese el rif del proveedor a buscar.
						</div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 btn-block" href="#">Buscar</button>
                </form>
            </div>
        </div>


    </div>
</main>

<?php include_footer(); ?>
