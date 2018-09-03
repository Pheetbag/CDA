<?php

global $consultar; 

class reportes{
    
    public $vista = 'vistas/reportes/'; 

    public $permisos  = [
        'reportes' => '1'
    ];
    
    function __construct(){
    

    }
    
    public function index(){
        
        global $consultar;

        $months_name = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $month       = $months_name[date('n') -1];
        
        $days_name   = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado');
        $current_day = date('w');
        $days        = array();

        for ($i=0; $i < 7; $i++)
        { 
            if( $current_day < $i )
            {   $current_day = 7; }
                
            $day_code = $days_name[$current_day - $i]; 
            $days[]   = $day_code;
        }

        $ventas  = array();
        $compras = array();

        for ($i = 6; $i >= 0; $i--)
        {
            $ventas [] = $consultar->get_semanal('venta',  $i)['cantidad'];
            $compras[] = $consultar->get_semanal('compra', $i)['cantidad'];
        }
        
        $days = array_reverse($days);

        $ventas_totales  = $consultar->get_totales('venta');
        $compras_totales = $consultar->get_totales('compra');

        require $this->vista . 'index.php';
    }
    
    public function imprimir($type)
    {
        if(!isset($_GET['fmin']) OR!isset($_GET['fmax']))
        { header('location:' . HTTP . '/reportes'); }

        switch ($type) {
            case 'pedido':
                
                echo $this->generar_pedido($_GET['fmin'], $_GET['fmax']);
                break;

            case 'factura':
            
                echo $this->generar_factura($_GET['fmin'], $_GET['fmax']);
                break;
        }
    }

    public function generar_pedido($fecha_min, $fecha_max)
    {
        global $consultar;
        $pedidos = $consultar->pedido($fecha_min, $fecha_max);

        $rows      = array();
        $total     = 0;
        $uni_total = 0;

        for ($i=0; $i < count($pedidos); $i++)
        {
            $row       = array();
            $pedido    = $pedidos[$i];
            $detalles  = $consultar->detalle_pedido($pedido['codigo_pedido']);
            $total    += $pedido['subtotal'];
            $unidades  = 0;

             $uni_total += $unidades += $detalles['unidades'];

            
            $row[]  = date('d/m/Y', strtotime($pedido['fecha'])); 
            $row[]  = $pedido['codigo_pedido'];
            $row[]  = $pedido['codigo_proveedor'];
            $row[]  = $detalles['cantidad'];
            $row[]  = $unidades;
            $row[]  = number_format( $pedido['subtotal']  ,2,',', '.');

            $rows[] = $row;
        }


        require('libs/tfpdf/pdf.php');
        $pdf = new PDF('L');
        $pdf->title    = 'Informe de compras. Periodo: ' . date('d/m/Y', strtotime($fecha_min)) . ' - ' . date('d/m/Y', strtotime($fecha_max));
        $pdf->subtitle = ''; 

        $pdf->AddPage();
        $pdf->Table(array('Fecha', 'Codigo', 'Proveedor', 'Productos', 'Unidades totales', 'Costo total (Bs.S)'), 
        $rows);

        $pdf->Ln(10); 

        $pdf->FinalTable(array('Unidades totales', 'Costo total'),
        array($uni_total, number_format( $total  ,2,',', '.')));

        $pdf->output();
    }

    public function generar_factura($fecha_min, $fecha_max)
    {
        global $consultar;
        $facturas  = $consultar->factura($fecha_min, $fecha_max);

        $rows      = array();
        $total     = 0;
        $uni_total = 0;

        for ($i=0; $i < count($facturas); $i++)
        {
            $row       = array();
            $factura   = $facturas[$i];
            $detalles  = $consultar->detalle_factura($factura['codigo_factura']);
            $total    += $factura['total'];
            $unidades  = 0;

             $uni_total += $unidades += $detalles['unidades'];

            
            $row[]  = date('d/m/Y', strtotime($factura['fecha_venta'])); 
            $row[]  = $factura['codigo_factura'];
            $row[]  = $factura['ci_cliente'];
            $row[]  = $detalles['cantidad'];
            $row[]  = $unidades;
            $row[]  = number_format( $factura['total']  ,2,',', '.');

            $rows[] = $row;
        }


        require('libs/tfpdf/pdf.php');
        $pdf = new PDF('L');
        $pdf->title    = 'Informe de ventas. Periodo: ' . date('d/m/Y', strtotime($fecha_min)) . ' - ' . date('d/m/Y', strtotime($fecha_max));
        $pdf->subtitle = '';  

        $pdf->AddPage();
        $pdf->Table(array('Fecha', 'Codigo', 'Cliente', 'Productos', 'Unidades totales', 'Total (Bs.S)'), 
        $rows);

        $pdf->Ln(10); 

        $pdf->FinalTable(array('Unidades totales', 'Ventas totales (Bs.S)'),
        array($uni_total, number_format( $total  ,2,',', '.')));

        $pdf->output();
    }


}