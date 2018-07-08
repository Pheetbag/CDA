<?php

function include_head($title = 'Sistema CDA'){
    echo '

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
            <title>'. $title .'</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
            <link rel="shortcut icon" href="' . HTTP . '/recursos/cda-logosmall.png" type="image/png" />
            <link rel="stylesheet" href="'    . HTTP . '/vistas/defaults/defaults.css?v=0.15">

    ';
}

function include_header($activo = null, $title = 'Titulo', $subtitle = ''){

	$alerta = null;

	if(isset($_GET['err']) AND $_GET['err'] == 'contra'){

		$alerta = '
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Contraseña inválida.</strong> La contraseña actual que ha ingresado es inválida.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>';
	}

	echo '
	<div class="modal fade" tabindex="-1" id="ajustes-usuario">
	    <div class="modal-dialog modal-dialog-centered">
	        <form method="POST" action="'. HTTP .'/perfil/cambiar_contra" class="modal-content validar" novalidate>
	        <div class="modal-header">
	            <h5 class="modal-title">Ajustes de usuario</h5>
	        </div>
	        <div class="modal-body">

			'. $alerta .'

				<small class="text-muted mb-3">Esta es el área de ajustes de usuario, en esta ventana puedes cambiar tu contraseña.</small>

				<div class="form-group row mt-3">
					<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Contraseña actual</label>

					<div class="col-sm-6">
						<input type="password" class="form-control" name="antigua">
							<div class="invalid-feedback">
							  Ingrese su contraseña actual.
							</div>
							<div class="valid-feedback">
							  ¡Perfecto!
							</div>
					</div>

				</div>
					<hr>
				<div class="form-group row mt-3">
					<label for="cantidad" class="font-weight-bold col-sm-6 col-form-label">Nueva contraseña</label>

					<div class="col-sm-6">
						<input required type="password" class="form-control" name="nueva">
							<div class="invalid-feedback">
							  Ingrese la nueva contraseña.
							</div>
							<div class="valid-feedback">
							  ¡Perfecto!
							</div>
					</div>

				</div>

	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	            <button type="submit" class="btn btn-primary">Guardar</button>
	        </div>
			</form>
	    </div>
	</div>
	';



	$usuario = null;

	if(isset($_SESSION['usuario']['usuario'])){

		$usuario = $_SESSION['usuario']['usuario'] ;
	}

    $inventario = '';
    $factura    = '';
    $pedidos    = '';
    $reportes   = '';
    $registrar  = '';

    $pedidos_link    = 'href="'. HTTP . '/pedidos"';
    $factura_link    = 'href="'. HTTP . '/facturar"';
    $inventario_link = 'href="'. HTTP . '/inventario"';
    $reportes_link   = 'href="'. HTTP . '/reportes"';
    $registrar_link  = 'href="'. HTTP . '/registrar"';

    if(isset($activo)){

        switch($activo){

            case 'inventario':
                $inventario  = 'activo';
               break;

            case 'facturar':
               $factura      = 'activo';
               break;

            case 'pedidos':
               $pedidos      = 'activo';
               break;

            case 'reportes':
               $reportes     = 'activo';
               break;

            case 'registrar':
               $registrar    = 'activo';
               break;
		}
    }

    echo '
        <nav>
            <div class="body cerrado">
                <div class="item main"><div></div></div>
                <a '. $inventario_link .'><div class="item inventario ' . $inventario .'"><div data-toggle="tooltip" data-placement="left" title="Inventario"></div></div></a>
                <a '. $factura_link    .'><div class="item factura '    . $factura    .'"><div data-toggle="tooltip" data-placement="left" title="Facturación"></div></div></a>
                <a '. $pedidos_link    .'><div class="item pedidos '    . $pedidos    .'"><div data-toggle="tooltip" data-placement="left" title="Pedidos"></div></div></a>
                <a '. $reportes_link   .'><div class="item reportes '   . $reportes   .'"><div data-toggle="tooltip" data-placement="left" title="Reportes"></div></div></a>
                <a '. $registrar_link  .'><div class="item crear '      . $registrar  .'"><div data-toggle="tooltip" data-placement="left" title="Registrar"></div></div></a>
            </div>
        </nav>

        <header class="mb-2">
            <div class="title">
                <h4>'. $title .'</h4>
                <h6> '. $subtitle .'</h6>
            </div>



            <div class="usuario">
                <div class="menu">
                    <div class="title">
                        <div class="nombre"> '. $usuario .'</div>
                        <div class="cerrar"></div>
                    </div>
                    <div class="contenido">
					<!--<div class="item">Administración</div>-->
                        <a href="'. HTTP .'/perfil" class="item" >Mi perfil</a>
                        <div class="item" data-toggle="modal" data-target="#ajustes-usuario">Ajustes</div>
                        <a href="'. HTTP . '/salir' .'"><div class="item salir">Desconectar</div></a>
                    </div>
                </div>
            </div>
        </header>
    ';
}

function include_footer($extra = ''){
    echo '

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="' . HTTP . '/vistas/defaults/cookies.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <script src="' . HTTP . '/vistas/defaults/defaults.js?v=0.5"></script>
    ' . $extra . '
    </body>
    </html>
    ';
}
