<?php

namespace Controllers;

use MVC\Router;

class PaginasController {

    public static function index(Router $router) {
        $router->render("paginas/scrivena", [
            'titulo' => 'Página Principal'
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render("paginas/nosotros", [
            'titulo' => 'Nosotros'
        ]);
    }


}