<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.5">
</head>
<body>

<?php include_header('registrar', 'Registrar', 'Factura'); ?>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar-cliente">
  Launch demo modal
</button> -->

<div class="modal fade" tabindex="-1" id="agregar-cliente">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="<?php echo HTTP ?>/registrar/factura/registrar-cliente?<?php echo datos_url($datos); ?>" class="modal-content validar" novalidate>
        <div class="modal-header">
            <h5 class="modal-title">Cliente nuevo</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-warning" role="alert">
                La cedula <b><?php

				$ci_div   = explode('-', $datos['ci']);
				$ci       = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

				echo $ci ?></b> no pertenece a ningún cliente registrado. Inserta sus datos para continuar.
            </div>
            <div>
                <div class="row">
                    <div class="form-group col">
                        <label for="cliente-nombre">Nombre</label>
                        <input required type="text" class="form-control" id="cliente-nombre" name="nombre" placeholder="Nombre">
						<div class="invalid-feedback">
						  Ingrese un nombre válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                    </div>
                    <div class="form-group col">
                        <label for="cliente-apellido">Apellido</label>
                        <input required type="text" class="form-control" id="cliente-apellido" name="apellido" placeholder="Apellido">
						<div class="invalid-feedback">
						  Ingrese un apellido válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cliente-dir">Dirección</label>
                    <input required type="text" class="form-control" id="cliente-dir" name="dir" placeholder="Dirección">
					<div class="invalid-feedback">
					  Ingrese una dirección válida.
					</div>
					<div class="valid-feedback">
					  ¡Perfecto!
					</div>
                </div>
                <div class="form-group">
                    <label for="cliente-tlf">Teléfono</label>
                    <input type="number" class="form-control" id="cliente-tlf" name="tlf" placeholder="Teléfono">
					<div class="invalid-feedback">
					  Ingrese un número de teléfono válido.
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

            <form class="container-fluid validar" method="POST" action="<?php echo HTTP ?>/registrar/factura/validar-cliente?<?php echo datos_url($datos); ?>" novalidate>

                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="card mb-3">
                            <h6 class="card-header">Fecha</h6>
                            <div class="card-body">
                                <input required type="date" class="form-control bg-light" name="fecha" value="<?php echo $datos['fecha'] ?>">
								<div class="invalid-feedback">
								  Ingrese una fecha válida.
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="card mb-3">
                            <h6 class="card-header">Seleccionar cliente</h6>

                            <div class="card-body row">

								<select required class="form-control col-3 col-sm-4 col-md-3 col-xl-2 ml-3 mr-1" name="ci-prefijo">
									<?php


										$selected_v = null;
										$selected_e = null;

										switch ($datos['ci-prefijo']) {
											case 'E':
												$selected_e = 'selected';
												break;

											default:
												$selected_v = 'selected';
												break;
										}

										echo '
										<option '. $selected_v .' value="V">V</option>
										<option '. $selected_e .' value="E">E</option>
										';

									?>
								</select>
								<div class="col mr-3 px-0">
	                                <input required type="number" class="form-control" name="ci" placeholder="Cedula" value="<?php echo $datos['ci-numero'] ?>">
									<div class="invalid-feedback">
									  Ingrese un número de cédula válido.
									</div>
									<div class="valid-feedback">
									  ¡Perfecto!
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 col-lg-8">
                        <button type="submit" class="btn btn-primary btn-block py-2">
                            Continuar
                        </button>
                    </div>
                </div>

            </form>

        </div>
        <div class="col-sm-6 col-lg-5 container-fluid">

            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="progress" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated
                    bg-success font-weight-bold" style="width:33.3%;">Paso 1</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <h6 class="card-header text-center px-5">

							<?php

							if($datos['cliente'] != null){

								$ci_div   = explode('-', $datos['cliente']['ci_cliente']);
								$ci       = $ci_div[0] . '-' . number_format( $ci_div[1] ,0, ',','.');

								echo

								$datos['cliente']['nombre_cliente'] . ' ' . $datos['cliente']['apellido_cliente'] .
								' | ' . $ci . '
								<br><br>' .
								$datos['cliente']['direccion_cliente'] .
								' <br>' .
								$datos['cliente']['telefono']
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
									$subtotal = 0;

									for ($i=0; $i < $cantidad_productos; $i++) {

										$producto = $consultar->get('producto', $datos['productos'][$i]);
										$cantidad = $datos['cantidades'][$i];
										$subtotal = $datos['subtotales'][$i];

									echo '
									<li class="list-group-item list-group-item-action container-fluid">
		                                <div class="row">
		                                    <div class="col-sm-6 text-left">
		                                        <p class="mb-0 font-weight-bold">'. $producto['nombre_producto'] .'</p>
		                                        <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>
		                                    </div>
		                                    <div class="col-sm-6 text-right">
		                                        <p class="font-weight-bold mb-0 text-success ">Bs.S '. number_format( $subtotal ,2,',', '.') .'</p>
		                                        <p class="mb-0">x'. number_format( $cantidad ,0,',', ' ') .'</p>
		                                    </div>
		                                </div>
		                            </li>
									';

									}
								}
							?>


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
						echo 'TOTAL Bs.S ' . number_format( $subtotal * 1.16  ,2,',', '.'). '</div>';

						 ?>
					 </div>
                </div>
            </div>


        </div>
    </div>
</main>



<?php

if($datos['error'] == 'cliente'){
    include_footer("
    <script type='    text/javascript'    >
    $(window).on('load',function(){
        $('#agregar-cliente').modal('show');
    });
    </script>");

}else{

    include_footer();

}


?>
