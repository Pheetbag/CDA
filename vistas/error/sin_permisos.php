<?php include_head('CDA - 404'); ?>

</head>
<body>


<?php include_header($controlador, '403', 'Acceso denegado'); ?>


<main class="container-fluid  nav-spaced full-screen" id="navPush">

    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 container-fluid">
            <div class="alert alert-warning m-3 mt-5" role="alert">
            <h4 class="alert-heading">¡No tienes permisos!</h4>
                <p>El acceso al sitio que has solicitado a sido denegado por el sistema, verifica que poseas los permisos necesarios para realizar esta acción e intenta nuevamente.</p>
                <hr>
                <small class="mb-0">Error 403: El acceso a sido denegado debido a los permisos de el <?php echo $tipo ?>.</small>
            </div>
        </div>
    </div>


</main>


<?php include_footer(); ?>
