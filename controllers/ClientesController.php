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

        // Verificar si la clave "page" está definida
        $pagina_actual = isset($_GET["page"]) ? $_GET["page"] : 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
            
        $registros_por_pagina = 7;
       
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
            $alertas = $cliente->validarNuevoCliente();

            if(empty($alertas)) {

                // Revisar que el email no este registrado
                $existeUsuario = Usuario::where('email', $cliente->email);
               
                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Email ya está registrado por otro usuario');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Guardar en la BD
                    $resultado = $cliente->guardar();

                    if($resultado) {
                        header('Location: /admin/clientes');
                    }
                }
            }
        }

        $router->render('admin/clientes/crear', [
            'titulo' => 'Registrar Cliente',
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

            $cliente->sincronizar($_POST);

            // validar
            $alertas = $cliente->validar();

            // Guardar el registro
            if(empty($alertas)) {

                // Revisar que el email no esté registrado por otro usuario
                $existeUsuario = Usuario::where2('email', $cliente->email, "AND id <> {$cliente->id}");

                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El Email ya está registrado por otro usuario');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Guardar en la BD
                    $resultado = $cliente->guardar();

                    if ($resultado) {
                        header('Location: /admin/clientes');
                    }
                }


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