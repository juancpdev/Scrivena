<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\ClientesController;
use Controllers\AuthController;
use Controllers\ContratosController;
use Controllers\PaginasController;
use Controllers\DashboardController;

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

// Terminos y avisos
$router->get('/terminos', [PaginasController::class, 'terminos']);
$router->get('/terms', [PaginasController::class, 'terminos']);

$router->get('/privacidad', [PaginasController::class, 'privacidad']);
$router->get('/privacy', [PaginasController::class, 'privacidad']);


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

$router->post('/logout', [AuthController::class, 'logout']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// ADMIN
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/clientes', [ClientesController::class, 'index']);
$router->get('/admin/clientes/crear', [ClientesController::class, 'crear']);
$router->post('/admin/clientes/crear', [ClientesController::class, 'crear']);
$router->get('/admin/clientes/editar', [ClientesController::class, 'editar']);
$router->post('/admin/clientes/editar', [ClientesController::class, 'editar']);
$router->post('/admin/clientes/eliminar', [ClientesController::class, 'eliminar']);

$router->get('/admin/contratos', [ContratosController::class, 'index']);
$router->get('/admin/contratos/crear', [ContratosController::class, 'crear']);
$router->post('/admin/contratos/crear', [ContratosController::class, 'crear']);
$router->get('/admin/contratos/editar', [ContratosController::class, 'editar']);
$router->post('/admin/contratos/editar', [ContratosController::class, 'editar']);
$router->post('/admin/contratos/eliminar', [ContratosController::class, 'eliminar']);

$router->comprobarRutas();