<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header(2,'Pedidos', 'Todos'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

	<?php

	if(isset($_GET['err']) AND $_GET['err'] == 'busqueda'){

		echo '
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>El pedido #'. $_GET['busqueda'] .' no existe.</strong> El codigo de pedido que ha buscado no se encuentra registrado.
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
                    <a class="btn btn-primary d-block" href="<?php echo HTTP ?>/registrar/pedido">Nuevo pedido</a>
                </div>
            </div>

			<div class="card mb-4">
                <h6 class="card-header">Buscar pedido</h6>
                <form class="card-body" method="POST" action="<?php echo HTTP ?>/pedidos/buscar/pedido">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">#</span>
						</div>
                        <input type="text" name="busqueda" class="form-control" <?php if(isset($_GET['busqueda'])){ echo 'value="' . $_GET['busqueda'] . '"'; }?> placeholder="Codigo">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 btn-block">Buscar</button>
                </form>
            </div>

        </div>

        <div class="col-md-9 col-sm-12">
            <div class="card mb-4">
                <h6 class="card-header">Todos los pedidos</h6>
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
									<div>'. $rif .'</div>
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
						<ul class="pagination justify-content-center m-0">
	                        <li class="page-item <?php echo $anterior; ?>">
	                        <a class="page-link" href="<?php echo HTTP ?>/pedidos/todos/<?php echo $anterior_link; ?>">Anterior</a>
	                        </li>

	                        <?php

	                        for($i = 0; $i < $paginacion; $i++){

	                            $pagina_activa = null;
	                            if($i + 1 == $pagina){ $pagina_activa = 'active'; }

	                            echo '
	                                <li class="page-item '. $pagina_activa .'"><a class="page-link" href="'. HTTP .'/pedidos/todos/'. ($i + 1) .'">'. ($i + 1) .'</a></li>
	                            ';
	                        }

	                        ?>

	                        <li class="page-item <?php echo $siguiente; ?>">
	                        <a class="page-link" href="<?php echo HTTP ?>/pedidos/todos/<?php echo $siguiente_link; ?>">Siguiente</a>
	                        </li>
	                    </ul>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</main>

<?php include_footer(); ?>
