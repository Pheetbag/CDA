<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header(1,'Facturación'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="card mb-4">
                <h6 class="card-header">Ultimas facturas</h6>
                <ul class="list-group list-group-flush">

				<?php

				if ($facturas == null) {

					echo'

						<div class="card-body center font-weight-bold text-center">
							<div class="ico-no-resultados"></div>
							No se han encontrado resultados.
						</div>

					';
				}else{

					$cantidad_facturas = count($facturas);

					for ($i=0; $i < $cantidad_facturas; $i++) {

						$codigo   = $facturas[$i]['codigo_factura'];
						$fecha    = date('d/m/Y',strtotime($facturas[$i]['fecha_venta']));
						$ci       = $facturas[$i]['ci_cliente'];
						$total    = $facturas[$i]['total'];
						$nombre   = ucwords($facturas[$i]['nombre_cliente'] . ' ' . $facturas[$i]['apellido_cliente']);
						$cantidad = $facturas[$i]['cantidad_productos'];

						echo'
						<a href="'. HTTP .'/facturar/f/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
	                        <div class="row">
	                            <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
	                                <div class="font-weight-bold">'. $nombre .'</div>
	                                <div>V-'. $ci .'</div>
	                            </div>
	                            <div class="col-6 col-sm-4 left align-items-center align-items-sm-end">
	                                <div class="text-muted">Factura #'. $codigo .'</div>
	                                <div class="text-muted">Emitido: '. $fecha .'</div>
	                            </div>
	                            <div class="col-6 col-sm-4 right align-items-center">
	                                <div class="producto-precio text-success font-weight-bold">Total Bs. '. $total .'</div>
	                                <div class="producto-existencias text-muted">Productos vendidos: '. $cantidad .'</div>
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
                <h6 class="card-header">Clientes</h6>
                <ul class="list-group list-group-flush">

				<?php

				if ($clientes == null) {

					echo'

						<div class="card-body center font-weight-bold text-center">
							<div class="ico-no-resultados"></div>
							No se han encontrado resultados.
						</div>

					';
				}else{

					$cantidad_clientes = count($clientes);

					for ($i=0; $i < $cantidad_clientes; $i++) {

						$nombre    = ucwords($clientes[$i]['nombre_cliente'] . ' ' . $clientes[$i]['apellido_cliente']);
						$ci        = $clientes[$i]['ci_cliente'];
						$direccion = $clientes[$i]['direccion_cliente'];
						$telefono  = $clientes[$i]['telefono'];


						echo'
						<a href="'. HTTP .'/facturar/cliente/'. $ci .'" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">'. $nombre .'</div>
                                    <div>V-00.000.000</div>
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
                    <a class="btn btn-primary mt-3 d-block" href="<?php echo HTTP ?>/registrar/cliente">Nuevo cliente</a>
                    <a class="btn btn-primary mt-3 d-block" href="<?php echo HTTP ?>/registrar/factura">Nueva factura</a>
                </div>
            </div>
<!--

ELIMINADO TEMPORALMENTE EN VISTA DE QUE NO LO PODRÉ TERMINAR

            <div class="card mb-4">
                <h6 class="card-header">Buscar factura</h6>
                <form class="card-body">
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Codigo">
                    </div>
                    <a class="btn btn-primary mt-3 d-block" href="#">Buscar</a>
                </form>
            </div>

            <div class="card">
                <h6 class="card-header">Buscar cliente</h6>
                <form class="card-body">
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Cédula">
                    </div>
                    <a class="btn btn-primary mt-3 d-block" href="#">Buscar</a>
                </form>
            </div>
        </div>
-->
    </div>
</main>

<?php include_footer(); ?>
