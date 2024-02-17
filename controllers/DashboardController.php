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
        $interes = 0;

        // Obtener ultimos registros
        $registros = Usuario::get(3);


        foreach ($contratos as $contrato) {
            // Si contrato estado es 0 poner Activo si es 1 poner Vencido
            if($contrato->fecha_fin > $contrato->proximo_pago) {
                $contrato->estado = "Activo";
            } elseif($contrato->fecha_fin < $contrato->proximo_pago) {
                $contrato->estado = "Vencido";
            }

            // Agregar al modelo contrato el inversor
            $contrato->inversionista = Usuario::find($contrato->inversionista_id);

            // Calcular los ingresos
            $ingresos += $contrato->inversion;

            // Calcular los intereses
            $interes += $contrato->interes;

            // Contratos vencidos
            $fecha_fin_timestamp = strtotime($contrato->fecha_fin);
            // Obtener el tiempo actual en timestamp
            $tiempo_actual_timestamp = time();
            // Verificar si la fecha de finalización ha pasado
            $fecha_fin_pasada = $fecha_fin_timestamp < $tiempo_actual_timestamp;

            if($fecha_fin_pasada) {
                $contratos_vencidos += 1;
            }

            // Calcular la fecha del próximo pago
            $fechaActual = new \DateTime();
            $fechaActual->setTime(0, 0, 0); // Establecer la hora a 00:00:00

            $fechaInicio = new \DateTime($contrato->fecha_inicio);
            $proximaFechaPago = clone $fechaInicio;

            // Si la fecha de inicio es posterior a hoy, el próximo pago es la fecha de inicio
            if ($fechaInicio > $fechaActual) {
                $proximaFechaPagoString = $fechaInicio->format('Y-m-d');
            } else {
                // Calcular el próximo pago después de la fecha de inicio
                while ($proximaFechaPago <= new \DateTime($contrato->fecha_fin)) {
                    if ($proximaFechaPago >= $fechaActual) { // Cambio aquí para incluir igualdad
                        $proximaFechaPagoString = $proximaFechaPago->format('Y-m-d');

                        break; // Importante romper el bucle una vez que encuentre el próximo pago
                    }
                    $proximaFechaPago->modify('next month');
                }
            }
            

            // Actualizar la columna proximo_pago en la base de datos
            $contrato->proximo_pago = $proximaFechaPagoString;
            $contrato->guardar();

        }
        
        $proximo_pagos = Contrato::ordenarLimite('proximo_pago', 'ASC', 5);

        foreach($proximo_pagos as $proximo_pago) {
            $proximo_pago->inversionista = Usuario::find($proximo_pago->inversionista_id);
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
            'ingresos' => $ingresos,
            'interes' => $interes,
            'proximo_pagos' => $proximo_pagos
        ]);
    }
}
    