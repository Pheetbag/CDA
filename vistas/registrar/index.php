<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header(4, 'Registrar'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">

        <div class="col-sm-4">

            <div class="card border-primary mb-4">
                <h6 class="card-header text-center">Usuario</h6>
                <div class="card-body text-primary">
                    <p class="card-text">Registra un nuevo usuario, para permitir el acceso al sistema desde una cuenta nueva.</p>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/usuario">Registrar</a>
                </div>
            </div>

        </div>


        <div class="col-sm-4">

            <div class="card border-primary mb-4">
                <h6 class="card-header text-center">Cliente</h6>
                <div class="card-body text-primary">
                    <p class="card-text">Registra un nuevo cliente en el sistema, para generar asociadas al cliente.</p>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/cliente">Registrar</a>
                </div>
            </div>

        </div>



    </div>

    <div class="row">

        <div class="col-sm-4">

            <div class="card border-primary mb-4">
                <h6 class="card-header text-center">Proveedor</h6>
                <div class="card-body text-primary">
                    <p class="card-text">Registra un nuevo proveedor en el sistema, para generarle nuevos pedidos a dicho proveedor.</p>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/proveedor">Registrar</a>
                </div>
            </div>

        </div>


        <div class="col-sm-4">

            <div class="card border-primary mb-4">
                <h6 class="card-header text-center">Producto</h6>
                <div class="card-body text-primary">
                    <p class="card-text">Registra un nuevo producto en el sistema, para poder inventariarlo, venderlo y generar pedidos.</p>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/producto">Registrar</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-sm-4">

            <div class="card border-primary mb-4">
                <h6 class="card-header text-center">Factura</h6>
                <div class="card-body text-primary">
                    <p class="card-text">Registra una nueva factura, para vender productos del inventario.</p>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/factura">Registrar</a>
                </div>
            </div>

        </div>


        <div class="col-sm-4">

            <div class="card border-primary mb-4">
                <h6 class="card-header text-center">Pedido</h6>
                <div class="card-body text-primary">
                    <p class="card-text">Registra un pedido para reponer las existencias, comprando a un proveedor.</p>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/pedido">Registrar</a>
                </div>
            </div>

        </div>

    </div>



</main>

<?php include_footer(); ?>
