<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header('facturar','Facturación', 'Facturas'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">


		<?php

		if(isset($_GET['err']) AND $_GET['err'] == 'busqueda'){

			$ci_div    = explode('-', $_GET['busqueda']);
			$ci        = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>El cliente '. $ci .' no existe.</strong> La cédula que ha consultado no se encuentra registrada.
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
                    <a class="btn btn-primary d-block" href="<?php echo HTTP ?>/registrar/cliente">Nuevo cliente</a>
                </div>
            </div>

            <div class="card mb-4">
                <h6 class="card-header">Buscar cliente</h6>
                <form novalidate method="POST" action="<?php echo HTTP?>/facturar/buscar/cliente" class="validar card-body">
                    <div class="form-group row">

						<select required class="form-control col-3 col-sm-2 col-md-4 col-xl-3 ml-3 mr-1" name="ci-prefijo">

							<?php

							$selected_v = null;
							$selected_e = null;

							if(isset($_GET['busqueda'])){

								switch (explode('-', $_GET['busqueda'])[0]) {
									case 'E':
										$selected_e = 'selected';
										break;

									default:
										$selected_v = 'selected';
										break;
								}

							}

							echo '
							<option '. $selected_v .' value="V">V</option>
							<option '. $selected_e .' value="E">E</option>';

							?>
						</select>

						<div class="col mr-3 px-0">
							<input required type="number" name="busqueda" class="form-control" <?php if(isset($_GET['busqueda'])){
								echo 'value="'. explode('-',$_GET['busqueda'])[1] .'"';
							}?> placeholder="Cédula">
							<div class="invalid-feedback">
							  Ingrese la cédula del cliente a buscar.
							</div>
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

						$ci_div    = explode('-', $clientes[$i]['ci_cliente']);
						$ci        = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

						$direccion = $clientes[$i]['direccion_cliente'];
						$telefono  = $clientes[$i]['telefono'];

						$codigo    = $clientes[$i]['ci_cliente'];

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
