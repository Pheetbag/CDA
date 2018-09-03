<?php

//Librerias y archivos importantes
date_default_timezone_set('America/Caracas');

require 'libs/path.php';
require 'libs/iniciador.php';
require 'libs/includes.php';
require 'libs/regexp.php';
require 'libs/globals_urls.php';
require 'libs/control_db.php';

// ---------------------------------


//iniciamos / refrescamos la sesión, en caso de que exista
session_start();

//----------------------------------

//Constantes para conexiones a bases de datos
require 'modelos/config.php';

//Llamamos a la función de verificación de estado de la base de datos. Esta función se asegura de que la base de datos exista, en caso de que la misma no exista

estado_db();

//Llamamos al iniciador de la aplicación, que fue requerido desde libs/

$app = new iniciador();
