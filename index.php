<?php

//Librerias y archivos importantes
date_default_timezone_set('America/Caracas');

require 'libs/path.php';
require 'libs/iniciador.php';
require 'libs/includes.php';
require 'libs/regexp.php';
require 'libs/control_db.php';

// ---------------------------------

/*
constantes con los datos para generar redirecciones

HOST contiene la dirección del host, sin ningún tipo de fichero

HTTP contiene el host con el protocolo http, e incluyendo el fichero en el que vive el proyecto

HTTP_PHP se utiliza para generar redirecciones a través de los archivos del codigo, es una variante de HTTP pues php no soporta el protocolo http para navegar a través de arhivos.
*/
define ("HOST", $_SERVER['HTTP_HOST'] . '/cda');
define ("HTTP", 'http://' . HOST);
define ("HTTP_PHP", $_SERVER['DOCUMENT_ROOT']. '/');

/*
IMPORTANTE!

En caso de que el sistema se esté ejecutando en el directorio raiz del localhost o en un virtual host, se puede dejar estas variables
tal como están.

Si el sistema en cambio se esta ejecutando desde una subcarpeta de el servidor, (por ejemplo una carpeta cda dentro de el htdocs o el www, y el url de acceso a a través de localhost/cda) se debe indicar en el string vacio  al final HOST, el nombre de la subcarpeta iniciando con un /, por ejemplo "/subcarpeta1/subcarpeta2" y esto le inidica al sistema que se encuentra dentro de la subcarpeta2 que esta dentro de la subcarpeta1 que esta dentro de el directorio raiz, o local host (htdocs o www según el caso).
*/

//iniciamos / refrescamos la sesión, en caso de que exista
session_start();

//----------------------------------

//Constantes para conexiones a bases de datos
require 'modelos/config.php';

//Llamamos a la función de verificación de estado de la base de datos. Esta función se asegura de que la base de datos exista, en caso de que la misma no exista

estado_db();

//Llamamos al iniciador de la aplicación, que fue requerido desde libs/

$app = new iniciador();
