<?php include_head('CDA - Pedidos'); ?>

</head>
<body>

<?php include_header(2,'Pedidos'); ?>

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
						$rif       = $pedidos[$i]['codigo_proveedor'];
						$total     = $pedidos[$i]['total'];
						$nombre    = $pedidos[$i]['nombre_empresa'];
						$cantidad  = $pedidos[$i]['cantidad_productos'];

						echo '

						<a href="'.   HTTP.'/pedidos/p/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
							<div class="row">
								<div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
									<div class="font-weight-bold">'. $nombre .'</div>
									<div>J-'. $rif .'</div>
									<div>Pedido #'. $codigo .'</div>
								</div>
								<div class="col-6 col-sm-4 d-flex flex-column justify-content-around">
									<div class="text-muted">Emitido: '. $fecha .'</div>
									<div class="text-muted">Llegada: '. $llegada .'</div>
								</div>
								<div class="col-6 col-sm-4 d-flex flex-column justify-content-around">
									<div class="producto-precio text-success font-weight-bold">Total Bs. '. $total .'</div>
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
                        <a class="page-link" href="#">Ver todos</a>
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
						$codigo    = $proveedores[$i]['codigo_proveedor'];
						$rif       = $proveedores[$i]['rif'];
						$direccion = $proveedores[$i]['direccion'];
						$telefono  = $proveedores[$i]['telefono'];


						echo'
						<a href="'. HTTP .'/pedido/proveedor/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">'. $nombre .'</div>
                                    <div>J-'. $rif .'</div>
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
                        <a class="page-link" href="#">Ver todos</a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="col-md-3 col-sm-12 mb-4">

            <div class="card mb-4">
                <h6 class="card-header">Registrar</h6>
                <div class="card-body">
                    <a class="btn btn-primary mt-3 d-block" href="<?php echo HTTP ?>/registrar/proveedor">Nuevo proveedor</a>
                    <a class="btn btn-primary mt-3 d-block" href="<?php echo HTTP ?>/registrar/pedido">Nuevo pedido</a>
                </div>
            </div>
<!--

ELIMINADO TEMPORALMENTE EN VISTA DE QUE NO ME DARÁ TIEMPO DE PONERLO A FUNCIONAR

            <div class="card mb-4">
                <h6 class="card-header">Buscar pedido</h6>
                <form class="card-body">
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Codigo">
                    </div>
                    <a class="btn btn-primary mt-3 d-block" href="#">Buscar</a>
                </form>
            </div>

            <div class="card">
                <h6 class="card-header">Buscar proveedor</h6>
                <form class="card-body">
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Rif">
                    </div>
                    <a class="btn btn-primary mt-3 d-block" href="#">Buscar</a>
                </form>
            </div>
        </div>
-->
    </div>
</main>

<?php include_footer(); ?>
