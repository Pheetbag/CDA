<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header('facturar','Facturación'); ?>

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

						$ci_div   = explode('-', $facturas[$i]['ci_cliente']);
						$ci       = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

						$total    = number_format( $facturas[$i]['total'] ,2,',', '.');
						$nombre   = ucwords($facturas[$i]['nombre_cliente'] . ' ' . $facturas[$i]['apellido_cliente']);
						$cantidad = number_format( $facturas[$i]['cantidad_productos'] ,0,',', ' ');

						echo'
						<a href="'. HTTP .'/facturar/f/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
	                        <div class="row">
	                            <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
	                                <div class="font-weight-bold">'. $nombre .'</div>
	                                <div>'. $ci .'</div>
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
                        <a class="page-link" href="<?php echo HTTP ?>/facturar/todas">Ver todos</a>
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

						$ci_div   = explode('-', $clientes[$i]['ci_cliente']);
						$ci       = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

						$direccion = $clientes[$i]['direccion_cliente'];
						$telefono  = $clientes[$i]['telefono'];

						$codigo = $clientes[$i]['ci_cliente'];


						echo'
						<a href="'. HTTP .'/facturar/cliente/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">'. $nombre .'</div>
                                    <div>'. $ci .'</div>
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
                        <a class="page-link" href="<?php echo HTTP ?>/facturar/clientes">Ver todos</a>
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

            <div class="card mb-4">
                <h6 class="card-header">Buscar factura</h6>
                <form novalidate method="POST" action="<?php echo HTTP ?>/facturar/buscar/factura" class="card-body validar">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">#</span>
						</div>
                        <input required type="number" name="busqueda" class="form-control" placeholder="Codigo">
						<div class="invalid-feedback">
						  Ingrese el codigo de factura a buscar.
						</div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 btn-block">Buscar</button>
                </form>
            </div>

			<div class="card mb-4">
                <h6 class="card-header">Buscar cliente</h6>
                <form novalidate method="POST" action="<?php echo HTTP ?>/facturar/buscar/cliente" class="card-body validar">
                    <div class="form-group row">

						<select required class="form-control col-3 col-sm-2 col-md-4 col-xl-3 ml-3 mr-1" name="ci-prefijo">
							<option selected value="V">V</option>
							<option value="E">E</option>
						</select>
						<div class="col mr-3 px-0">
							<input required type="number" name="busqueda" id="" class="form-control" placeholder="Cédula">
							<div class="invalid-feedback">
							  Ingrese la cédula del cliente a buscar.
							</div>
						</div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 btn-block">Buscar</button>
                </form>
            </div>
        </div>

    </div>
</main>

<?php include_footer(); ?>
