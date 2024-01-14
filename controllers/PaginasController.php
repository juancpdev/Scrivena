<?php

namespace Controllers;

use MVC\Router;

class PaginasController {

    public static function obtenerIdiomaNavegador() {
        // Obtiene la lista de idiomas desde la cabecera "Accept-Language" del navegador
        $idiomas = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        
        // Extrae el idioma principal de la lista
        $idiomaNavegador = strtolower(substr($idiomas[0], 0, 2));

        // Verifica si el idioma es compatible con tu aplicación
        if (in_array($idiomaNavegador, ['es', 'en'])) {
            return $idiomaNavegador;
        }

        // Si no es compatible, devuelve el idioma por defecto de tu aplicación
        return 'es';
    }

    public static function index(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();

        // Si la página principal es solicitada sin un idioma específico, redirige a la misma página con el idioma predeterminado
        if (empty($_GET['lang']) && empty($_SERVER['QUERY_STRING'])) {
            header("Location: /?lang={$idioma}");
            exit;
        }
        
        $router->render("paginas{$idioma}/index_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Página Principal' : 'Homepage'
        ]);
    }

    public static function servicios(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/servicios_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Servicios' : 'Services'
        ]);
    }

    public static function nosotros(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/nosotros_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Nosotros' : 'About Us'
        ]);
    }

    public static function portafolio(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/portafolio_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Portafolio' : 'Portfolio'
        ]);
    }
    
    public static function contacto(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/contacto_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Contacto' : 'Contact'
        ]);
    }
    
}
