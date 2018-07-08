<?php

/*
Este es el iniciador de la aplicación, es instanciado en el controlador frontal

Su constructor (debido a que el objeto se instancia cada vez que se accede a una pagina del sitio) se encarga de manejar la url y realizar la inclusión de los controladores y métodos correspondientes, para que el sistema funcione de forma adecuada.
*/

class iniciador{

    public function __construct(){

        $url = get_url();


        //verificamos si se esta intentando entrar al main, y redireccionamos a "inventario"
        // en caso de querer volver a activar la pantalla principal o "main" solo hay que eliminar este if, que eliminará la redirección hacia "inventario" cada ves que se intenta entrar al main.
        if($url[0] == 'main'){
            header('location:' . HTTP . '/inventario');
        }

        //verificamos si la sesión no existe y si no se esta intentando entrar a "ingresar",  de ser asi enviará a la pagina de entrar. Si no, verificamos si la sesion existe, y si estas intentando entrar a "ingresar", en tal caso redirecciona al main.
        if(!isset($_SESSION['usuario']) && $url[0] != 'ingresar'){

            header('location:' . HTTP . '/ingresar');
            exit;
        }else if(isset($_SESSION['usuario']) && $url[0] == 'ingresar'){
            header('location:' . HTTP );
            exit;
        }

        //Verificamos si no se han definido más de 3 parametros, de ser así la url no llevará a ninguna parte, por lo que se arroja un error 404.
        if(count($url) > 3){

            require 'controladores/error.php';
            $controlador = new error;
            $controlador->max_param();
            exit();
        }

        //buscamos el controlador correspondiente a la url
        $file = 'controladores/' . $url[0] . '.php';
        if(file_exists($file)){

            //verificamos si el archivo controlador correspondiente existe
            require_once $file;
            $controlador = new $url[0];

            //instaciamos la clase consultas_controlador en caso de que la misma exista. De no existir se ignora este paso. Esta deberia estar en el archivo consultas_controlador.php dentro de la carpeta modelos/consultas/
            $modelo_name = 'consultas_'         . $url[0];
            $modelo      = 'modelos/consultas/' . $modelo_name . '.php';
            if(file_exists($modelo)){

                require $modelo;
                $consultar = new $modelo_name;
            }
        }else{

            //si no, llamamos al controlador de error
            require 'controladores/error.php';
            $controlador = new error;
            $controlador->controlador();
            exit();

        }

		//Verificamos la propiedad $permisos de la clase controlador, que es un array asociativo conteniendo todos los permisos de acceso según los niveles de usuario. Si el nivel del usuario que intenta ingresar es menor que el minimo requerido arrojará un error 404.

		/*
		Los permisos se clasifican de la siguiente forma:

			El permiso por default debe indicarse con el nombre del controlador, será este permiso el que afecte a todo el controlador, a excepción de que un permiso de método (que debe indicarse con el nombre de el método) lo sobre escriba, en caso de no existir permisos de método se utl
		*/

		//En caso de que el controlador no tenga permisos definidos definiremos el permiso por defecto de el controlador como 9999999 asegurando que todos los rangos tengan acceso
		if(isset($controlador -> permisos)){

			$permisos = $controlador -> permisos;
		}else{
			$permisos[$url[0]] = 9999999;
		}

		//Guardamos en la variable $permisos_usuario los permisos almacenados en la sesión, en caso de que la sesión no exista se utilizará el permiso 9999999, que le permite acceso a todas las areas (más el sistema al detectar la falta de sesión enviará al controlador Ingresar)

		if(isset($_SESSION['usuario']['rango'])){

			$permisos_usuario = $_SESSION['usuario']['rango'];
		}else{

			$permisos_usuario = 9999999;
		}

        //verificamos si se ha definido un segundo parametro en la url, y si este no está vacio, para llamar al método correspondiente en el controlador.
        if(isset($url[1]) && $url[1] !== ''){

            //si el método solicitado existe en el controlador se le llamara
            if(method_exists($controlador, $url[1])){

				//Utilizamos la variable $permisos que contiene todos los permisos de el controlador y verificamos si existe un permiso especifico para el método, en caso no exista utilizamos el permiso por defecto de todo el controlador.

				if(isset($permisos[$url[1]])){

					//Verificamos si el rango de el usuario en la sesión es menor que el requerido en caso de que si lanzamos un error 404, en caso de que no, continuamos.
					if($permisos_usuario > $permisos[$url[1]]){

						//si no, llamamos al controlador de error
			            require 'controladores/error.php';
			            $controlador = new error;
			            $controlador->sin_permisos($url[0], 'metodo');
			            exit();
					}
				}else{

					//Usamos el permiso de controlador por defecto para la comparación
					if($permisos_usuario > $permisos[$url[0]]){
						
						//si no, llamamos al controlador de error
			            require 'controladores/error.php';
			            $controlador = new error;
			            $controlador->sin_permisos($url[0], 'controlador');
			            exit();
					}
				}

                //verificamos si en la solicitud se ha enviado a un tercer campo y si no está vacio, correspondiente a la id, de ser así se enviará como parametro a el método solicitado.En otro caso se enviará null como valor
                if(isset($url[2])  && $url[2] !== ''){
                    $controlador->{$url[1]}($url[2]);
                }else{

                    $controlador->{$url[1]}(null);
                }
            }else{

                //si no se envia una pantalla de error.
                require 'controladores/error.php';
                $controlador = new error;
                $controlador->metodo($url[0]);
                exit();
            }
        }else{
            //Si no se ha definido parametro se llamará al método index como método principal de el controlador.

			//Utilizamos la variable $permisos que contiene todos los permisos de el controlador y verificamos si existe un permiso especifico para el método, en caso no exista utilizamos el permiso por defecto de todo el controlador.

			if(isset($permisos['index'])){

				//Verificamos si el rango de el usuario en la sesión es menor que el requerido en caso de que si lanzamos un error 404, en caso de que no, continuamos.
				if($permisos_usuario > $permisos['index']){

					//si no, llamamos al controlador de error
		            require 'controladores/error.php';
		            $controlador = new error;
		            $controlador->sin_permisos($url[0], 'index');
		            exit();
				}
			}else{

				//Usamos el método por defecto para la comparaciónote
				if($permisos_usuario > $permisos[$url[0]]){

					//si no, llamamos al controlador de error
		            require 'controladores/error.php';
		            $controlador = new error;
		            $controlador->sin_permisos($url[0], 'controlador');
		            exit();
				}
			}

            $controlador->index();
        }
    }
}
