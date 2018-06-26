<?php include_head('CDA - Inventario'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.8">
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/producto.css?v=0.2">
</head>
<body>

<?php include_header(0, 'Producto', 'Eliminado'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 container-fluid">
            <div class="alert alert-success m-5" role="alert">
                <h4 class="alert-heading">Producto eliminado!</h4>
                <p>Se ha eliminado exitosamente el producto: <b>"<?php echo $resultado['nombre_producto'] ?>"</b> de el inventario del sistema.</p>
                <hr>
                <small class="mb-0">Recuerda que todos las referencias a este producto en facturas de proveedores o clientes se perderan, aún así seguiran haciendo referencia a esta ID que se encuentra reservada de por vida.</small>
            </div>
        </div>
    </div>

</main>

<?php include_footer(); ?>