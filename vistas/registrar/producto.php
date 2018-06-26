<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header(4, 'Registrar', 'Producto'); ?>


<main class="container-fluid nav-spaced full-screen" id="navPush">

<div class="row">
    <form class="col-md-8 container-fluid" method="POST" action="#">

        <div class="row mb-3">
            <div class="col-4">
                <div class="card bg-light">
                    <h6 class="card-header">Nombre</h6>
                    <div class="card-body">
                        <input type="text" class="form-control bg-light" name="nombre" placeholder="Nombre">
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card bg-light">
                    <h6 class="card-header">Tipo</h6>
                    <div class="card-body">
                        <input type="text" class="form-control bg-light" name="tipo" placeholder="Tipo">
                    </div>
                </div>
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-sm-4">
                <div class="card bg-light">
                    <h6 class="card-header">Marca</h6>
                    <div class="card-body">
                        <input type="text" class="form-control bg-light" name="marca" placeholder="Marca">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <h6 class="card-header">Modelo</h6>
                    <div class="card-body">
                    <input type="text" class="form-control bg-light" min="0" name="modelo" placeholder="Modelo">
                    </div>
                </div>
            </div>


        </div>

            <div class="row mb-3">
            <div class="col-sm-4">
                    <div class="card bg-light">
                        <h6 class="card-header">Precio</h6>
                        <div class="card-body">
                        <input type="number" class="form-control bg-light" min="0" name="precio" placeholder="Precio">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-light">
                        <h6 class="card-header">Existencias</h6>
                        <div class="card-body">
                        <input type="number" class="form-control bg-light" min="0" name="existencias" placeholder="Existencias">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-8">
                    <button type="submit" name="nuevo-producto" class="btn btn-primary btn-block py-2">Registrar producto</button>
                </div>
            </div>
    </form>
</div>

</main>

<?php include_footer(); ?>