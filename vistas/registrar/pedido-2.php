<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.5">
</head>
<body>

<?php include_header(4, 'Registrar', 'Pedido'); ?>


<div class="modal fade" tabindex="-1" id="agregar-producto">
    <div class="modal-dialog modal-dialog-centered">
        <form method="post" action="/registrar/pedido/agregar-producto?<?php echo datos_url($datos); ?>" class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Agregar producto al pedido</h5>
        </div>
        <div class="modal-body">

			<?php

			if(isset($_GET['err'])){

				switch ($_GET['err']) {
					case 'producto':

						echo
						'<div class="alert alert-danger">
							Este producto no está registrado en el inventario.
						</div>'
						;
						break;

					case 'repetido':

						echo
						'<div class="alert alert-danger">
							Este producto ya se encuentra anexado en la factura.
						</div>'
						;
						break;

					case 'existencia':

						echo
						'<div class="alert alert-warning">
							Este producto no tiene las existencias suficientes. Restan <b>' . $_GET['errext'] . '</b> en el inventario.
						</div>'
						;
						break;


				}

			}

			?>

            <div>
                <div class="form-group">
                <label for="agregar-id">Selecciona un producto</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Producto 1</option>
                        <option>Producto 2</option>
                        <option>Producto 3</option>
                        <option>Producto 4</option>
                        <option>Producto 5</option>
                    </select>
					<input type="number" name="codigo" placeholder="Codigo" value="<?php if(isset($_GET['datacodigo'])){ echo $_GET['datacodigo'];} ?>">
                </div>
                <div class="form-group">
                    <label for="agregar-cantidad">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" min="1" value="<?php
					if(isset($_GET['dataext'])){
						 echo $_GET['dataext'];

					 }else{
						 echo '1';
					 }?>">
                </div>
                <div class="form-group">
                    <label for="agregar-cantidad">Precio de compra</label>
                    <input type="number" class="form-control" name="costo" min="1" value="<?php
					if(isset($_GET['datacost'])){
						 echo $_GET['datacost'];

					 }else{
						 echo '1';
					 }?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
	</form>
    </div>
</div>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">
        <div class="col-md-6">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">

						<a href="/registrar/pedido/paso-1?<?php echo datos_url($datos); ?>" class="btn btn-primary mb-2">Paso anterior</a>

                        <div class="card mb-3">
                            <h6 class="card-header d-flex align-items-center justify-content-between">

                                <span class="my-0 align-middle">Lista de productos </span>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar-producto">Agregar</button>

                            </h6>
                            <ul class="list-group list-group-flush">

							<?php

								if($datos['productos'] == null){

									echo'

			                            <div class="card-body center font-weight-bold text-center">
			                                <div class="ico-no-resultados"></div>
			                                No has agregado ningún producto a la factura.
			                            </div>

			                        ';

								}else{

									$cantidad_productos = count($datos['productos']);


									for ($i=0; $i < $cantidad_productos; $i++) {

										$producto = $consultar->get('producto', $datos['productos'][$i]);
										$cantidad = $datos['cantidades'][$i];
										$costo    = $datos['costos'][$i];
										$precio   = $datos['precios'][$i];

										echo '

										<div class="modal fade" tabindex="-1" id="editar-producto-' . $i . '">
										    <div class="modal-dialog modal-dialog-centered">
										        <form method="POST" action="/registrar/pedido/editar-producto?' .  datos_url($datos) .'" class="modal-content">
										        <div class="modal-header">
										            <h5 class="modal-title">Editando producto</h5>
										        </div>
										        <div class="modal-body">
													<div class="container-fluid">

													<div class="row">
				                                        <div class="col-6 d-flex flex-column justify-content-around align-items-start mb-md-0 mb-2">
				                                            <p class="font-weight-bold mb-0">'. $producto['nombre_producto'] .'</p>
				                                            <p class="font-weight-bold mb-0 text-success ">Bs. '. $precio .'</p>
				                                            <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>

				                                        </div>
				                                        <div class="col-6 d-flex flex-column align-items-end justify-content-around mb-md-0 mb-2">
				                                            <p class="mb-0">Tipo: '.$producto['tipo_producto'].'</p>
				                                            <p class="mb-0">Marca: '.$producto['marca_producto'].'</p>
				                                            <p class="mb-0 ">Modelo: '.$producto['modelo_producto'].'</p>
				                                        </div>
				                                    </div>

													<br><hr>

													<div class="form-group row mt-3">
														<input type="number" name="id" class="d-none" value="' . $i .'">
												      	<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Cantidad</label>
													      <div class="col-sm-6">
													        <input type="number" min="0" value="'. $cantidad .'" class="form-control" name="cantidad">
													      </div>
												    </div>

													<div class="form-group row mt-3">
												      	<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Precio de compra</label>
													      <div class="col-sm-6">
													        <input type="number" min="0" value="'. $costo .'" class="form-control" name="costo">
													      </div>
												    </div>

													<hr>

													<div class="form-group row mt-3">
														<small class="text-muted mb-3">Puedes modificar el precio de venta de un producto al momento de generar un pedido, o puedes hacerlo más tarde desde el inventario.</small>
														<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Precio de venta</label>
														<div class="col-sm-6">
															<input type="number" min="0" value="'. $precio .'" class="form-control" name="precio">
														</div>
													</div>

													</div>
												</div>
										        <div class="modal-footer">
										            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										            <button type="submit" class="btn btn-primary">Cambiar</button>
										        </div>
											</form>
										    </div>
										</div>


											<li class="list-group-item list-group-item-action container-fluid">
			                                    <div class="row">
			                                        <div class="col-sm-6 col-md-5 d-flex flex-column justify-content-around align-items-center align-items-md-start mb-md-0 mb-2">
			                                            <p class="font-weight-bold mb-0">'. $producto['nombre_producto'] .'</p>
			                                            <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>
														<p class="mb-0">Bs. '. $precio .'</p>
			                                            <p class="mb-0">Cantidad: '. $cantidad .'</p>
			                                        </div>
			                                        <div class="col-sm-6 col-md-4 d-flex flex-column align-items-center justify-content-around mb-md-0 mb-2">
														<p class="font-weight-bold mb-0 text-danger">Bs. '. $costo .'</p>
			                                            <p class="mb-0">Tipo: '.$producto['tipo_producto'].'</p>
			                                            <p class="mb-0">Marca: '.$producto['marca_producto'].'</p>
			                                            <p class="mb-0 ">Modelo: '.$producto['modelo_producto'].'</p>
			                                        </div>
													<div class="col-sm-12 col-md-3 d-flex flex-column align-items-center justify-content-around">

														<a href="/registrar/pedido/eliminar-producto?eliminar='. $i .'&'. datos_url($datos) .'" class="btn btn-danger btn-block btn-sm"><img  src="/recursos/cancel-white.svg" height="15px" width="15px" /></a>
														<button type="button" class="btn btn-secondary btn-block btn-sm" data-toggle="modal" data-target="#editar-producto-' . $i . '"><img  src="/recursos/edit.svg" height="15px" width="15px"/></button>
													</div>
			                                    </div>
			                                </li>
										';
									}

								}
							?>
<!--
                                <li class="list-group-item list-group-item-action container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-5 d-flex flex-column justify-content-around align-items-center align-items-md-start mb-md-0 mb-2">
                                            <p class="font-weight-bold mb-0">Producto 1</p>
                                            <p class="mb-0">Codigo: 209</p>
                                            <p class="mb-0">Cantidad: 2</p>
                                        </div>
                                        <div class="col-sm-6 col-md-4 d-flex flex-column align-items-center justify-content-around mb-md-0 mb-2">
                                            <p class="font-weight-bold mb-0 text-success ">Bs. 2.000.500</p>
                                            <p class="mb-0">Tipo: tipo</p>
                                            <p class="mb-0">Marca: marca</p>
                                            <p class="mb-0 ">Modelo: modelo</p>
                                        </div>
                                        <div class="col-sm-12 col-md-3 d-flex flex-column align-items-center justify-content-around">
											<a href="/registrar/factura/eliminar-producto?eliminar='. $i .'&'. datos_url($datos) .'" class="btn btn-danger btn-block btn-sm"><img  src="/recursos/cancel-white.svg" height="15px" width="15px" /></a>
											<button type="button" class="btn btn-secondary btn-block btn-sm" data-toggle="modal" data-target="#editar-producto-' . $i . '"><img  src="/recursos/edit.svg" height="15px" width="15px"/></button>
                                        </div>
                                    </div>
                                </li>
-->
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-6 col-lg-5 container-fluid">

            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="progress" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated
                    bg-success font-weight-bold" style="width:66.6%;">Paso 2</div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">

                    <div class="card">
						<h6 class="card-header text-center px-5">
							<?php

							if($datos['rif'] != null){

								echo

								$datos['proveedor']['nombre_empresa'] .
								' | ' . '
								J-' . $datos['proveedor']['rif'] . '
								<br><br>' .
								$datos['proveedor']['direccion'] .
								' <br>' .
								$datos['proveedor']['telefono']
								;

							}else{

								echo '
								Sin cliente asociado
								<br><br>
								No hay datos disponible. Debes asociar un cliente a la factura para continuar';

							}


							 ?>
                        </h6>
						<h6 class="card-header text-muted text-center">
                        <?php
						echo(date('d/m/Y',strtotime($datos['fecha'])))
						?>
                        </h6>
                        <ul class="list-group list-group-flush">

						<?php

							if($datos['productos'] == null){

								echo'

									<div class="p-5"></div>

								';

							}else{

								$cantidad_productos = count($datos['productos']);

								for ($i=0; $i < $cantidad_productos; $i++) {

									$producto    = $consultar->get('producto', $datos['productos'][$i]);
									$cantidad    = $datos['cantidades'][$i];
									$costo       = $datos['costos'][$i];
									$costo_total = $costo * $cantidad;
									$datos['subtotal']  += $costo_total;

								echo '
								<li class="list-group-item list-group-item-action container-fluid">
	                                <div class="row">
	                                    <div class="col-sm-6 text-left">
	                                        <p class="mb-0 font-weight-bold">'. $producto['nombre_producto'] .'</p>
	                                        <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>
	                                    </div>
	                                    <div class="col-sm-6 text-right">
	                                        <p class="font-weight-bold mb-0 text-success ">Bs. '. $costo_total .'</p>
	                                        <p class="mb-0">x'. $cantidad .'</p>
	                                    </div>
	                                </div>
	                            </li>
								';

								}
							}

							//NOTA EN EL FUTURO USAR AL FUNCIÓN NUMBER_FORMAT Y ROUND PARA DARLE FORMATO A TODOS LOS VALORES NUMERICOS
						?>

<!--

                            <li class="list-group-item list-group-item-action container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <p class="mb-0 font-weight-bold">Producto 1</p>
                                        <p class="mb-0">Codigo: 209</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <p class="font-weight-bold mb-0 text-success ">Bs. 2.000.500</p>
                                        <p class="mb-0">x2</p>
                                    </div>
                                </div>
                            </li>

-->
                        </ul>

                        <div class="card-footer text-muted text-right">
                            SUBTOTAL Bs. <?php echo $datos['subtotal'] ?><!--
                            --><br>
                            IVA: <?php echo(($datos['subtotal'] * 12) /100)  ?>
                        </div>

                        <div class="card-footer text-center font-weight-bold">
                            TOTAL Bs. <?php echo($datos['subtotal'] * 1.12) ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="card bg-light sp">
                        <h6 class="card-header text-center text-muted">Fecha de llegada: <?php echo(date('d/m/Y',strtotime($datos['llegada']))) ?></h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" name="nuevo-producto" class="btn btn-primary btn-block py-2">
                        Generar pedido
                    </button>
                </div>
            </div>


        </div>
    </div>
</main>

<?php

if(isset($_GET['err'])){
    include_footer("
    <script type='    text/javascript'    >
    $(window).on('load',function(){
        $('#agregar-producto').modal('show');
    });
    </script>");

}else{

    include_footer();

}


?>
