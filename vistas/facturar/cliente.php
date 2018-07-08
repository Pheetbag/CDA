<?php include_head('CDA - Inventario'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.8">
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/producto.css?v=0.2">
</head>
<body>

<?php include_header('facturar', 'Facturación', 'Cliente'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">
        <div class="col-md-6 container-fluid">
<!--
            <div class="row mb-0">
                <div class="col-12">
                    <a href="?action=editar" class="btn btn-primary" role="button">Editar</a>
                </div>
            </div>
-->
            <div class="row">
                <div class="col-sm-5">
                    <div class="card">
                        <h6 class="card-header">Nombre</h6>
                        <div class="card-body"><?php echo $resultado['nombre_cliente'] ?></div>
                    </div>
                </div>
				<div class="col-sm-5">
					<div class="card">
						<h6 class="card-header">Apellido</h6>
						<div class="card-body"><?php echo $resultado['apellido_cliente'] ?></div>
					</div>
				</div>
            </div>
            <div class="row">
				<div class="col-sm-5">
					<div class="card">
						<h6 class="card-header">Cédula</h6>
						<div class="card-body"><?php

						$ci_div   = explode('-', $resultado['ci_cliente']);
						$ci       = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

						echo $ci ?></div>
					</div>
				</div>
                <div class="col-sm-5">
                    <div class="card">
                        <h6 class="card-header">Teléfono</h6>
                        <div class="card-body"><?php echo $resultado['telefono'] ?></div>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-sm-10">
					<div class="card">
						<h6 class="card-header">Dirección</h6>
						<div class="card-body"><?php echo $resultado['direccion_cliente'] ?></div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-md-6 col-lg-4 container-fluid">

                <h6 class="card-header mb-4">Ultimos movimientos</h6>

				<?php

				if($movimientos == null){

					echo'

						<div class="card-body center font-weight-bold text-center">
							<div class="ico-no-resultados"></div>
							No hay movimientos recientes.
						</div>

					';
				}else{

					$cantidad_movimientos = count($movimientos);

					for ($i=0; $i < $cantidad_movimientos; $i++) {

						$codigo   = $movimientos[$i]['codigo_factura'];

						$subtotal = number_format( $movimientos[$i]['subtotal'] ,2,',', '.');
						$total    = number_format( $movimientos[$i]['total'] ,2,',', '.');
						$fecha    = $movimientos[$i]['fecha_venta'];

						echo '
						<div class="card text-white bg-danger mb-2">
							<h6 class="card-header text-center">'. date('d/m/Y',strtotime($fecha)) .'</h6>
							<div class="card-body text-right">
								<div class="">SUBTOTAL Bs. '. $subtotal.'</div>
								<div class="font-weight-bold">TOTAL Bs. '. $total .'</div>
							</div>
							<div class="card-footer text-center">
								<a class="px-5 btn btn-light text-danger" href="'. HTTP .'/facturar/f/'. $codigo .'" role="button">Ver factura</a>
							</div>
						</div>';

					}
				}

				?>

        </div>
    </div>

</main>

<?php include_footer(); ?>
