<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.5">
</head>
<body>

<?php include_header(4, 'Registrar', 'Factura'); ?>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar-cliente">
  Launch demo modal
</button> -->

<div class="modal fade" tabindex="-1" id="agregar-cliente">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="/registrar/factura/registrar-cliente?<?php echo datos_url($datos); ?>" class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cliente nuevo</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-warning" role="alert">
                La cedula <b>V-<?php  echo $datos['ci'] ?></b> no pertenece a ningún cliente registrado. Inserta sus datos para continuar.
            </div>
            <div>
                <div class="row">
                    <div class="form-group col">
                        <label for="cliente-nombre">Nombre</label>
                        <input type="text" class="form-control" id="cliente-nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group col">
                        <label for="cliente-apellido">Apellido</label>
                        <input type="text" class="form-control" id="cliente-apellido" name="apellido" placeholder="Apellido">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cliente-dir">Dirección</label>
                    <input type="text" class="form-control" id="cliente-dir" name="dir" placeholder="Dirección">
                </div>
                <div class="form-group">
                    <label for="cliente-tlf">Telefono</label>
                    <input type="text" class="form-control" id="cliente-tlf" name="tlf" placeholder="Teléfono">
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

            <form class="container-fluid" method="POST" action="/registrar/factura/validar-cliente?<?php echo datos_url($datos); ?>">

                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="card mb-3">
                            <h6 class="card-header">Fecha</h6>
                            <div class="card-body">
                                <input type="date" class="form-control bg-light" name="fecha" value="<?php echo $datos['fecha'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="card mb-3">
                            <h6 class="card-header">Seleccionar cliente</h6>

                            <div class="card-body">
                                <input type="number" class="form-control" name="ci" placeholder="Cedula" value="<?php echo $datos['ci'] ?>">
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
        <div class="col-md-6 col-lg-5 container-fluid">

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

							if($datos['ci'] != null){

								echo

								$datos['cliente']['nombre_cliente'] . ' ' . $datos['cliente']['apellido_cliente'] .
								' | ' . '
								V-' . $datos['cliente']['ci_cliente'] . '
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

									for ($i=0; $i < $cantidad_productos; $i++) {

										$producto = $consultar->get('producto', $datos['productos'][$i]);
										$cantidad = $datos['cantidades'][$i];
										$precio_total = $producto['precio_venta'] * $cantidad;
										$datos['subtotal']  += $precio_total;

									echo '
									<li class="list-group-item list-group-item-action container-fluid">
		                                <div class="row">
		                                    <div class="col-sm-6 text-left">
		                                        <p class="mb-0 font-weight-bold">'. $producto['nombre_producto'] .'</p>
		                                        <p class="mb-0">Codigo: '. $producto['codigo_producto'] .'</p>
		                                    </div>
		                                    <div class="col-sm-6 text-right">
		                                        <p class="font-weight-bold mb-0 text-success ">Bs. '. $precio_total .'</p>
		                                        <p class="mb-0">x'. $cantidad .'</p>
		                                    </div>
		                                </div>
		                            </li>
									';

									}
								}
							?>


                        </ul>

						<div class="card-footer text-muted text-right">
                            SUBTOTAL Bs. <?php echo $datos['subtotal'] ?><!--
                            --><br>
							IVA: <?php echo (($datos['subtotal'] * 12) /100)  ?>
                        </div>

                        <div class="card-footer text-center font-weight-bold">
                            TOTAL Bs. <?php echo($datos['subtotal'] * 1.12) ?>
                        </div>
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
