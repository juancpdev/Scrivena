<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\PaginasController;

$router = new Router();

// Pag Publicas
$router->get('/', [PaginasController::class, 'index']);
$router->get('/', [PaginasController::class, 'index']);

$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/about-us', [PaginasController::class, 'nosotros']);

$router->get('/servicios', [PaginasController::class, 'servicios']);
$router->get('/services', [PaginasController::class, 'servicios']);

$router->get('/portafolio', [PaginasController::class, 'portafolio']);
$router->get('/portfolio', [PaginasController::class, 'portafolio']);

$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);
$router->get('/contact', [PaginasController::class, 'contacto']);
$router->post('/contact', [PaginasController::class, 'contacto']);

$router->get('/terminos', [PaginasController::class, 'terminos']);
$router->get('/terms', [PaginasController::class, 'terminos']);

$router->get('/privacidad', [PaginasController::class, 'privacidad']);
$router->get('/privacy', [PaginasController::class, 'privacidad']);

// Terminos y avisos


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);


$router->comprobarRutas();