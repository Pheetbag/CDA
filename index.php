<?php 

//Librerias y archivos importantes  
date_default_timezone_set('America/Caracas');

require 'libs/path.php';
require 'libs/iniciador.php';
require 'libs/includes.php';
require 'libs/regexp.php';
// ---------------------------------

/*
constantes con los datos para generar redirecciones

HOST contiene la dirección del host, sin ningún tipo de fichero

HTTP contiene el host con el protocolo http, e incluyendo el fichero en el que vive el proyecto

HTTP_PHP se utiliza para generar redirecciones a través de los archivos del codigo, es una variante de HTTP pues php no soporta el protocolo http para navegar a través de arhivos.
*/
define ("HOST", $_SERVER['HTTP_HOST']);
define ("HTTP", 'http://' . HOST);
define ("HTTP_PHP", $_SERVER['DOCUMENT_ROOT']. '/'); 

//iniciamos / refrescamos la sesión, en caso de que exista
session_start();

//----------------------------------

//Llamamos al iniciador de la aplicación, que fue requerido desde libs/ 

$app = new iniciador(); 
