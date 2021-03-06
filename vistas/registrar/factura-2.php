<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.5">
</head>
<body>

<?php include_header('registrar', 'Registrar', 'Factura'); ?>


<div class="modal fade" tabindex="-1" id="agregar-producto">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content validar"  action="<?php echo HTTP ?>/registrar/factura/agregar-producto?<?php echo datos_url($datos); ?>" method="POST" novalidate>
        <div class="modal-header">
            <h5 class="modal-title">Agregar producto a la factura</h5>
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
                    <select name="codigo" required class="form-control" id="exampleFormControlSelect1">
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
                    <label for="agregar-cantidad">Cantidad</label>
                    <input class="form-control" required type="number" name="cantidad" min="1" value="<?php
					if(isset($_GET['dataext'])){
						 echo $_GET['dataext'];

					 }else{
						 echo '1';
					 }?>">
					 <div class="invalid-feedback">
					   Ingrese una cantidad a facturar válida.
					 </div>
					 <div class="valid-feedback">
					   ¡Perfecto!
					 </div>
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
        <div class="col-sm-6">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">

						<a href="<?php echo HTTP ?>/registrar/factura/paso-1?<?php echo datos_url($datos); ?>" class="btn btn-primary mb-2">Paso anterior</a>

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

											if(isset($_GET['err']) AND $_GET['err'] == 'existencia-edit' AND $_GET['datacodigo'] == $i){

												$cantidades = $_GET['dataext'];
												$cantidades_err =
												'<div class="alert alert-warning">
													Este producto no tiene las existencias suficientes. Restan <b>' . number_format( $_GET['errext'] ,0,',', ' ') . '</b> en el inventario.
												</div>';
											}else {

												$cantidades = $datos['cantidades'][$i];
												$cantidades_err = '';
											}

											$producto = $consultar->get('producto', $datos['productos'][$i]);
											$cantidad = number_format( $datos['cantidades'][$i] ,0,',', ' ');
											echo '

											<div class="modal fade" tabindex="-1" id="editar-producto-' . $i . '">
											    <div class="modal-dialog modal-dialog-centered">
											        <form method="POST" action="'. HTTP .'/registrar/factura/editar-producto?' .  datos_url($datos) .'" class="modal-content validar" novalidate>
											        <div class="modal-header">
											            <h5 class="modal-title">Editando producto</h5>
											        </div>
											        <div class="modal-body">
														<div class="container-fluid">

														<div class="row">
					                                        <div class="col-6 d-flex flex-column justify-content-around align-items-start mb-md-0 mb-2">
					                                            <p class="font-weight-bold mb-0">'. $producto['nombre_producto'] .'</p>
					                                            <p class="font-weight-bold mb-0 text-success ">Bs.S '. number_format( $producto['precio_venta'] ,2,',', '.') .'</p>
					                                            <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>

					                                        </div>
					                                        <div class="col-6 d-flex flex-column align-items-end justify-content-around mb-md-0 mb-2">
					                                            <p class="mb-0">Tipo: '.$producto['tipo_producto'].'</p>
					                                            <p class="mb-0">Marca: '.$producto['marca_producto'].'</p>
					                                            <p class="mb-0 ">Modelo: '.$producto['modelo_producto'].'</p>
					                                        </div>
					                                    </div>

														<br><hr>
														'. $cantidades_err .'
														<div class="form-group row mt-3">
															<input required type="number" name="id" class="d-none" value="' . $i .'">
													      <label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Cantidad</label>
													      <div class="col-sm-6">
													        <input required type="number" min="0" value="'. $cantidades .'" class="form-control" name="editar">
															<div class="invalid-feedback">
															  Ingrese una cantidad a facturar válida.
															</div>
															<div class="valid-feedback">
															  ¡Perfecto!
															</div>
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
				                                            <p class="mb-0">Cantidad: '. $cantidad .'</p>
				                                        </div>
				                                        <div class="col-sm-6 col-md-4 d-flex flex-column align-items-center justify-content-around mb-md-0 mb-2">
				                                            <p class="font-weight-bold mb-0 text-success ">Bs.S '. number_format( $producto['precio_venta'] ,2,',', '.') .'</p>
				                                            <p class="mb-0">Tipo: '.$producto['tipo_producto'].'</p>
				                                            <p class="mb-0">Marca: '.$producto['marca_producto'].'</p>
				                                            <p class="mb-0 ">Modelo: '.$producto['modelo_producto'].'</p>
				                                        </div>
														<div class="col-sm-12 col-md-3 d-flex flex-column align-items-center justify-content-around">

															<a href="'. HTTP .'/registrar/factura/eliminar-producto?eliminar='. $i .'&'. datos_url($datos) .'" class="btn btn-danger btn-block btn-sm"><img  src="'. HTTP .'/recursos/cancel-white.svg" height="15px" width="15px" /></a>
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
			<button type="button" class="btn btn-danger btn-block btn-sm"><img  src="/recursos/cancel-white.svg" height="15px" width="15px"/></button>
			<button type="button" class="btn btn-secondary btn-block btn-sm"><img  src="/recursos/edit.svg" height="15px" width="15px"/></button>
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
            <div class="row mb-4">
                <div class="col-sm-12">

                    <div class="card">
                        <h6 class="card-header text-center px-5">
                            <?php echo($datos['cliente']['nombre_cliente'] . ' ' . $datos['cliente']['apellido_cliente']) ?>
                            |
                            <?php

							$rif_div   = explode('-', $datos['cliente']['ci_cliente']);
							$rif       = $rif_div[0] . '-' . number_format( $rif_div[1] ,0, ',','.');

							echo $rif ?>
                            <br><br>
                            <?php echo $datos['cliente']['direccion_cliente'] ?>
                            <br>
                            <?php echo $datos['cliente']['telefono'] ?>
                        </h6>
                        <h6 class="card-header text-muted text-center">
                        <?php echo(date('d/m/Y',strtotime($datos['fecha']))) ?>
                        </h6>
                        <ul class="list-group list-group-flush">

							<?php

								if($datos['productos'] == null){

									echo'

										<div class="p-5"></div>

									';

								}else{

									$cantidad_productos = count($datos['productos']);
									$subtotal = 0;

									for ($i=0; $i < $cantidad_productos; $i++) {

										$producto = $consultar->get('producto', $datos['productos'][$i]);
										$cantidad = number_format( $datos['cantidades'][$i] ,0,',', ' ');
										$subtotal = number_format( $datos['subtotales'][$i] ,2,',', '.');

									echo '
									<li class="list-group-item list-group-item-action container-fluid">
		                                <div class="row">
		                                    <div class="col-sm-6 text-left">
		                                        <p class="mb-0 font-weight-bold">'. $producto['nombre_producto'] .'</p>
		                                        <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>
		                                    </div>
		                                    <div class="col-sm-6 text-right">
		                                        <p class="font-weight-bold mb-0 text-success ">Bs.S '. $subtotal .'</p>
		                                        <p class="mb-0">x'. $cantidad .'</p>
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

						for ($i=0; $i < count($datos['subtotales']); $i++) {
							$subtotal += $datos['subtotales'][$i];
						}

						echo '<div class="card-footer text-muted text-right">';
						echo 'SUBTOTAL  &nbsp;&nbsp;&nbsp; Bs.S '  . number_format( $subtotal ,2,',', '.') . '<br>';
						echo 'IVA (16%) &nbsp;&nbsp;&nbsp; Bs.S ' . number_format( ($subtotal * 16) / 100 ,2,',', '.') . '</div>';

						echo '<div class="card-footer text-center font-weight-bold">';
						echo 'TOTAL Bs.S ' . number_format( $subtotal * 1.16 ,2,',', '.') . '</div>';

						 ?>
					</div>
                </div>
            </div>


			<div class="row">
                <div class="col-sm-12">
                    <a href="<?php echo HTTP ?>/registrar/factura/paso-3?<?php echo datos_url($datos); ?>" class="btn btn-primary btn-block py-2">
                        Facturar
                    </a>
                </div>
			</div>


        </div>
    </div>
</main>


<?php
if(isset($_GET['err'])){

switch ($_GET['err']) {

	case 'producto':
		include_footer("
		<script type='    text/javascript'    >
		$(window).on('load',function(){
		    $('#agregar-producto').modal('show');
		});
		</script>");
		break;

	case 'existencia':
		include_footer("
		<script type='    text/javascript'    >
		$(window).on('load',function(){
			$('#agregar-producto').modal('show');
		});
		</script>");
		break;

	case 'repetido':
		include_footer("
		<script type='    text/javascript'    >
		$(window).on('load',function(){
			$('#agregar-producto').modal('show');
		});
		</script>");
		break;

	case 'existencia-edit':
		include_footer("
		<script type='    text/javascript'    >
		$(window).on('load',function(){
			$('#editar-producto-". $_GET['datacodigo'] ."').modal('show');
		});
		</script>");
		break;
	}
}else{

    include_footer();

}



?>
