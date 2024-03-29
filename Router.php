<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        
        $url_actual= strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        // Obtén el valor de la variable 'lang' desde la URL
        $langParam = isset($_GET['lang']) ? $_GET['lang'] : 'es';

        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            if ($langParam === 'es') {
                header('Location: /404?lang=es');
                exit();
            } else if ($langParam === 'en') {
                header('Location: /404?lang=en');
                exit();
            }
            
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        $url_actual = $_SERVER['PATH_INFO'] ?? '/';

        if(str_contains($url_actual, '/admin')) {
            include_once __DIR__ . '/views/admin-layout.php';
        } else if (str_contains($url_actual, '/cliente') || str_contains($url_actual, '/client')) {
            include_once __DIR__ . '/views/cliente-layout.php';
        } else {
            include_once __DIR__ . '/views/layout.php';
        }
        

    }
}
