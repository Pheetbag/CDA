<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header('registrar', 'Registrar', 'Producto'); ?>


<main class="container-fluid nav-spaced full-screen" id="navPush">

<div class="row">
    <form class="col-md-8 col-lg-7 col-xl-6 container-fluid validar" method="POST" action="#" novalidate>

        <div class="row">
            <div class="col-sm-5 mb-3">
                <div class="card bg-light">
                    <h6 class="card-header">Nombre</h6>
                    <div class="card-body">
                        <input required type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
						<div class="invalid-feedback">
						  Ingrese un nombre de producto válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5 mb-3">
                <div class="card bg-light">
                    <h6 class="card-header">Tipo</h6>
                    <div class="card-body">
                        <input type="text" class="form-control bg-light" name="tipo" placeholder="Tipo">
						<div class="invalid-feedback">
						  Ingrese un tipo de producto válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-5 mb-3">
                <div class="card bg-light">
                    <h6 class="card-header">Marca</h6>
                    <div class="card-body">
                        <input type="text" class="form-control bg-light" name="marca" placeholder="Marca">
						<div class="invalid-feedback">
						  Ingrese una marca de producto válida.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 mb-3">
                <div class="card bg-light">
                    <h6 class="card-header">Modelo</h6>
                    <div class="card-body">
	                    <input type="text" class="form-control bg-light" min="0" name="modelo" placeholder="Modelo">
						<div class="invalid-feedback">
						  Ingrese un modelo de producto válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                    </div>
                </div>
            </div>


        </div>

            <div class="row">
            <div class="col-sm-5 mb-3">
                    <div class="card bg-light">
                        <h6 class="card-header">Precio</h6>
                        <div class="card-body">
                        	<input required type="number" class="form-control bg-light" min="0" step="0.01" name="precio" placeholder="Precio">
							<div class="invalid-feedback">
							  Ingrese un precio de producto válido.
							</div>
							<div class="valid-feedback">
							  ¡Perfecto!
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 mb-3">
                    <div class="card bg-light">
                        <h6 class="card-header">Existencias</h6>
                        <div class="card-body">
                        <input required type="number" class="form-control bg-light" min="0" name="existencias" placeholder="Existencias">
						<div class="invalid-feedback">
						  Ingrese un número de existencias válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <button type="submit" name="nuevo-producto" class="btn btn-primary btn-block py-2">Registrar producto</button>
                </div>
            </div>
    </form>
</div>

</main>

<?php include_footer(); ?>
