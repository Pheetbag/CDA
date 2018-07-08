<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header('facturar','Facturación', 'Todas'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

	<?php

	if(isset($_GET['err']) AND $_GET['err'] == 'busqueda'){

		echo '
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>La factura #'. $_GET['busqueda'] .' no existe.</strong> El codigo de factura que ha buscado no se encuentra registrado.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		';
	}

	?>

    <div class="row">

		<div class="col-md-3 col-sm-12 mb-4">

            <div class="card mb-4">
                <h6 class="card-header">Registrar</h6>
                <div class="card-body">
                    <a class="btn btn-primary d-block" href="<?php echo HTTP ?>/registrar/factura">Nueva factura</a>
                </div>
            </div>

			<div class="card">
                <h6 class="card-header">Buscar factura</h6>
                <form class="card-body validar" novalidate method="POST" action="<?php echo HTTP ?>/facturar/buscar/factura" >
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">#</span>
						</div>
                        <input required type="number" name="busqueda"  class="form-control" placeholder="Codigo" <?php if(isset($_GET['busqueda'])){
							echo 'value="'. $_GET['busqueda'] .'"';
						}?>>
						<div class="invalid-feedback">
						  Ingrese el codigo de factura a buscar.
						</div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 btn-block">Buscar</button>
                </form>
            </div>

        </div>

        <div class="col-md-9 col-sm-12">
            <div class="card mb-4">
                <h6 class="card-header">Todas las facturas</h6>
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
						<ul class="pagination justify-content-center m-0">
	                        <li class="page-item <?php echo $anterior; ?>">
	                        <a class="page-link" href="<?php echo HTTP ?>/facturar/facturas/<?php echo $anterior_link; ?>">Anterior</a>
	                        </li>

	                        <?php

	                        for($i = 0; $i < $paginacion; $i++){

	                            $pagina_activa = null;
	                            if($i + 1 == $pagina){ $pagina_activa = 'active'; }

	                            echo '
	                                <li class="page-item '. $pagina_activa .'"><a class="page-link" href="'. HTTP .'/facturar/facturas/'. ($i + 1) .'">'. ($i + 1) .'</a></li>
	                            ';
	                        }

	                        ?>

	                        <li class="page-item <?php echo $siguiente; ?>">
	                        <a class="page-link" href="<?php echo HTTP ?>/facturar/facturas/<?php echo $siguiente_link; ?>">Siguiente</a>
	                        </li>
	                    </ul>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</main>

<?php include_footer(); ?>
