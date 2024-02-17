<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Contrato;
use Model\Usuario;

class ContratosController { 

    public static function index(Router $router) { 
        if(!is_admin()) {
            header('Location: /');
        }
    
        $pagina_actual = isset($_GET["page"]);
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    
        $registros_por_pagina = 10;
        $total = Contrato::total();
    
        // Verificar si hay registros antes de crear la paginación
        if ($total > 0) {
            $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
    
            if (!$pagina_actual || $pagina_actual < 1 || $paginacion->total_paginas() < $pagina_actual) {
                header("Location: /admin/contratos?page=1");
            }
    
            $contratos = Contrato::paginar($registros_por_pagina, $paginacion->offset());
    
            foreach($contratos as $contrato) {
                $contrato->inversionista = Usuario::find($contrato->inversionista_id);
    
                // Calcular interes acumulado hasta la fecha actual
                $contrato->interes = self::calcularInteresAcumulado($contrato);
                
                $contrato->guardar();
            }
    
            $router->render('admin/contratos/index', [
                'titulo' => 'Contratos',
                'contratos' => $contratos,
                'paginacion' => $paginacion->paginacion()
            ]);
        } else {
            // No hay registros, renderiza la página con un mensaje adecuado
            $router->render('admin/contratos/index', [
                'titulo' => 'Contratos',
                'contratos' => [],
                'paginacion' => ''
            ]);
        }
    }
    
    private static function calcularInteresAcumulado($contrato) {
        $fechaInicio = new \DateTime($contrato->fecha_inicio);
        $fechaFin = new \DateTime($contrato->fecha_fin);
        $fechaActual = new \DateTime();
        $interesAcumulado = 0;

        // Verificar si la fecha actual es posterior a la fecha de inicio
        if ($fechaActual >= $fechaInicio) {
            // Si la fecha actual está después de la fecha de finalización, establece la fecha actual en la fecha de finalización
            if ($fechaActual > $fechaFin) {
                $fechaActual = $fechaFin;
            }
    
            // Calcular el número de meses transcurridos desde la fecha de inicio hasta la fecha actual
            $intervalo = $fechaInicio->diff($fechaActual);
            $mesesTranscurridos = $intervalo->y * 12 + $intervalo->m;
    
            // Iterar sobre los meses transcurridos
            for ($i = 0; $i < $mesesTranscurridos; $i++) {
                // Calcular el interes acumulado mes a mes
                $interesAcumulado += ($contrato->porcentaje / 100) * $contrato->inversion;
            }
        }
    
        return $interesAcumulado;
    }
    
    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /');
        }

        $clientes = Usuario::whereArray(['admin' => 0]);
        $alertas = [];
        $contrato = new Contrato;
        $tipos_inversion = ['Inversión en Mineía', 'Desarrollos Inmobiliarios', 'Fondos de Inversión USA', 'Remates Inmobiliarios'];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /');
            }

            $contrato->sincronizar($_POST);
    
            // Generar nombre unico
            $nombreContrato = md5( uniqid( rand(), true) ) . ".pdf";

            // Setear el contrato
            if($_FILES['contrato']['tmp_name']) {
                $contrato->setContrato($nombreContrato);
            }

            // validar
            $alertas = $contrato->validarContrato();
            
            if(empty($alertas)) {
                // Crear la carpeta para subir los contratos
                if(!is_dir(CARPETA_CONTRATOS)) {
                    mkdir(CARPETA_CONTRATOS);
                }
    
                // Mover el PDF a la carpeta de contratos
                move_uploaded_file($_FILES['contrato']['tmp_name'], CARPETA_CONTRATOS . $nombreContrato);

                // Guardar la ruta del PDF en el contrato
                $contrato->contrato = $nombreContrato;

                // Guardar en la BD
                $resultado = $contrato->guardar();

                if($resultado) {
                    header('Location: /admin/contratos');
                }
            }
        }

        $router->render('admin/contratos/crear', [
            'titulo' => 'Registrar Contrato',
            'contrato' => $contrato,
            'alertas' => $alertas,
            'clientes' => $clientes,
            'tipos_inversion' => $tipos_inversion
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /');
        }
        
        $clientes = Usuario::whereArray(['admin' => 0]);
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $tipos_inversion = ['Inversión en Mineía', 'Desarrollos Inmobiliarios', 'Fondos de Inversión USA', 'Remates Inmobiliarios'];
        
        if(!$id) {
            header('Location: /admin/contratos');
        }

        $contrato = Contrato::find($id);

        if(!$contrato) {
            header('Location: /admin/contratos');
        }

        $contratoActual = $contrato->contrato;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_admin()) {
                header('Location: /');
            }

            $contrato->sincronizar($_POST);

            // validar
            $alertas = $contrato->validarContrato();

            if($contratoActual !== $_FILES["contrato"]["name"] && $_FILES["contrato"]["name"] !== "") {
                // Generar nombre unico
                $nuevoContrato = md5( uniqid( rand(), true) ) . ".pdf";

                // Setear el contrato
                if($_FILES['contrato']['tmp_name']) {
                    $contrato->setContrato($nuevoContrato);
                }

            } else {
                // Setear el contrato
                if($_FILES['contrato']['tmp_name']) {
                    $contrato->setContrato($contratoActual);
                }
            }

            // Guardar el registro
            if(empty($alertas)) {

                if($contratoActual !== $_FILES["contrato"]["name"] && $_FILES["contrato"]["name"] !== "") {
                    // Mover el PDF a la carpeta de contratos
                    move_uploaded_file($_FILES['contrato']['tmp_name'], CARPETA_CONTRATOS . $nuevoContrato);

                    // Guardar la ruta del PDF en el contrato
                    $contrato->contrato = $nuevoContrato;
                } else {
                    // Mover el PDF a la carpeta de contratos
                    move_uploaded_file($_FILES['contrato']['tmp_name'], CARPETA_CONTRATOS . $contratoActual);

                    // Guardar la ruta del PDF en el contrato
                    $contrato->contrato = $contratoActual;
                }

                // Guardar en la BD
                $resultado = $contrato->guardar();

                if ($resultado) {
                    header('Location: /admin/contratos');
                }
            }
        }
        
        $router->render('admin/contratos/editar', [
            'titulo' => 'Actualizar Contrato',
            'contrato' => $contrato,
            'alertas' => $alertas,
            'clientes' => $clientes,
            'tipos_inversion' => $tipos_inversion
        ]);
    }

    public static function eliminar() { 
        if(!is_admin()) {
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /');
            }
            $id = $_POST["id"];
            $contrato = Contrato::find($id);
            $contrato->eliminar();
            header('Location: /admin/contratos');
        }
    }
    
}