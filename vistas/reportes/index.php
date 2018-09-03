<?php include_head('CDA - Inventario'); ?>
</head>
<body>

<?php include_header('reportes', 'Reportes') ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">
   
   <!--
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body row">
                    <div class="col-md-9 text-center">
                    Se encuentra disponible el reporte mensual <b>JULIO-2018</b>
                    <br>
                    <a href="#">Imprimir reportes anteriores</a>
                    </div>
                    <div class="col-md-3 d-flex align-items-center"><a href="#" class="mt-md-0 mt-3 btn btn-primary btn-block">Imprimir</a></div>
                </div>
            </div>
        </div>
    </div>
-->
    <div class="row">
        <div class="col-md-12 mb-4 text-center">
            <h5>Estado de inventario <br><b><?php echo strtoupper($month); ?> - <?php echo date('Y'); ?></b></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <h6 class="card-header">Relación Ventas / Compras (Última semana)</h6>
                <card class="card-body">
                    <canvas height="200px" id="operaciones"><canvas>
                </card>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-sm-6">

            <div class="card">
                <h6 class="card-header">Ventas totales (Última semana)</h6>
                <div class="card-body">

                    <div class="text-success text-center">
                        <h3><?php echo number_format( $ventas_totales['total'] ,2,',', '.') ?> Bs.S</h3>
                        Total vendido
                    </div>

                    <hr>

                    <p class="text-center font-weight-bold">Generar reporte</p>
                    
                    <form method="GET" action="<?php echo HTTP . '/reportes/imprimir/factura' ?>">
                        <div class="row">
                            <div class="col text-center">
                                Fecha de inicio
                                <br>
                                <input required type="date" name="fmin" class="form-control">
                            </div>
                            <div class="col text-center">
                                Fecha de cierre
                                <br>
                                <input required type="date" name="fmax" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary w-50 mx-auto mt-3">Imprimir</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm-6">

            <div class="card">
                <h6 class="card-header">Compras totales (Última semana)</h6>
                <div class="card-body">
                
                    <div class="text-danger text-center">
                        <h3><?php echo number_format( $compras_totales['total'] ,2,',', '.') ?> Bs.S</h3>
                        Total comprado
                    </div>

                    <hr>

                    <p class="text-center font-weight-bold">Generar reporte</p>

                    <form method="GET" action="<?php echo HTTP . '/reportes/imprimir/pedido' ?>">
                        <div class="row">
                            <div class="col text-center">
                                Fecha de inicio
                                <br>
                                <input required type="date" name="fmin" class="form-control">
                            </div>
                            <div class="col text-center">
                                Fecha de cierre
                                <br>
                                <input required type="date" name="fmax" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary w-50 mx-auto mt-3">Imprimir</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</main>



<?php include_footer(
'
<script src="'. HTTP .'/recursos/libs/Chart.bundle.min.js"></script>

<script>

var ctx = document.getElementById("operaciones").getContext("2d");

var myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: ["'. implode('", "', $days) .'"],
        datasets: [{
            label: "Ventas",
            data: ['. implode(', ', $ventas) .'],
            backgroundColor: [
                "rgba(130, 255, 89, .2)"
            ],
            borderColor: [
                "rgba(112, 224, 76, 1)"
            ],
            borderWidth: 2
        },
        {
            label: "Compras",
            data: ['. implode(', ', $compras) .'],
            backgroundColor: "rgba(198, 72, 53, .2)",
            borderColor: "rgb(198, 72, 53)",
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        hover: {
            mode: "x",
            intersect: false
        },
        tooltips: {
            mode: "x",
            intersect: false
        },
        scaleLabel:{
            display: true,
            labelString: "Día del mes"
        },
        maintainAspectRatio: false

    }
});

</script>'
) ?>