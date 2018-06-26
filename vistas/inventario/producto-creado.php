<?php include_head('CDA - Inventario'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.8">
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/producto.css?v=0.2">
</head>
<body>

<!-- MODAL BORRAR -->

<div class="modal fade" id="alerta-borrar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
            </div>
            <div class="modal-body">
                <p>
                    Estás intentando eliminar el producto: 
                    <b>"<?php echo $resultado['nombre_producto'] ?>"</b> del inventario.
                </p>
                <p class="text-justify">
                    Este y todos los datos asociados a el se perderan, las referencias y relaciones en las facturas creadas con anterioridad usando este producto tambien se perderán.
                </p>
                <small class="text-muted">
                Nota: Crear un producto con las mismas caracteristicas en el futuro no recuperará estas infomación, ni asociará el producto a las facturas antiguas.
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="?action=eliminar" class="btn btn-danger">Eliminar producto</a>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL BORRAR -->

<?php include_header(0, 'Inventario', 'Producto'); ?>

<main class="container-fluid  nav-spaced full-screen" id="navPush">

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Producto creado!</strong> Se ha creado con exito el nuevo producto, puedes verlo a continuación.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="row">
        <div class="col-md-6 container-fluid">

            <div class="row mb-0">
                <div class="col-12">
                    <a href="?action=editar" class="btn btn-primary" role="button">Editar</a>
                    <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#alerta-borrar">Eliminar</button> -->
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <h6 class="card-header">Nombre</h6>
                        <div class="card-body"><?php echo $resultado['nombre_producto'] ?></div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <h6 class="card-header">ID</h6>
                        <div class="card-body"><?php echo $resultado['codigo_producto'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                        <div class="card">
                            <h6 class="card-header">Tipo</h6>
                            <div class="card-body"><?php echo $resultado['tipo_producto'] ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <h6 class="card-header">Marca</h6>
                            <div class="card-body"><?php echo $resultado['marca_producto'] ?></div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <h6 class="card-header">Modelo</h6>
                        <div class="card-body"><?php echo $resultado['modelo_producto'] ?></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <h6 class="card-header">Existencias</h6>
                        <div class="card-body"><?php echo $resultado['existencias'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <h6 class="card-header">Precio</h6>
                        <div class="card-body"><?php echo $resultado['precio_venta'] ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 container-fluid">

                <h6 class="card-header">Ultimos movimientos</h6>
                <div class="card-body">
                    <div class="card text-white bg-danger mb-2">
                        <h6 class="card-header">Ventas</h6>
                        <div class="card-body">
                            <div class="font-weight-bold">-10 Existencias</div>
                        </div>
                        <div class="card-footer text-center text-white-50">20/10/2018</div>
                    </div>
                    <div class="card text-white bg-danger mb-2">
                        <h6 class="card-header">Ventas</h6>
                        <div class="card-body">
                            <div class="font-weight-bold">-10 Existencias</div>
                        </div>
                        <div class="card-footer text-center text-white-50">20/10/2018</div>
                    </div>
                    <div class="card text-white bg-success mb-2">
                        <h6 class="card-header">Ventas</h6>
                        <div class="card-body">
                            <div class="font-weight-bold">-10 Existencias</div>
                        </div>
                        <div class="card-footer text-center text-white-50">20/10/2018</div>
                    </div>
                    <div class="card text-white bg-success mb-2">
                        <h6 class="card-header">Ventas</h6>
                        <div class="card-body">
                            <div class="font-weight-bold">-10 Existencias</div>
                        </div>
                        <div class="card-footer text-center text-white-50">20/10/2018</div>
                    </div>
                    <div class="card text-white bg-danger mb-2">
                        <h6 class="card-header">Ventas</h6>
                        <div class="card-body">
                            <div class="font-weight-bold">-10 Existencias</div>
                        </div>
                        <div class="card-footer text-center text-white-50">20/10/2018</div>
                    </div>
                    <div class="card text-white bg-success mb-2">
                        <h6 class="card-header">Ventas</h6>
                        <div class="card-body">
                            <div class="font-weight-bold">-10 Existencias</div>
                        </div>
                        <div class="card-footer text-center text-white-50">20/10/2018</div>
                    </div>
                </div>

        </div>
    </div>

</main>

<?php include_footer(); ?>