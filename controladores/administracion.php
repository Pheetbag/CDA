<?php

global $consultar;

class administracion{

    public $permisos = [
        'administracion' => 1
    ];

    public $vista = 'vistas/administracion/';

    public function index()
    {
        global $consultar;
        $usuarios = $consultar->usuarios();

        require $this->vista . 'index.php';

    }

    
    public function eliminar($id)
    {
        global $consultar;
        $usuarios = $consultar->eliminar($id);

        header('location:' . HTTP. '/administracion');
    }
}
