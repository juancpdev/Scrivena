<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Usuario;


class ClientesController { 

    public static function index(Router $router) { 
        if(!is_admin()) {
            header('Location: /');
        }

        $pagina_actual = $_GET["page"];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        
        $registros_por_pagina = 4;
       
        $total = Usuario::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        
        if(!$pagina_actual || $pagina_actual < 1 || $paginacion->total_paginas() < $pagina_actual) {
            header("Location: /admin/clientes?page=1");
        }
        
        $clientes = Usuario::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/clientes/index', [
            'titulo' => 'Clientes',
            'clientes' => $clientes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    
    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /');
        }

        $alertas = [];
        $cliente = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /');
            }

            $cliente->sincronizar($_POST);

            // validar
            $alertas = $cliente->validar();

            // Guardar el registro
            if(empty($alertas)) {

                // Guardar en la BD
                $cliente->guardar();

                $respuesta = [
                    'tipo' => 'exito',
                    'datos' => $cliente
                ];
                echo json_encode($respuesta);
                return;
            } else {
                $respuesta = [
                    'tipo' => 'error',
                    'alertas' => $alertas
                ];
                echo json_encode($respuesta);
                return;
            }

            debuguear($alertas);
        }
        $router->render('admin/clientes/crear', [
            'titulo' => 'Registrar Ponente',
            'cliente' => $cliente,
            'alertas' => $alertas
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /');
        }
        
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if(!$id) {
            header('Location: /admin/clientes');
        }

        $cliente = Usuario::find($id);

        if(!$cliente) {
            header('Location: /admin/clientes');
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /');
            }

            // validar
            $alertas = $cliente->validar();

            // Guardar el registro
            if(empty($alertas)) {

                // Guardar en la BD
                $cliente->guardar();
                
                $respuesta = [
                    'tipo' => 'exito',
                    'datos' => $cliente,
                ];
                echo json_encode($respuesta);
                return;
            } else {
                $respuesta = [
                    'tipo' => 'error',
                    'alertas' => $alertas
                ];
                echo json_encode($respuesta);
                return;
            }
            
        }
        
        $router->render('admin/clientes/editar', [
            'titulo' => 'Actualizar Cliente',
            'cliente' => $cliente,
            'alertas' => $alertas
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
            $cliente = Usuario::find($id);
            $cliente->eliminar();
            header('Location: /admin/clientes');
        }
    }
    
}