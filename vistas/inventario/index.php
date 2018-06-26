<?php include_head('CDA - Inventario'); ?>

<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.7">
</head>
<body>

<?php include_header(0,'Inventario'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">
    <div class="row">
        <div class="col-md-3 col-sm-12">

            <div class="card mb-4">
                <h6 class="card-header">Buscar</h6>
                <form class="card-body" action="/inventario/buscar" method="GET">
                    <div class="form-group mb-0">
                        <input type="text" name="busqueda" id="" class="form-control" placeholder="Buscar en el inventario">
                        <button type="submit" class="btn btn-primary mt-3 btn-block">Buscar</button>
                    </div>
                </form>
            </div>

<!-- ESTO SE ELIMINO, SE DEJA COMENTADO EN CASO DE UTILIDAD FUTURA -->

            <!-- <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Nuevo producto</h6>
                    <small class="card-text">Registra un nuevo producto en el inventario.</small>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/producto">Crear nuevo</a>
                </div>
            </div> -->

        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <h6 class="card-header">Productos</h6>
                <ul class="list-group list-group-flush">
                    <?php

                    if($resultado != null){
                        foreach($resultado as $item){

                            echo '
                            <a href="/inventario/producto/'. $item['codigo_producto'] .'" class="list-group-item list-group-item-action container-fluid">
                                <div class="row">
                                    <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                        <div class="font-weight-bold">'   . $item['nombre_producto'] . '</div>
                                        <div>Modelo: '                    . $item['modelo_producto'] . '</div>
                                    </div>
                                    <div class="col-6 col-sm-4 left align-items-center align-items-sm-end">
                                        <div class="text-muted">Tipo: '   . $item['tipo_producto']   . '</div>
                                        <div class="text-muted">Marca: '  . $item['marca_producto']  . '</div>
                                    </div>
                                    <div class="col-6 col-sm-4 right align-items-center">
                                        <div class="producto-precio text-success font-weight-bold">Bs. '. $item['precio_venta'] .'</div>
                                        <div class="producto-existencias text-muted">'. $item['existencias'] .' en stock</div>
                                    </div>
                                </div>
                            </a>';
                        }
                    }else{


                        echo'

                            <div class="card-body center font-weight-bold text-center">
                                <div class="ico-no-resultados"></div>
                                No se han encontrado resultados.
                            </div>

                        ';
                    }
                    ?>
                </ul>

                <div class="card-footer text-muted text-center">
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item <?php echo $anterior; ?>">
                        <a class="page-link" href="/inventario/pag/<?php echo $anterior_link; ?>">Anterior</a>
                        </li>

                        <?php

                        for($i = 0; $i < $paginacion; $i++){

                            $pagina_activa = null;
                            if($i + 1 == $pagina){ $pagina_activa = 'active'; }

                            echo '
                                <li class="page-item '. $pagina_activa .'"><a class="page-link" href="/inventario/pag/'. ($i + 1) .'">'. ($i + 1) .'</a></li>
                            ';
                        }

                        ?>

                        <li class="page-item <?php echo $siguiente; ?>">
                        <a class="page-link" href="/inventario/pag/<?php echo $siguiente_link; ?>">Siguiente</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_footer(); ?>
