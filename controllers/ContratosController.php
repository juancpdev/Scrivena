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
    
    
    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /');
        }

        $clientes = Usuario::whereArray(['admin' => 0]);
        $alertas = [];
        $contrato = new Contrato;
        $tipos_inversion = ['Inversión en Mineía', 'Desarrollos Inmobiliarios', 'Fondos de Inversión de Estados Unidos', 'Remates Inmobiliarios'];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /');
            }

            $contrato->sincronizar($_POST);

            // validar
            $alertas = $contrato->validarContrato();

            if(empty($alertas)) {

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
        $tipos_inversion = ['Inversión en Mineía', 'Desarrollos Inmobiliarios', 'Fondos de Inversión de Estados Unidos', 'Remates Inmobiliarios'];
        
        if(!$id) {
            header('Location: /admin/contratos');
        }

        $contrato = Contrato::find($id);


        if(!$contrato) {
            header('Location: /admin/contratos');
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /');
            }

            $contrato->sincronizar($_POST);

            // validar
            $alertas = $contrato->validarContrato();

            // Guardar el registro
            if(empty($alertas)) {

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