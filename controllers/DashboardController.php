<?php

namespace Controllers;

use Model\Contrato;
use MVC\Router;
use Model\Usuario;

class DashboardController { 

    public static function index(Router $router) { 
        if(!is_admin()) {
            header('Location: /');
        }

        $clientes = Usuario::whereArray(["admin" => "0"]);
        $contratos = Contrato::all();
        $contratos_vencidos = 0;
        $ingresos = 0;

        // Obtener ultimos registros
        $registros = Usuario::get(3);


        // Calcular los ingresos
        foreach($contratos as $contrato) {
            $ingresos += $contrato->inversion;
        }

        // Contratos Vencidos
        foreach($contratos as $contrato) {
            $fecha_fin_timestamp = strtotime($contrato->fecha_fin);
            // Obtener el tiempo actual en timestamp
            $tiempo_actual_timestamp = time();
            // Verificar si la fecha de finalización ha pasado
            $fecha_fin_pasada = $fecha_fin_timestamp < $tiempo_actual_timestamp;

            if($fecha_fin_pasada) {
                $contratos_vencidos += 1;
            }
        }

        // Contratos Activos
        $contratos_activos = count($contratos) - $contratos_vencidos;


        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración',
            'contratos' => $contratos,
            'clientes' => $clientes,
            'contratos_vencidos' => $contratos_vencidos,
            'contratos_activos' => $contratos_activos,
            'registros' => $registros,
            'ingresos' => $ingresos
        ]);
    }
}
    