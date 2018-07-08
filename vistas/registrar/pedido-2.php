<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.5">
</head>
<body>

<?php include_header('registrar', 'Registrar', 'Pedido'); ?>


<div class="modal fade" tabindex="-1" id="agregar-producto">
    <div class="modal-dialog modal-dialog-centered">
        <form method="post" action="<?php echo HTTP ?>/registrar/pedido/agregar-producto?<?php echo datos_url($datos); ?>" class="modal-content validar" novalidate>
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
							Este producto no tiene las existencias suficientes. Restan <b>' . number_format( $_GET['errext'] ,0,',', ' ') . '</b> en el inventario.
						</div>'
						;
						break;


				}

			}

			?>

            <div>
                <div class="form-group">
                <label for="agregar-id">Selecciona un producto</label>
				<select name="codigo" required class="form-control" >
					<option value='' selected disabled>Selecciona un producto</option>
					<?php

					if($select_productos == null){

						echo '';
					}else{

						$cantidad_options = count($select_productos);

						for ($i=0; $i < $cantidad_options; $i++) {

							$nombre   = $select_productos[$i]['nombre'];
							$codigo   = $select_productos[$i]['codigo'];
							$selected = null;

							if(isset($_GET['datacodigo']) AND $_GET['datacodigo'] == $codigo){
								$selected = 'selected';
							}

							echo '
							<option '. $selected .' value="'. $codigo .'">'. $nombre .'</option>
							';

						}
					}

					?>
				</select>
				<div class="invalid-feedback">
				  Selecciona un producto.
				</div>
				<div class="valid-feedback">
				  ¡Perfecto!
				</div>
                </div>
                <div class="form-group">
                    <label required for="agregar-cantidad">Cantidad</label>
                    <input required type="number" class="form-control" name="cantidad" min="1" value="<?php
					if(isset($_GET['dataext'])){
						 echo $_GET['dataext'];

					 }else{
						 echo '1';
					 }?>">
					 <div class="invalid-feedback">
					   Ingrese una cantidad a comprar válida.
					 </div>
					 <div class="valid-feedback">
					   ¡Perfecto!
					 </div>
                </div>
                <div class="form-group">
                    <label for="agregar-cantidad">Precio de compra</label>
                    <input required type="number" class="form-control" step="0.01" name="costo" min="1" value="<?php
					if(isset($_GET['datacost'])){
						 echo number_format( $_GET['datacost'] ,2,'.', '');

					 }else{
						 echo '1';
					 }?>">
					 <div class="invalid-feedback">
					   Ingrese un precio de compra válido.
					 </div>
					 <div class="valid-feedback">
					   ¡Perfecto!
					 </div>
                </div>

				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" name="iva" <?php
					if(isset($_GET['dataiva']) AND $_GET['dataiva'] == 'on'){
						echo 'checked';
					 }?>>
				     <label class="form-check-label">IVA (12%) incluido.</label>
				</div>
				<small class="text-muted">El IVA es calculado automaticamente. Si el monto lo incluye se debe indicar, para que el mismo sea ignorado.</small>

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
        <div class="col-sm-6">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">

						<a href="<?php echo HTTP ?>/registrar/pedido/paso-1?<?php echo datos_url($datos); ?>" class="btn btn-primary mb-2">Paso anterior</a>

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
										$cantidad = number_format( $datos['cantidades'][$i] ,0,',', ' ');
										$costo    = number_format( $datos['costos'][$i] ,2,',', '.');
										$precio   = number_format( $datos['precios'][$i] ,2,',', '.');

										echo '

										<div class="modal fade" tabindex="-1" id="editar-producto-' . $i . '">
										    <div class="modal-dialog modal-dialog-centered">
										        <form novalidate method="POST" action="'. HTTP .'/registrar/pedido/editar-producto?' .  datos_url($datos) .'" class="validar modal-content">
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
														<input required type="number" name="id" class="d-none" value="' . $i .'">
												      	<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Cantidad</label>
													      <div class="col-sm-6">
													        <input required type="number" step="0.01" min="0" value="'. $datos['cantidades'][$i] .'" class="form-control" name="cantidad">
															<div class="invalid-feedback">
															  Ingrese una cantidad a comprar válida.
															</div>
															<div class="valid-feedback">
															  ¡Perfecto!
															</div>
													      </div>

												    </div>

													<div class="form-group row mt-3">
												      	<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Precio de compra</label>
													      <div class="col-sm-6">
													        <input required type="number" step="0.01" min="0" value="'. number_format( $datos['costos'][$i] ,2,'.', '').'" class="form-control" name="costo">
															<div class="invalid-feedback">
															  Ingrese un precio de compra válida.
															</div>
															<div class="valid-feedback">
															  ¡Perfecto!
															</div>
													      </div>
												    </div>

													<div class="form-group form-check">
														<input type="checkbox" class="form-check-input" name="iva_costo">
													     <label class="form-check-label">IVA (12%) incluido.</label>
													</div>

													<hr>

													<div class="form-group row mt-3">
														<small class="text-muted mb-3">Puedes modificar el precio de venta de un producto al momento de generar un pedido, o puedes hacerlo más tarde desde el inventario.</small>
														<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Precio de venta</label>
														<div class="col-sm-6">
															<input required type="number" step="0.01" min="0" value="'. number_format( $datos['precios'][$i] ,2,'.', '') .'" class="form-control" name="precio">
															<div class="invalid-feedback">
															  Ingrese un precio de venta válido.
															</div>
															<div class="valid-feedback">
															  ¡Perfecto!
															</div>
														</div>
													</div>

													<div class="form-group form-check">
														<input type="checkbox" class="form-check-input" name="iva_precio">
													     <label class="form-check-label">IVA (12%) incluido.</label>
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

														<a href="'. HTTP .'/registrar/pedido/eliminar-producto?eliminar='. $i .'&'. datos_url($datos) .'" class="btn btn-danger btn-block btn-sm"><img  src="'. HTTP .'/recursos/cancel-white.svg" height="15px" width="15px" /></a>
														<button type="button" class="btn btn-secondary btn-block btn-sm" data-toggle="modal" data-target="#editar-producto-' . $i . '"><img  src="'. HTTP .'/recursos/edit.svg" height="15px" width="15px"/></button>
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
        <div class="col-sm-6 col-lg-5 container-fluid">

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

								$rif_div   = explode('-', $datos['proveedor']['rif']);
								$rif       = $rif_div[0] . '-' . number_format( $rif_div[1] ,0, ',','.');

								echo

								$datos['proveedor']['nombre_empresa'] .
								' | ' . $rif . '
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
									$cantidad    = number_format( $datos['cantidades'][$i] ,0,',', ' ');
									$costo       = $datos['costos'][$i];
									$subtotal    = number_format( $costo * $cantidad ,2,',', '.');

								echo '
								<li class="list-group-item list-group-item-action container-fluid">
	                                <div class="row">
	                                    <div class="col-sm-6 text-left">
	                                        <p class="mb-0 font-weight-bold">'. $producto['nombre_producto'] .'</p>
	                                        <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>
	                                    </div>
	                                    <div class="col-sm-6 text-right">
	                                        <p class="font-weight-bold mb-0 text-success ">Bs. '. $subtotal .'</p>
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

						<?php

						$subtotal = 0;

						for ($i=0; $i < count($datos['productos']); $i++) {
							$subtotal += $datos['costos'][$i] * $datos['cantidades'][$i];
						}

						echo '<div class="card-footer text-muted text-right">';
						echo 'SUBTOTAL  &nbsp;&nbsp;&nbsp; Bs. '  . number_format( $subtotal ,2,',', '.'). '<br>';
						echo 'IVA (12%) &nbsp;&nbsp;&nbsp; Bs. ' . number_format( ($subtotal * 12) / 100  ,2,',', '.'). '</div>';

						echo '<div class="card-footer text-center font-weight-bold">';
						echo 'TOTAL Bs. ' . number_format( $subtotal * 1.12 ,2,',', '.') . '</div>';

						 ?>
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
                    <a href="<?php echo HTTP ?>/registrar/pedido/paso-3?<?php echo datos_url($datos); ?>" class="btn btn-primary btn-block py-2">
                        Generar pedido
                    </a>
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
