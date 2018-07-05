<?php include_head('CDA - Inventario'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.8">
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/producto.css?v=0.2">
</head>
<body>

<?php include_header(0, 'Producto', 'Editar'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">
        <form class="col-md-6 container-fluid" method="POST" action="?action=guardar">

            <div class="row mb-0">
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="/inventario/producto/<?php echo $resultado['codigo_producto'] ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card bg-dark text-white">
                        <h6 class="card-header">Nombre</h6>
                        <div class="card-body">
                        <input type="text" class="form-control bg-light" name="nombre" placeholder="Nombre" value="<?php echo $resultado['nombre_producto'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-dark text-white">
                        <h6 class="card-header">ID</h6>
                        <div class="card-body">
                            <input type="text" class="form-control" disabled name="id" placeholder="ID" value="<?php echo $resultado['codigo_producto'] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                        <div class="card bg-dark text-white">
                            <h6 class="card-header">Tipo</h6>
                            <div class="card-body">
                        <input type="text" class="form-control bg-light" name="tipo" placeholder="Tipo" value="<?php echo $resultado['tipo_producto'] ?>">
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card bg-dark text-white">
                            <h6 class="card-header">Marca</h6>
                            <div class="card-body">
                        <input type="text" class="form-control bg-light" name="marca" placeholder="Marca" value="<?php echo $resultado['marca_producto'] ?>">
                        </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card bg-dark text-white">
                        <h6 class="card-header">Modelo</h6>
                        <div class="card-body">
                        <input type="text" class="form-control bg-light" min="0" name="modelo" placeholder="Modelo" value="<?php echo $resultado['modelo_producto'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-dark text-white">
                        <h6 class="card-header">Existencias</h6>
                        <div class="card-body">
                        <input type="number" class="form-control bg-light" min="0" name="existencias" placeholder="Existencias" value="<?php echo $resultado['existencias'] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card bg-dark text-white">
                        <h6 class="card-header">Precio</h6>
                        <div class="card-body">
                        <input type="number" class="form-control bg-light" step="0.01" name="precio" placeholder="Precio" value="<?php echo $resultado['precio_venta'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
						$cantidad = $movimientos[$i]['cantidad'];
						$subtotal = $movimientos[$i]['subtotal'];
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
