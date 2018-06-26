<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header(4, 'Registrar', 'Cliente'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

<div class="row">
    <form class="col-md-8 container-fluid" method="POST" action="#">
    <div class="row mb-3">

        <div class="col-sm-4">
            <div class="card bg-light ">
                <h6 class="card-header">Nombre</h6>
                <div class="card-body">
                    <input type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-light ">
                <h6 class="card-header">Apellido</h6>
                <div class="card-body">
                    <input type="text" class="form-control bg-light" name="apellido" placeholder="Apellido">
                </div>
            </div>
        </div>

    </div>

    <div class="row mb-3">
        <div class="col-sm-4">
            <div class="card bg-light ">
                <h6 class="card-header">Cedula</h6>
                <div class="card-body">
                <input type="number" class="form-control bg-light" min="0" name="ci" placeholder="Cedula">
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card bg-light ">
                <h6 class="card-header">Teléfono</h6>
                <div class="card-body">
                <input type="number" class="form-control bg-light" min="0" name="telefono" placeholder="Teléfono">
                </div>
            </div>
        </div>

    </div>
    <div class="row mb-3">
        <div class="col-sm-8">
            <div class="card bg-light ">
                <h6 class="card-header">Dirección</h6>
                <div class="card-body">
                <input type="text" class="form-control bg-light" name="direccion" placeholder="Dirección">
                </div>
            </div>
        </div>
    </div>

            <div class="row mb-0">
                <div class="col-8">
                    <button type="submit" name="nuevo-cliente" class="btn btn-primary btn-block py-2">Registrar cliente</button>
                </div>
            </div>
    </form>
</div>

</main>

<?php include_footer(); ?>