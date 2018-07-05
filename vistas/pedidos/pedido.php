<?php include_head('CDA - Pedidos'); ?>
</head>
<body>

<?php include_header(2, 'Pedidos', 'Pedido'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">

        <div class="col-lg-4 col-md-8 container-fluid">

			<?php

				if(isset($_GET['creado'])){

					echo '
					<div class="row mb-4">
		                <div class="col-sm-12">
		                    <div class="progress" style="height: 25px;">
		                    <div class="progress-bar progress-bar-striped progress-bar-animated
		                    bg-success font-weight-bold" style="width:100%;">¡Completado!</div>
		                    </div>
		                </div>
		            </div>
					';
				}

			?>

            <div class="row mb-2">
                <div class="col-sm-12">

                    <div class="card">
                        <h6 class="card-header text-center px-5">
                            <?php echo $pedido['nombre_empresa'] ?>
                            |
                            <?php echo $pedido['rif'] ?>
                            <br><br>
                            <?php echo $pedido['direccion'] ?>
                            <br>
                            <?php echo $pedido['telefono'] ?>
                        </h6>
                        <h6 class="card-header text-muted text-center">
                        <?php echo(date('d/m/Y',strtotime($pedido['fecha']))) ?> | Pedido #<?php echo $pedido['codigo_pedido'] ?>
                        </h6>
                        <ul class="list-group list-group-flush">

						<?php

						$cantidad_detalles = count($detalles);

						for ($i=0; $i < $cantidad_detalles; $i++) {

							$codigo   = $detalles[$i]['codigo_producto'];
							$producto = $detalles[$i]['nombre_producto'];
							$cantidad = $detalles[$i]['cantidad'];
							$subtotal = $detalles[$i]['subtotal'];

						echo '
						<a href="'. HTTP .'/inventario/producto/'. $codigo .'" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <p class="mb-0 font-weight-bold">'. $producto .'</p>
                                    <p class="mb-0">Codigo: '. $codigo .'</p>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <p class="font-weight-bold mb-0 text-success ">Bs. '. $subtotal .'</p>
                                    <p class="mb-0">x'. $cantidad .'</p>
                                </div>
                            </div>
                        </a>
						';

						}
						?>

                        </ul>

						<?php

						echo '<div class="card-footer text-muted text-right">';
						echo 'SUBTOTAL  &nbsp;&nbsp;&nbsp; Bs. '  . $pedido['subtotal'] . '<br>';
						echo 'IVA (12%) &nbsp;&nbsp;&nbsp; Bs. ' . $pedido['iva'] . '</div>';

						echo '<div class="card-footer text-center font-weight-bold">';
						echo 'TOTAL Bs. ' . $pedido['total'] . '</div>';

						 ?>
                    </div>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="card bg-light sp">
                        <h6 class="card-header text-center text-muted">Fecha de llegada: <?php echo(date('d/m/Y',strtotime($pedido['fecha_llegada']))) ?></h6>
                    </div>
                </div>
            </div>


        </div>
    </div>
</main>

<?php include_footer(); ?>
