<?php

namespace Controllers;

use Model\Contrato;
use MVC\Router;
use Model\Usuario;

class ClienteController { 

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
        } else if ($_GET["lang"] !== "es" && $_GET["lang"] !== "en") {
            header("Location: /?lang={$idioma}");
            exit;
        }

        if(!is_auth()) {
            header('Location: /');
        }

        $contratos = Contrato::whereArray(["inversionista_id" => $_SESSION["id"] ]);
        
        $contratosActivos = 0;

        foreach($contratos as $contrato) {
            $contrato->inversionista = Usuario::find($contrato->inversionista_id);

            if($contrato->estado === "Activo") {
                $contratosActivos += 1;
            }
        }

        $cliente = Usuario::find($_SESSION["id"]);
        $cambiopass = $cliente->cambiopass;

        $router->render("paginas{$idioma}/cliente/dashboard/index", [
            'titulo' => $idioma === 'es' ? 'Área Cliente' : 'Client Area',
            'contratos' => $contratos,
            'contratosActivos' => $contratosActivos,
            'cambiopass' => $cambiopass,
            'idioma' => $idioma
        ]);
    }

    public static function contratos(Router $router) { 
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();

        // Si la página principal es solicitada sin un idioma específico, redirige a la misma página con el idioma predeterminado
        if (empty($_GET['lang']) && empty($_SERVER['QUERY_STRING'])) {
            header("Location: /?lang={$idioma}");
            exit;
        } else if ($_GET["lang"] !== "es" && $_GET["lang"] !== "en") {
            header("Location: /?lang={$idioma}");
            exit;
        }

        if(!is_auth()) {
            header('Location: /');
        }

        $contratos = Contrato::whereArray(["inversionista_id" => $_SESSION['id']]);
        
        $router->render("paginas{$idioma}/cliente/contratos/index", [
            'titulo' => $idioma === 'es' ? 'Mis Contratos' : 'My Contracts',
            'contratos' => $contratos
        ]);
    }

    public static function perfil(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();

        // Si la página principal es solicitada sin un idioma específico, redirige a la misma página con el idioma predeterminado
        if (empty($_GET['lang']) && empty($_SERVER['QUERY_STRING'])) {
            header("Location: /?lang={$idioma}");
            exit;
        } else if ($_GET["lang"] !== "es" && $_GET["lang"] !== "en") {
            header("Location: /?lang={$idioma}");
            exit;
        }

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

        $router->render("paginas{$idioma}/cliente/perfil/index", [
            'titulo' => $idioma === 'es' ? 'Mi Perfil' : 'My Profile',
            "alertas" => $alertas,
            "usuario" => $usuario,
            "perfilActualizado" => $perfilActualizado ?? false
        ]);
    }

    public static function cambiar_password(Router $router) { 
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();

        // Si la página principal es solicitada sin un idioma específico, redirige a la misma página con el idioma predeterminado
        if (empty($_GET['lang']) && empty($_SERVER['QUERY_STRING'])) {
            header("Location: /?lang={$idioma}");
            exit;
        } else if ($_GET["lang"] !== "es" && $_GET["lang"] !== "en") {
            header("Location: /?lang={$idioma}");
            exit;
        }

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
            if (intval($usuario->cambiopass) === 0) {
                $alertas = $usuario->validarPasswordCliente($cambiopass = 0, $idioma);
                
            } else if(intval($usuario->cambiopass) === 1) {
  
                $alertas = $usuario->validarPasswordCliente($cambiopass = 1, $idioma);
            }
            
           
            if(empty($alertas)){ 
                // Aplicamos la nueva contraseña
                $usuario->password = $usuario->password_nuevo;

                // Eliminamos propiedades no necesarias
                unset($usuario->password2);
                unset($usuario->password_actual);
                unset($usuario->password_nuevo);
                unset($usuario->password_nuevo2);
                // Hash pass
                $usuario->hashPassword();
                
                $usuario->cambiopass = '1';

                // Actualizamos el pass
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    $contraActualizada = true;
                }
            }
        }
        
        $alertas = Usuario::getAlertas();

        $router->render("paginas{$idioma}/cliente/perfil/cambiar-password", [
            'titulo' => $idioma === 'es' ? 'Cambiar Contraseña' : 'Change Password',
            "alertas" => $alertas,
            "contraActualizada" => $contraActualizada ?? false
        ]);
    }
}