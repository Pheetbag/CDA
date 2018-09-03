<?php include_head('CDA - Inventario'); ?>

<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/inventario/style.css?v=0.7">
</head>
<body>

<?php include_header('inventario','Inventario', 'Buscar'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">
    <div class="row">

        <div class="col-md-9 col-sm-12">

            <div class="card mb-3">
                <form novalidate class="validar card-body mb-0" action="<?php echo HTTP ?>/inventario/buscar" method="GET">
                    <div class="form-group mb-0 d-sm-flex justify-content-around">
                        <input required type="text" name="busqueda" id="" class="form-control col-sm-9 col-12" placeholder="Buscar producto" value="<?php echo $busqueda ?>">
                        <button type="submit" class="btn btn-primary btn-sm col-sm-2 col-12 mt-2 mt-sm-0">Buscar</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <ul class="list-group list-group-flush">

                    <?php

                    if($resultado != null){

                        foreach($resultado as $item){

                            echo '
                            <a href="'. HTTP .'/inventario/producto/'. $item['codigo_producto'] .'" class="list-group-item list-group-item-action container-fluid">
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
                                        <div class="producto-precio text-success font-weight-bold">Bs.S '. number_format( $item['precio_venta'] ,2,',', '.') .'</div>
                                        <div class="producto-existencias text-muted">'. number_format( $item['existencias'] ,0,',', ' ') .' en stock</div>
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
                        <a class="page-link" href="<?php echo HTTP ?>/inventario/buscar/<?php echo $anterior_link; ?>?busqueda=<?php echo $busqueda_url ?>">Anterior</a>
                        </li>

                        <?php

                        for($i = 0; $i < $paginacion; $i++){

                            $pagina_activa = null;
                            if($i + 1 == $pagina){ $pagina_activa = 'active'; }

                            echo '
                                <li class="page-item '. $pagina_activa .'"><a class="page-link" href="'. HTTP .'/inventario/buscar/'. ($i + 1) .'?busqueda='. $busqueda_url .'">'. ($i + 1) .'</a></li>
                            ';
                        }

                        ?>

                        <li class="page-item <?php echo $siguiente; ?>">
                        <a class="page-link" href="<?php echo HTTP ?>/inventario/buscar/<?php echo $siguiente_link; ?>?busqueda=<?php echo $busqueda_url ?>">Siguiente</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_footer(); ?>
