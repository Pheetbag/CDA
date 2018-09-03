<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header(null, 'Administración', null); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

	<div class="row">

		<div class="col-sm-8 col-md-9 col-lg-6">

			<?php

				if(isset($_GET['action']) AND $_GET['action'] == 'clave-cambiada'){

					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Contraseña cambiada.</strong> Se ha hecho el cambio de contraseña para el usuario exitosamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>';

				}

			?>


			<div class="card mb-4 border-dark text-center">
				<h6 class="card-header">Usuarios registrados</h6>
			  <div class="card-body text-dark">
			  	
              <?php

                if ($usuarios == null) {

                    echo'

                        <div class="card-body center font-weight-bold text-center">
                            No hay usuarios registrados.
                        </div>

                    ';
                }else{

                    $cantidad_usuarios = count($usuarios);

                    for ($i=0; $i < $cantidad_usuarios; $i++) {

                        $usuario = $usuarios[$i];
                        $rango   = null;

                        switch ($usuario['rango']) {
                            case '1':
                                $rango = 'Administrador';
                                break;

                            case '2':
                                $rango = 'Operador';
                                break;

                            case '3':
                                $rango = 'Vendedor';
                                break;
                        }

                        echo'
                        <div class="list-group-item list-group-item-action container-fluid">
                            <div class="row">

                                <div class="col">
                                    <div class="font-weight-bold">'. $usuario['usuario'] .'</div>
                                </div>
                                <div class="col text-center">
                                    <div class="text-muted">'. $rango .'</div>
                                </div>
                                <div class="col d-flex justify-content-center">
                                    <a href="'. HTTP .'/administracion/eliminar/'. $usuario['id'] .'" class="button is-danger">X</a>
                                </div>

                            </div>
                        </div>
                        ';

                    }

                }

                ?>

			  </div>
			</div>



		</div>

	</div>

</main>

<?php

    include_footer();

?>
