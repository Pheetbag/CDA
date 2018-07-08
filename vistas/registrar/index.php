<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header('registrar', 'Registrar'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">

		<?php

			if($_SESSION['usuario']['rango'] > 1){

				$tipo_usuario      = 'secondary';
				$disabled_usuario  = 'disabled';

				$tipo_producto     = 'secondary';
				$disabled_producto = 'disabled';
			}else{

				$tipo_usuario      = 'primary';
				$disabled_usuario  = '';

				$tipo_producto     = 'primary';
				$disabled_producto = '';
			}

		?>

        <div class="col-sm-6 col-md-5 col-lg-4">

            <div class="card border-<?php echo $tipo_usuario ?> mb-4">
                <h6 class="card-header text-center">Usuario</h6>
                <div class="card-body text-<?php echo $tipo_usuario ?>">
                    <p class="card-text">Registra un nuevo usuario, para permitir el acceso al sistema desde una cuenta nueva.</p>
                    <a class="btn btn-<?php echo $tipo_usuario . ' ' . $disabled_usuario ?> mt-3 d-block" href="registrar/usuario">Registrar</a>
                </div>
            </div>

        </div>

		<div class="col-sm-6 col-md-5 col-lg-4">

            <div class="card border-<?php echo $tipo_producto ?> mb-4">
                <h6 class="card-header text-center">Producto</h6>
                <div class="card-body text-<?php echo $tipo_producto ?>">
                    <p class="card-text">Registra un nuevo producto en el sistema, para poder inventariarlo, venderlo y generar pedidos.</p>
                    <a class="btn btn-<?php echo $tipo_producto . ' ' . $disabled_producto ?> mt-3 d-block" href="registrar/producto">Registrar</a>
                </div>
            </div>

        </div>

    </div>

	<?php

		if($_SESSION['usuario']['rango'] > 2){

			$tipo_operador      = 'secondary';
			$disabled_operador  = 'disabled';

		}else{

			$tipo_operador      = 'primary';
			$disabled_operador  = '';

		}

	?>

	<div class="row">


		<div class="col-sm-6 col-md-5 col-lg-4">

			<div class="card border-<?php echo $tipo_operador ?> mb-4">
				<h6 class="card-header text-center">Proveedor</h6>
				<div class="card-body text-<?php echo $tipo_operador ?>">
					<p class="card-text">Registra un nuevo proveedor en el sistema, para generarle nuevos pedidos a dicho proveedor.</p>
					<a class="btn btn-<?php echo $tipo_operador . ' ' . $disabled_operador ?> mt-3 d-block" href="registrar/proveedor">Registrar</a>
				</div>
			</div>

		</div>

		<div class="col-sm-6 col-md-5 col-lg-4">

			<div class="card border-<?php echo $tipo_operador ?>  mb-4">
				<h6 class="card-header text-center">Pedido</h6>
				<div class="card-body text-<?php echo $tipo_operador ?> ">
					<p class="card-text">Registra un pedido para reponer las existencias, comprando a un proveedor.</p>
					<a class="btn btn-<?php echo $tipo_operador . ' ' . $disabled_operador ?> mt-3 d-block" href="registrar/pedido">Registrar</a>
				</div>
			</div>

		</div>

	</div>

    <div class="row">

		<div class="col-sm-6 col-md-5 col-lg-4">

			<div class="card border-primary mb-4">
				<h6 class="card-header text-center">Cliente</h6>
				<div class="card-body text-primary">
					<p class="card-text">Registra un nuevo cliente en el sistema, para generar asociadas al cliente.</p>
					<a class="btn btn-primary mt-3 d-block" href="registrar/cliente">Registrar</a>
				</div>
			</div>

		</div>

		<div class="col-sm-6 col-md-5 col-lg-4">

            <div class="card border-primary mb-4">
                <h6 class="card-header text-center">Factura</h6>
                <div class="card-body text-primary">
                    <p class="card-text">Registra una nueva factura, para vender productos del inventario.</p>
                    <a class="btn btn-primary mt-3 d-block" href="registrar/factura">Registrar</a>
                </div>
            </div>

        </div>

    </div>

</main>

<?php include_footer(); ?>
