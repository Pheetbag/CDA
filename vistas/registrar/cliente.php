<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header('registrar', 'Registrar', 'Cliente'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

<div class="row">
    <form class="col-md-8 col-lg-7 col-xl-6 container-fluid validar" method="POST" action="#" novalidate>
		<?php

		if(isset($err)){

			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Error al registrar</strong> Este cliente ya se encuentra registrado en el sistema.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			';
		}

		?>
    <div class="row">

        <div class="col-sm-5 mb-3">
            <div class="card bg-light ">
                <h6 class="card-header">Nombre</h6>
                <div class="card-body">
                    <input required type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
					<div class="invalid-feedback">
					  Ingrese un nombre válido.
					</div>
					<div class="valid-feedback">
					  ¡Perfecto!
					</div>
                </div>
            </div>
        </div>
        <div class="col-sm-5 mb-3">
            <div class="card bg-light ">
                <h6 class="card-header">Apellido</h6>
                <div class="card-body">
                    <input required type="text" class="form-control bg-light" name="apellido" placeholder="Apellido">
					<div class="invalid-feedback">
					  Ingrese un apellido válido.
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
            <div class="card bg-light ">
                <h6 class="card-header">Cedula</h6>
                <div class="card-body row">
					<select required class="form-control col-4 col-xl-3 ml-3 mr-1" name="ci-prefijo">
						<option selected value="V">V</option>
						<option value="E">E</option>
					</select>

					<div class="col mr-3 px-0">
						<input required type="number" class="form-control bg-light" min="0" name="ci" placeholder="Cedula">
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

        <div class="col-sm-5 mb-3">
            <div class="card bg-light ">
                <h6 class="card-header">Teléfono</h6>
                <div class="card-body">
                <input type="number" class="form-control bg-light" min="0" name="telefono" placeholder="Teléfono">
				<div class="invalid-feedback">
				  Ingrese un numero de teléfono válido.
				</div>
				<div class="valid-feedback">
				  ¡Perfecto!
				</div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-10 mb-3">
            <div class="card bg-light ">
                <h6 class="card-header">Dirección</h6>
                <div class="card-body">
                <input required type="text" class="form-control bg-light" name="direccion" placeholder="Dirección">
				<div class="invalid-feedback">
				  Ingrese una dirección válida.
				</div>
				<div class="valid-feedback">
				  ¡Perfecto!
				</div>
                </div>
            </div>
        </div>
    </div>

            <div class="row mb-0">
                <div class="col-sm-10">
                    <button type="submit" name="nuevo-cliente" class="btn btn-primary btn-block py-2">Registrar cliente</button>
                </div>
            </div>
    </form>
</div>

</main>

<?php include_footer(); ?>
