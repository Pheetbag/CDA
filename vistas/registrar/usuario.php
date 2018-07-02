<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header(4, 'Registrar', 'Usuario'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

<div class="row">
    <form class="col-md-8 container-fluid" method="POST" action="#">
        <div class="row mb-3">
            <div class="col-sm-6">
                    <div class="card bg-light ">
                        <h6 class="card-header">Nombre</h6>
                        <div class="card-body">
                    <input required type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
                    </div>
                    </div>
                </div>
        </div>
        <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="card bg-light ">
                        <h6 class="card-header">Contraseña</h6>
                        <div class="card-body">
                        <input required type="password" class="form-control bg-light" min="0" name="contraseña" placeholder="Contraseña">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="card bg-light ">
                        <h6 class="card-header">Rango</h6>
                        <div class="card-body">
                        <select name="rango" required class="form-control bg-light">
                            <option value="1">Administrador</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-6">
                    <button type="submit" name="nuevo-usuario" class="btn btn-primary btn-block py-2">Registrar usuario</button>
                </div>
            </div>
    </form>
</div>

</main>

<?php include_footer(); ?>
