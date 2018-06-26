<?php

global $consultar; 

class ingresar{
    
    public $vista = 'vistas/ingresar/'; 
    
    public function index(){

        //Estas variables se usan dentro de la vista para imprimir valores
        $vista_errores      = null;
        $vista_errores_desc = '';

        if(isset($_GET['e'])){

            switch($_GET['e']){
                case '0':
                    $vista_errores      = 'is-invalid';
                    $vista_errores_desc = 'El usuario o contraseña es incorrecto.';
                    break;
            }
        }

        require $this->vista . 'index.php';
    }
    
    public function validar(){
        
        //obtenemos los datos via POST, en caso de no estar definidos, redireccionamos a el el index del controlador
        if(!isset($_POST['usuario']) && !isset($_POST['contraseña'])){

            header('location:' . HTTP . '/ingresar');
            exit; 
        }

        $usuario    = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        //hacemos la consulta de el usuario
        global $consultar;
        $resultado = $consultar->log($usuario, $contraseña); 

        //si el resultado es null no se obtuvo ningun resultado de la consulta
        if($resultado === null){

            //redirijimos a la pagina de ingresar, generando un error via GET que el controlador puede interpretar y reflejar en las vistas.
            header('location:' . HTTP . '/ingresar?e=0');
            exit; 
        }

        //Guardamos los datos del usuario en la sesión y enviamos al usuario de vuelta a la pantalla de ingresar, que lo enviará al index de todo el sitio.
        $_SESSION['usuario'] = [
            'id'      =>  utf8_encode($resultado['id']),
            'usuario' =>  utf8_encode($resultado['usuario'])
        ];

        header('location:' . HTTP . '/ingresar');
        exit; 

    }
}