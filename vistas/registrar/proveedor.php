<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header(4, 'Registrar', 'Proveedor'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

<div class="row">
    <form class="col-md-8 col-lg-7 col-xl-6 container-fluid" method="POST" action="#">

		<?php

		if(isset($err)){

			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Error al registrar</strong> Este proveedor ya se encuentra registrado en el sistema.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			';
		}

		?>

        <div class="row">
            <div class="col-sm-10 mb-3">
                <div class="card bg-light">
                    <h6 class="card-header">Nombre de proveedor</h6>
                    <div class="card-body">
                        <input required type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

        <div class="col-sm-5 mb-3">
            <div class="card bg-light">
                <h6 class="card-header">Rif</h6>
                <div class="card-body input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">J-</span>
					</div>
                    <input required type="text" class="form-control bg-light" min="0" name="rif" placeholder="Rif">
                </div>
            </div>
        </div>

        <div class="col-sm-5 mb-3">
            <div class="card bg-light">
                <h6 class="card-header">Teléfono</h6>
                <div class="card-body">
                    <input type="number" class="form-control bg-light" min="0" name="telefono" placeholder="Teléfono">
                </div>
            </div>
        </div>

        </div>
            <div class="row">
                <div class="col-sm-10 mb-3">
                    <div class="card bg-light">
                        <h6 class="card-header">Dirección</h6>
                        <div class="card-body">
                        <input required type="text" class="form-control bg-light" name="direccion" placeholder="Dirección">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <button type="submit" name="nuevo-proveedor" class="btn btn-primary btn-block py-2">Registrar proveedor</button>
                </div>
            </div>
    </form>
</div>

</main>


<?php include_footer(); ?>
