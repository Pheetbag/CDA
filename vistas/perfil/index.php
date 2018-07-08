<?php include_head('CDA - Registrar'); ?>
<link rel="stylesheet" href="<?php echo HTTP ?>/vistas/registrar/style.css?v=0.2">
</head>
<body>
<?php include_header(null, 'Perfil', $usuario['usuario']); ?>

<main class="container-fluid nav-spaced full-screen" id="navPush">

	<div class="row">

		<div class="col-sm-6 col-md-7 col-lg-4">

			<?php

				if(isset($_GET['action']) AND $_GET['action'] == 'clave-cambiada'){

					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Contraseña cambiada.</strong> Se ha hecho el cambio de contraseña para el usuario exitosamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>';

				}

			?>


			<div class="card mb-4 border-dark text-center">
				<h6 class="card-header">Nombre</h6>
			  <div class="card-body text-dark">
			  	<?php echo $usuario['usuario'] ?>
			  </div>
			</div>

			<div class="card border-dark text-center mb-4">
				<h6 class="card-header">Rango</h6>
			  <div class="card-body text-dark">
				<?php echo $usuario['rango_nombre'] ?>
				<br>
				<small class="text-muted"><?php echo $usuario['rango_desc'] ?></small>
			  </div>
			</div>

			<button type="button" data-toggle="modal" data-target="#ajustes-usuario" class="btn btn-primary btn-block">Ajustes</button>

		</div>

	</div>

</main>

<?php

if(isset($_GET['err']) AND $_GET['err'] == 'contra'){



    include_footer("
    <script type='    text/javascript'    >
    $(window).on('load',function(){
        $('#ajustes-usuario').modal('show');
    });
    </script>");

}else{

    include_footer();

}


?>
