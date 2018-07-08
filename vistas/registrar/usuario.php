<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header('registrar', 'Registrar', 'Usuario'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

<div class="row">
    <form class="col-md-8 col-lg-7 col-xl-6 container-fluid validar" method="POST" action="#" novalidate>
        <div class="row">
            <div class="col-sm-8 mb-3">
                <div class="card bg-light ">
                    <h6 class="card-header">Nombre</h6>
                    <div class="card-body">
                		<input required type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
						<div class="invalid-feedback">
						  Ingrese un nombre de usuario válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                	</div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-sm-8 mb-3">
                    <div class="card bg-light ">
                        <h6 class="card-header">Contraseña</h6>
                        <div class="card-body">
                        <input required type="password" class="form-control bg-light" min="0" name="contraseña" placeholder="Contraseña">
						<div class="invalid-feedback">
						  Ingrese una contraseña válida.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 mb-3">
                    <div class="card bg-light ">
                        <h6 class="card-header">Rango</h6>
                        <div class="card-body">
                        <select name="rango" required class="form-control bg-light">
                            <option value selected disabled>Selecciona un rango</option>
                            <option value="1">Administrador</option>
                            <option value="2">Operador</option>
                        </select>
						<div class="invalid-feedback">
						  Seleccione un rango válido.
						</div>
						<div class="valid-feedback">
						  ¡Perfecto!
						</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <button type="submit" name="nuevo-usuario" class="btn btn-primary btn-block py-2">Registrar usuario</button>
                </div>
            </div>
    </form>
</div>

</main>

<?php include_footer(); ?>
