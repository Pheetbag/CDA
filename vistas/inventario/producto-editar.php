<?php include_head('CDA - Inventario'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.8">
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/producto.css?v=0.2">
</head>
<body>

<?php include_header(0, 'Producto', 'Editar'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">
        <form class="col-md-6 col-lg-8 container-fluid" method="POST" action="?action=guardar">

            <div class="row mb-0">
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="/inventario/producto/<?php echo $resultado['codigo_producto'] ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card bg-white ">
                        <h6 class="card-header">Nombre</h6>
                        <div class="card-body">
                        <input type="text" class="form-control bg-light" name="nombre" placeholder="Nombre" value="<?php echo $resultado['nombre_producto'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-white ">
                        <h6 class="card-header">ID</h6>
                        <div class="card-body">
                            <input type="text" class="form-control" disabled name="id" placeholder="ID" value="<?php echo $resultado['codigo_producto'] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                        <div class="card bg-white ">
                            <h6 class="card-header">Tipo</h6>
                            <div class="card-body">
                        <input type="text" class="form-control bg-light" name="tipo" placeholder="Tipo" value="<?php echo $resultado['tipo_producto'] ?>">
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card bg-white ">
                            <h6 class="card-header">Marca</h6>
                            <div class="card-body">
                        <input type="text" class="form-control bg-light" name="marca" placeholder="Marca" value="<?php echo $resultado['marca_producto'] ?>">
                        </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card bg-white ">
                        <h6 class="card-header">Modelo</h6>
                        <div class="card-body">
                        <input type="text" class="form-control bg-light" min="0" name="modelo" placeholder="Modelo" value="<?php echo $resultado['modelo_producto'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-white ">
                        <h6 class="card-header">Existencias</h6>
                        <div class="card-body">
                        <input type="number" class="form-control bg-light" min="0" name="existencias" placeholder="Existencias" value="<?php echo $resultado['existencias'] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card bg-white ">
                        <h6 class="card-header">Precio</h6>
                        <div class="card-body">
                        <input type="number" class="form-control bg-light" name="precio" placeholder="Precio" value="<?php echo $resultado['precio_venta'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</main>

<?php include_footer(); ?>