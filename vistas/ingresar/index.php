<?php include_head('CDA - Ingresar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/ingresar/style.css?v=0.2">
<link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
  <!-- or -->
  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>
<body>

<div class="contenedor">

    <div class="logo mb-4"></div>

    <div class="card alerta animated slideInLeft text-white bg-danger mb-3 <?php echo $vista_errores; ?>" id="alerta-error" style="width: 20rem;">
        <div class="card-body">
            <p class="card-text"> <?php echo $vista_errores_desc; ?> </p>
        </div>
    </div>

    <div class="card" id="login" style="width: 20rem;">
        <div class="card-body">
            <h5 class="card-title">Ingresar</h5>
            <p class="card-text">
                <form method='post' action='ingresar/validar'>

                    <div class="form-group">
                        <input type="text" class="form-control <?php echo $vista_errores; ?>" id="usuario" name="usuario" aria-describedby="usuarioHelp" placeholder="Usuario">
                        <small id="usuarioHelp" class="form-text text-muted">El nombre de usuario es sensible a mayúsculas y minúsculas.</small>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control <?php echo $vista_errores; ?>" id="contraseña" name="contraseña" placeholder="Contraseña">
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Recuerdame</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">Entrar</button>
                </form>
            </p>
        </div>
    </div>
</div>

<?php include_footer(); ?>
<script src="<?php echo HTTP ?>/vistas/ingresar/script.js?v=0"></script>

</body>
</html>