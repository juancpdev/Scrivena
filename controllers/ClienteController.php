<?php

namespace Controllers;

use Model\Contrato;
use MVC\Router;
use Model\Usuario;

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

        $contratos = Contrato::whereArray(["inversionista_id" => $_SESSION['id']]);
        
        $router->render('cliente/contratos/index', [
            'titulo' => 'Mis Contratos',
            'contratos' => $contratos
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
        // Ingreso solo usuarios logeados
        if(!is_auth()) {
            header('Location: /');
        }
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);

        $emailOriginal = $usuario->email;

        if($_SERVER["REQUEST_METHOD"] === "POST") { 

            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->actualizarPerfil();
            

            if(empty($alertas)) {
                $emailCambiado = $_POST["email"];
                $existeUsuario = Usuario::where('email', $usuario->email);
                
                if($emailOriginal !== $emailCambiado) {
                    Usuario::setAlerta('error', 'No es posible cambiar el email');
                    $alertas = $usuario->getAlertas();
                } else if($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    Usuario::setAlerta('error', 'Email no válido, ya pertenece a otra cuenta');
                    $alertas = $usuario->getAlertas();
                } else {    
                    $usuario->guardar();
                    $_SESSION["nombre"] = $usuario->nombre;
                    $perfilActualizado = true;
                }

            }
        }

        $router->render("cliente/perfil/index", [ 
            "titulo" => "Mi Perfil",
            "alertas" => $alertas,
            "usuario" => $usuario,
            "perfilActualizado" => $perfilActualizado ?? false
        ]);
    }

    public static function cambiar_password(Router $router) { 

        // Ingreso solo usuarios logeados
        if(!is_auth()) {
            header('Location: /');
        }

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") { 
            $usuario = Usuario::find($_SESSION["id"]);

            // Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);

            // Verificamos si no hay errores al cambiar los password
            $alertas = $usuario->validarPassword();

            if(empty($alertas)){ 
                // Eliminamos propiedades no necesarias
                unset($usuario->password_actual);
                unset($usuario->password_nuevo);
                // Hash pass
                $usuario->hashPassword();
                
                $usuario->cambiopass = '1';

                // Actualizamos el pass
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /cliente/dashboard');
                }
            }
        }
        
        $router->render("cliente/perfil/cambiar-password", [ 
            "titulo" => "Cambiar Password",
            "alertas" => $alertas
        ]);
    }
}