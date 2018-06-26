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
                    <input type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
                    </div>
                    </div>
                </div>
        </div>
        <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="card bg-light ">
                        <h6 class="card-header">Contraseña</h6>
                        <div class="card-body">
                        <input type="number" class="form-control bg-light" min="0" name="ci" placeholder="Contraseña">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="card bg-light ">
                        <h6 class="card-header">Rango</h6>
                        <div class="card-body">
                        <select class="form-control bg-light" id="exampleFormControlSelect1">
                            <option>Administrador</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-6">
                    <button type="submit" name="nuevo-cliente" class="btn btn-primary btn-block py-2">Registrar usuario</button>
                </div>
            </div>
    </form>
</div>

</main>

<?php include_footer(); ?>