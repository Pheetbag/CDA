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
            <link rel="stylesheet" href="'    . HTTP . '/recursos/libs/bootstrap/css/bootstrap.min.css">
            <link rel="shortcut icon" href="' . HTTP . '/recursos/cda-logosmall.png" type="image/png" />
            <link rel="stylesheet" href="'    . HTTP . '/vistas/defaults/defaults.css?v=0.16">

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

    $admin = null;

    if(isset($_SESSION['usuario']['rango']) AND $_SESSION['usuario']['rango'] == '1'){

        $admin = '<a href="'. HTTP .'/administracion"  class="item">Administración</a>'; 
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
                <a href="/recursos/manual-de-usuario.pdf"><div class="item manual"><div data-toggle="tooltip" data-placement="left" title="manual"></div></div></a>
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
					    '. $admin .'
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

    <script src="' . HTTP . '/recursos/libs/jquery.min.js"></script>
	<script src="' . HTTP . '/vistas/defaults/cookies.js"></script>


    <script src="' . HTTP . '/recursos/libs/popper.min.js"></script>
	<script src="' . HTTP . '/recursos/libs/bootstrap/js/bootstrap.min.js"></script>


    <script src="' . HTTP . '/vistas/defaults/defaults.js?v=0.5"></script>
    ' . $extra . '
    </body>
    </html>
    ';
}
