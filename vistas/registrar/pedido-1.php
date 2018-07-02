<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.5">
</head>
<body>

<?php include_header(4, 'Registrar', 'Pedido'); ?>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar-proveedor">
  Launch demo modal
</button> -->

<div class="modal fade" tabindex="-1" id="agregar-proveedor">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="/registrar/pedido/registrar-proveedor?<?php echo datos_url($datos); ?>" class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Proveedor nuevo</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-warning" role="alert">
                El rif <b>J-<?php  echo $datos['rif'] ?></b> no pertenece a ningún proveedor registrado. Inserta los datos del proveedor para continuar.
            </div>
                <div class="row">
                    <div class="form-group col">
                        <label required for="proveedor-nombre">Nombre</label>
                        <input type="text" class="form-control" id="proveedor-nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group col">
                        <label for="proveedor-tlf">Teléfono</label>
                        <input type="text" class="form-control" id="proveedor-tlf" name="tlf" placeholder="Teléfono">
                    </div>
                </div>
                <div class="form-group">
                    <label required for="cliente-dir">Dirección</label>
                    <input type="text" class="form-control" id="cliente-dir" name="dir" placeholder="Dirección">
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

            <form class="container-fluid" method="POST" action="/registrar/pedido/validar-proveedor?<?php echo datos_url($datos); ?>" >

                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="card mb-3">
                            <h6 class="card-header">Fecha</h6>
                            <div class="card-body">
                                <input required type="date" class="form-control bg-light" name="fecha" value="<?php echo $datos['fecha'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="card mb-3">
                            <h6 class="card-header">Fecha de llegada</h6>
                            <div class="card-body">
                                <input required type="date" class="form-control bg-light" name="llegada" value="<?php echo $datos['llegada'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="card mb-3">
                            <h6 class="card-header">Seleccionar proveedor</h6>

                            <div class="card-body">
                                <input required type="number" class="form-control" name="rif" placeholder="Rif" value="<?php echo $datos['rif'] ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 col-lg-8">
                        <button type="submit" name="nuevo-producto" class="btn btn-primary btn-block py-2">
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
										$subtotal    = $costo * $cantidad;

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
							?>

                        </ul>

						<?php

						$subtotal = 0;

						for ($i=0; $i < count($datos['productos']); $i++) {
							$subtotal += $datos['costos'][$i] * $datos['cantidades'][$i];
						}

						echo '<div class="card-footer text-muted text-right">';
						echo 'SUBTOTAL  &nbsp;&nbsp;&nbsp; Bs. '  . $subtotal . '<br>';
						echo 'IVA (12%) &nbsp;&nbsp;&nbsp; Bs. ' . ($subtotal * 12) / 100 . '</div>';

						echo '<div class="card-footer text-center font-weight-bold">';
						echo 'TOTAL Bs. ' . $subtotal * 1.12 . '</div>';

						 ?>
                    </div>

                </div>
            </div>


        </div>
    </div>
</main>

<?php

if(isset($_GET['error'])){
    include_footer("
    <script type='    text/javascript'    >
    $(window).on('load',function(){
        $('#agregar-proveedor').modal('show');
    });
    </script>");

}else{

    include_footer();

}


?>
