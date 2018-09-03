<?php

/*
constantes con los datos para generar redirecciones

HOST contiene la dirección del host, sin ningún tipo de fichero

DIR contiene la dirección del host, con el fichero raiz (si existe) del proyecto.

HTTP contiene el host con el protocolo http, e incluyendo el fichero raiz en el que vive el proyecto

HTTP_PHP se utiliza para generar redirecciones a través de los archivos del codigo, es una variante de HTTP pues php no soporta el protocolo http para navegar a través de arhivos.
*/
define ("HOST"     , $_SERVER['HTTP_HOST'] );




$dir_url = dirname($_SERVER['PHP_SELF']);

if($dir_url == '/' OR $dir_url == '\\'){
	define ("DIR"      ,  '');
}else{
	define ("DIR"      ,  $dir_url);
}




define ("HTTP"     , 'http://' . HOST . DIR);
define ("HTTP_PHP" , dirname($_SERVER['SCRIPT_FILENAME']) );
