<?php include_head('CDA - Inventario'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.8">
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/producto.css?v=0.2">
</head>
<body>

<?php include_header('pedidos', 'Pedidos', 'Proveedor'); ?>

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
                <div class="col-sm-10">
                    <div class="card">
                        <h6 class="card-header">Nombre del proveedor</h6>
                        <div class="card-body"><?php echo $resultado['nombre_empresa'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
				<div class="col-sm-5">
					<div class="card">
						<h6 class="card-header">Rif</h6>
						<div class="card-body"><?php
						$rif_div   = explode('-', $resultado['rif']);
						$rif       = $rif_div[0] . '-' . number_format( $rif_div[1] ,0, ',','.');
						echo $rif ?></div>
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
						<div class="card-body"><?php echo $resultado['direccion'] ?></div>
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

						$codigo   = $movimientos[$i]['codigo_pedido'];

						$subtotal = number_format( $movimientos[$i]['subtotal'] ,2,',', '.');
						$total    = number_format( $movimientos[$i]['total'] ,2,',', '.');
						$fecha    = $movimientos[$i]['fecha'];
						$llegada  = $movimientos[$i]['fecha_llegada'];

						echo '
						<div class="card text-white bg-success mb-2">
							<h6 class="card-header text-center">'. date('d/m/Y',strtotime($fecha)) .'</h6>
							<div class="card-body text-right">
								<div class="">SUBTOTAL Bs. '. $subtotal.'</div>
								<div class="font-weight-bold">TOTAL Bs. '. $total .'</div>
							</div>
							<div class="card-footer text-center">
								<a class="px-5 btn btn-light text-success" href="'. HTTP .'/pedidos/p/'. $codigo .'" role="button">Ver pedido</a>
							</div>
						</div>';

					}
				}

				?>

        </div>
    </div>

</main>

<?php include_footer(); ?>
