<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIClientes;
use Controllers\APIContratos;
use MVC\Router;
use Controllers\ClientesController;
use Controllers\AuthController;
use Controllers\ClienteController;
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

$router->get('/preguntas', [PaginasController::class, 'preguntas']);
$router->get('/questions', [PaginasController::class, 'preguntas']);

// Login
$router->get('/acceder', [AuthController::class, 'login']);
$router->post('/acceder', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);
$router->get('/forget', [AuthController::class, 'olvide']);
$router->post('/forget', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);
$router->get('/reset', [AuthController::class, 'reestablecer']);
$router->post('/reset', [AuthController::class, 'reestablecer']);

// APIs
$router->get('/api/clientes', [APIClientes::class, 'index']);
$router->get('/api/cliente', [APIClientes::class, 'cliente']);
$router->get('/api/contratos', [APIContratos::class, 'index']);
$router->get('/api/contratostotal', [APIContratos::class, 'contratos']);

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

// Cliente
$router->get('/cliente/panel', [ClienteController::class, 'index']);
$router->get('/cliente/contratos', [ClienteController::class, 'contratos']);
$router->get('/cliente/perfil', [ClienteController::class, 'perfil']);
$router->post('/cliente/perfil', [ClienteController::class, 'perfil']);
$router->get('/cliente/cambiar-password', [ClienteController::class, 'cambiar_password']);
$router->post('/cliente/cambiar-password', [ClienteController::class, 'cambiar_password']);

$router->get('/client/dashboard', [ClienteController::class, 'index']);
$router->get('/client/contracts', [ClienteController::class, 'contratos']);
$router->get('/client/profile', [ClienteController::class, 'perfil']);
$router->post('/client/profile', [ClienteController::class, 'perfil']);
$router->get('/client/change-password', [ClienteController::class, 'cambiar_password']);
$router->post('/client/change-password', [ClienteController::class, 'cambiar_password']);

$router->comprobarRutas();