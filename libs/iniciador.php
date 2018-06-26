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
            require $file;
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
        
        //verificamos si se ha definido un segundo parametro en la url, y si este no está vacio, para llamar al método correspondiente en el controlador.
        if(isset($url[1]) && $url[1] !== ''){
            
            //si el método solicitado existe en el controlador se le llamara
            if(method_exists($controlador, $url[1])){
                
                //verificamos si en la solicitud se ha enviado a un tercer campo y si no está vacio, correspondiente a la id, de ser así se enviará como parametro a el método solicitado.En otro caso se enviará null como valor
                if(isset($url[2])  && $url[2] !== ''){ 
                    $controlador->$url[1]($url[2]); 
                }else{
                    $controlador->$url[1](null); 
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
            $controlador->index(); 
        }     
    }   
}
