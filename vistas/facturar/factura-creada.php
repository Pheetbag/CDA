<?php include_head('CDA - Facturación');?>
</head>
<body>

<?php include_header(1, 'Facturación', '#0000'); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

    <div class="row">
        
        <div class="col-md-8 col-lg-4 container-fluid">

            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="progress" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated 
                    bg-success font-weight-bold" style="width:100%;">¡Completado!</div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-12">
                
                    <div class="card">
                        <h6 class="card-header text-center px-5">
                            Jonathan Muñoz
                            |
                            V-26.717.254
                            <br><br>
                            Valle de la pascua
                            <br>
                            0412-000-00-00
                        </h6>
                        <h6 class="card-header text-muted text-center">
                        11/06/2018 | Factura #0000
                        </h6>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item list-group-item-action container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <p class="mb-0 font-weight-bold">Producto 1</p>
                                        <p class="mb-0">Codigo: 209</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <p class="font-weight-bold mb-0 text-success ">Bs. 2.000.500</p>
                                        <p class="mb-0">x2</p>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item list-group-item-action container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <p class="mb-0 font-weight-bold">Producto 2</p>
                                        <p class="mb-0">Codigo: 12300</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <p class="font-weight-bold mb-0 text-success ">Bs. 1.350.299</p>
                                        <p class="mb-0">x1</p>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item list-group-item-action container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <p class="mb-0 font-weight-bold">Producto 3</p>
                                        <p class="mb-0">Codigo: 509</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <p class="font-weight-bold mb-0 text-success ">Bs. 999.700</p>
                                        <p class="mb-0">x4</p>
                                    </div>
                                </div>
                            </li>

                        </ul>

                        <div class="card-footer text-muted text-right">
                            SUBTOTAL Bs. 9.350.099<!--
                            --><br>
                            IVA: 1.122.011,88
                        </div>

                        <div class="card-footer text-center font-weight-bold">
                            TOTAL Bs. 10.472.110,88
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

<?php include_footer(); ?>
