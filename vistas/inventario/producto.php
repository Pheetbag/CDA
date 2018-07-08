<?php include_head('CDA - Inventario'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.8">
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/producto.css?v=0.2">
</head>
<body>

<!-- MODAL BORRAR -->

<div class="modal" id="alerta-borrar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
            </div>
            <div class="modal-body">
                <p>
                    Estás intentando eliminar el producto:
                    <b>"<?php echo $resultado['nombre_producto'] ?>"</b> del inventario.
                </p>
                <p class="text-justify">
                    Este y todos los datos asociados a el se perderan, las referencias y relaciones en las facturas creadas con anterioridad usando este producto tambien se perderán.
                </p>
                <small class="text-muted">
                Nota: Crear un producto con las mismas caracteristicas en el futuro no recuperará estas infomación, ni asociará el producto a las facturas antiguas.
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="?action=eliminar" class="btn btn-danger">Eliminar producto</a>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL BORRAR -->

<?php include_header('inventario', 'Inventario', 'Producto'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">
        <div class="col-md-6 container-fluid">

            <div class="row mb-0">
                <div class="col-12">
                    <a href="?action=editar" class="btn btn-primary" role="button">Editar</a>
                    <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#alerta-borrar">Eliminar</button> -->
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <h6 class="card-header">Nombre</h6>
                        <div class="card-body"><?php echo $resultado['nombre_producto'] ?></div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <h6 class="card-header">ID</h6>
                        <div class="card-body"><?php echo $resultado['codigo_producto'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                        <div class="card">
                            <h6 class="card-header">Tipo</h6>
                            <div class="card-body"><?php echo $resultado['tipo_producto'] ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <h6 class="card-header">Marca</h6>
                            <div class="card-body"><?php echo $resultado['marca_producto'] ?></div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <h6 class="card-header">Modelo</h6>
                        <div class="card-body"><?php echo $resultado['modelo_producto'] ?></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <h6 class="card-header">Existencias</h6>
                        <div class="card-body"><?php echo number_format($resultado['existencias'],0,',', ' ') ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <h6 class="card-header">Precio</h6>
                        <div class="card-body"><?php echo number_format($resultado['precio_venta'],2,',', '.') ?></div>
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

						$codigo   = $movimientos[$i]['codigo'];
						$tipo     = $movimientos[$i]['tipo'];
						$cantidad = number_format($movimientos[$i]['cantidad'],0,',', ' ');
						$subtotal = number_format($movimientos[$i]['subtotal'],2,',', '.');
						$fecha    = $movimientos[$i]['fecha'];

						if($tipo == 'venta'){

							echo '
							<div class="card text-white bg-danger mb-2">
								<h6 class="card-header text-center">'. date('d/m/Y',strtotime($fecha)) .'</h6>
								<div class="card-body text-right">
									<div class="font-weight-bold">-'. $cantidad .' unidades en las existencias</div>
									<div class="">SUBTOTAL Bs. '. $subtotal .'</div>
								</div>
								<div class="card-footer text-center">
									<a class="px-5 btn btn-light text-danger" href="'. HTTP .'/facturar/f/'. $codigo .'" role="button">Ver factura</a>
								</div>
							</div>';
						}else if($tipo == 'compra'){

							echo '
							<div class="card text-white bg-success mb-2">
								<h6 class="card-header text-center">'. date('d/m/Y',strtotime($fecha)) .'</h6>
								<div class="card-body text-right">
									<div class="font-weight-bold">+'. $cantidad .' unidades en las existencias</div>
									<div class="">SUBTOTAL Bs. '. $subtotal .'</div>
								</div>
								<div class="card-footer text-center">
									<a class="px-5 btn btn-light text-success" href="'. HTTP .'/pedidos/p/'. $codigo .'" role="button">Ver pedido</a>
								</div>
							</div>';
						}
					}
				}

				?>

        </div>
    </div>

</main>

<?php include_footer(); ?>
