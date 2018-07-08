<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header('pedidos','Pedidos', 'Proveedores'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">


	<?php

	if(isset($_GET['err']) AND $_GET['err'] == 'busqueda'){

		$rif_div   = explode('-', $_GET['busqueda']);
		$rif       = $rif_div[0] . '-' . number_format( $rif_div[1] ,0, ',','.');

		echo '
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>El proveedor '. $rif .' no existe.</strong> El proveedor que ha consultado no se encuentra registrado en el sistema.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		';
	}

	?>

    <div class="row">

		<div class="col-md-3 col-sm-12 mb-4">

			<?php

			if($_SESSION['usuario']['rango'] < 3) {

				echo '

				<div class="card mb-4">
	                <h6 class="card-header">Registrar</h6>
	                <div class="card-body">
	                    <a class="btn btn-primary d-block" href="'. HTTP .'/registrar/proveedor">Nuevo proveedor</a>
	                </div>
	            </div>
				';
			}

			?>



			<div class="card">
                <h6 class="card-header">Buscar proveedor</h6>
                <form novalidate class="card-body validar" method="POST" action="<?php echo HTTP ?>/pedidos/buscar/proveedor">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">J-</span>
						</div>
                        <input required type="text" name="busqueda" class="form-control" <?php if(isset($_GET['busqueda'])){ echo 'value="'. explode('-', $_GET['busqueda'])[1] .'"'; } ?> placeholder="Rif">
						<div class="invalid-feedback">
						  Ingrese el rif del proveedor a buscar.
						</div>
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
						<ul class="pagination justify-content-center m-0">
	                        <li class="page-item <?php echo $anterior; ?>">
	                        <a class="page-link" href="<?php echo HTTP ?>/pedidos/proveedores/<?php echo $anterior_link; ?>">Anterior</a>
	                        </li>

	                        <?php

	                        for($i = 0; $i < $paginacion; $i++){

	                            $pagina_activa = null;
	                            if($i + 1 == $pagina){ $pagina_activa = 'active'; }

	                            echo '
	                                <li class="page-item '. $pagina_activa .'"><a class="page-link" href="'. HTTP .'/pedidos/proveedores/'. ($i + 1) .'">'. ($i + 1) .'</a></li>
	                            ';
	                        }

	                        ?>

	                        <li class="page-item <?php echo $siguiente; ?>">
	                        <a class="page-link" href="<?php echo HTTP ?>/pedidos/proveedores/<?php echo $siguiente_link; ?>">Siguiente</a>
	                        </li>
	                    </ul>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</main>

<?php include_footer(); ?>
