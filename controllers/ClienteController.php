<?php

namespace Controllers;

use MVC\Router;

class ClienteController { 

    public static function index(Router $router) { 
        if(!is_auth()) {
            header('Location: /');
        }

        $router->render('cliente/dashboard/index', [
            'titulo' => 'Área Cliente',
        ]);
    }

    public static function contratos(Router $router) { 
        if(!is_auth()) {
            header('Location: /');
        }

        $router->render('cliente/contratos/index', [
            'titulo' => 'Mis Contratos',
        ]);
    }

    public static function informacion(Router $router) { 
        if(!is_auth()) {
            header('Location: /');
        }

        $router->render('cliente/informacion/index', [
            'titulo' => 'Información',
        ]);
    }

    public static function perfil(Router $router) { 
        if(!is_auth()) {
            header('Location: /');
        }

        $router->render('cliente/perfil/index', [
            'titulo' => 'Mi Perfil',
        ]);
    }


}