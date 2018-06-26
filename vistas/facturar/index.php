<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header(1,'Facturación'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="card mb-4">
                <h6 class="card-header">Ultimas facturas</h6>
                <ul class="list-group list-group-flush">

                        <a href="/facturar/factura/0000" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">Nombre cliente</div>
                                    <div>V-00.000.000</div>
                                </div>
                                <div class="col-6 col-sm-4 left align-items-center align-items-sm-end">
                                    <div class="text-muted">Factura #0000</div>
                                    <div class="text-muted">Emitido: 11/06/2018</div>
                                </div>
                                <div class="col-6 col-sm-4 right align-items-center">
                                    <div class="producto-precio text-success font-weight-bold">Total: 10.000 Bs.</div>
                                    <div class="producto-existencias text-muted">Productos vendidos: 3</div>
                                </div>
                            </div>
                        </a>

                        <a href="/facturar/factura/0000" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">Nombre cliente</div>
                                    <div>V-00.000.000</div>
                                </div>
                                <div class="col-6 col-sm-4 left align-items-center align-items-sm-end">
                                    <div class="text-muted">Factura #0000</div>
                                    <div class="text-muted">Emitido: 11/06/2018</div>
                                </div>
                                <div class="col-6 col-sm-4 right align-items-center">
                                    <div class="producto-precio text-success font-weight-bold">Total: 10.000 Bs.</div>
                                    <div class="producto-existencias text-muted">Productos vendidos: 3</div>
                                </div>
                            </div>
                        </a>

                        <a href="/facturar/factura/0000" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">Nombre cliente</div>
                                    <div>V-00.000.000</div>
                                </div>
                                <div class="col-6 col-sm-4 left align-items-center align-items-sm-end">
                                    <div class="text-muted">Factura #0000</div>
                                    <div class="text-muted">Emitido: 11/06/2018</div>
                                </div>
                                <div class="col-6 col-sm-4 right align-items-center">
                                    <div class="producto-precio text-success font-weight-bold">Total: 10.000 Bs.</div>
                                    <div class="producto-existencias text-muted">Productos vendidos: 3</div>
                                </div>
                            </div>
                        </a>

                </ul>

                <div class="card-footer text-muted text-center">
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item">
                        <a class="page-link" href="#">Ver todos</a>
                        </li>
                    </ul>
                </div>
            </div>

			<div class="card mb-4">
                <h6 class="card-header">Ultimos clientes</h6>
                <ul class="list-group list-group-flush">

                        <a href="/facturar/factura/0000" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">Nombre cliente</div>
                                    <div>V-00.000.000</div>
                                </div>
                                <div class="col-6 col-sm-4 left align-items-center align-items-sm-end">
                                    <div class="text-muted">Factura #0000</div>
                                    <div class="text-muted">Emitido: 11/06/2018</div>
                                </div>
                                <div class="col-6 col-sm-4 right align-items-center">
                                    <div class="producto-precio text-success font-weight-bold">Total: 10.000 Bs.</div>
                                    <div class="producto-existencias text-muted">Productos vendidos: 3</div>
                                </div>
                            </div>
                        </a>

                        <a href="/facturar/factura/0000" class="list-group-item list-group-item-action container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 left align-items-center align-items-sm-start">
                                    <div class="font-weight-bold">Nombre cliente</div>
                                    <div>V-00.000.000</div>
                                </div>
                                <div class="col-6 col-sm-4 left align-items-center align-items-sm-end">
                                    <div class="text-muted">Factura #0000</div>
                                    <div class="text-muted">Emitido: 11/06/2018</div>
                                </div>
                                <div class="col-6 col-sm-4 right align-items-center">
                                    <div class="producto-precio text-success font-weight-bold">Total: 10.000 Bs.</div>
                                    <div class="producto-existencias text-muted">Productos vendidos: 3</div>
                                </div>
                            </div>
                        </a>
                </ul>

                <div class="card-footer text-muted text-center">
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item">
                        <a class="page-link" href="#">Ver todos</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-3 col-sm-12 mb-4">

<!-- ESTO SE ELIMINO POR NO CONSIDERAR NECESARIO. SE DEJA COMENTADO PARA FINES FUTUROS -->

            <!-- <div class="card mb-4">
                <h6 class="card-header">Registrar</h6>
                <div class="card-body">
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/cliente">Nuevo cliente</a>
                    <a class="btn btn-primary mt-3 d-block" href="/registrar/factura">Nueva factura</a>
                </div>
            </div> -->

            <div class="card mb-4">
                <h6 class="card-header">Buscar factura</h6>
                <form class="card-body">
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Codigo">
                    </div>
                    <a class="btn btn-primary mt-3 d-block" href="#">Buscar</a>
                </form>
            </div>

            <div class="card">
                <h6 class="card-header">Buscar cliente</h6>
                <form class="card-body">
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Cédula">
                    </div>
                    <a class="btn btn-primary mt-3 d-block" href="#">Buscar</a>
                </form>
            </div>
        </div>

    </div>
</main>

<?php include_footer(); ?>
