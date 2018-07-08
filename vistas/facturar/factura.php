<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header('facturar', 'Facturación', 'Factura'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">

        <div class="col-md-8 col-lg-4 container-fluid">

		<?php

			if(isset($_GET['creada'])){

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

            <div class="row mb-4">
                <div class="col-sm-12">

                    <div class="card">
                        <h6 class="card-header text-center px-5">
							<?php echo ucwords($factura['nombre_cliente'] . ' ' . $factura['apellido_cliente']) ?>
                            |
                            <?php

							$ci_div   = explode('-', $factura['ci_cliente']);
							$ci       = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

							echo $ci ?>
                            <br><br>
                            <?php echo $factura['direccion_cliente'] ?>
                            <br>
                            <?php echo $factura['telefono'] ?>
                        </h6>
                        <h6 class="card-header text-muted text-center">
                        <?php echo(date('d/m/Y',strtotime($factura['fecha_venta']))) ?> | Factura #<?php echo $factura['codigo_factura'] ?>
                        </h6>
                        <ul class="list-group list-group-flush">

						<?php

						$cantidad_detalles = count($detalles);

						for ($i=0; $i < $cantidad_detalles; $i++) {

							$codigo   = $detalles[$i]['codigo_producto'];
							$producto = $detalles[$i]['nombre_producto'];
							$cantidad = number_format($detalles[$i]['cantidad'],0,',', ' ');
							$subtotal = number_format($detalles[$i]['subtotal'],2,',', '.');

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
						echo 'SUBTOTAL  &nbsp;&nbsp;&nbsp; Bs. '  . number_format( $factura['subtotal']  ,2,',', '.'). '<br>';
						echo 'IVA (12%) &nbsp;&nbsp;&nbsp; Bs. ' . number_format( $factura['iva'] ,2,',', '.') . '</div>';

						echo '<div class="card-footer text-center font-weight-bold">';
						echo 'TOTAL Bs. ' . number_format( $factura['total']  ,2,',', '.'). '</div>';

						 ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

<?php include_footer(); ?>
