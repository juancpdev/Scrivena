<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    
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

    public static function login(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();

        // Si la página principal es solicitada sin un idioma específico, redirige a la misma página con el idioma predeterminado
        if (empty($_GET['lang']) && empty($_SERVER['QUERY_STRING'])) {
            header("Location: /?lang={$idioma}");
            exit;
        }

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $usuario = new Usuario($_POST);
            
            $alertas = $usuario->validarLogin($idioma);
            
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Usuario::where('email', $usuario->email);

                if(!$usuario) {
                    if ($idioma === 'es') {
                        Usuario::setAlerta('error', 'El Usuario No Existe');
                    } else {
                        Usuario::setAlerta('error', 'Username does not exist');
                    }
                } else {
                    // El Usuario existe
                    if (intval($usuario->cambiopass) === 0) {
                        if ($_POST['password'] == $usuario->password) {
                        
                            // Iniciar la sesión
                            session_start();
                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre;
                            $_SESSION['apellido'] = $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            // Redirección
                            if($usuario->admin === "1") {
                                header('Location: /admin/dashboard');
                            } else {
                                header('Location: /cliente/dashboard');
                            }
                            
                        } else {
                            if ($idioma === 'es') {
                                Usuario::setAlerta('error', 'Contraseña Incorrecta');
                            } else {
                                Usuario::setAlerta('error', 'Incorrect Password');
                            }
                        }
                    } else if (intval($usuario->cambiopass) === 1) {
                        if( password_verify($_POST['password'], $usuario->password) ) {
                        
                            // Iniciar la sesión
                            session_start();    
                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre;
                            $_SESSION['apellido'] = $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['admin'] = $usuario->admin ?? null;
    
                            // Redirección 
                            if($usuario->admin === "1") {
                                header('Location: /admin/dashboard');
                            } else {
                                header('Location: /cliente/dashboard');
                            }
                            
                        } else {
                            if ($idioma === 'es') {
                                Usuario::setAlerta('error', 'Contraseña Incorrecta');
                            } else {
                                Usuario::setAlerta('error', 'Incorrect Password');
                            }
                        }
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Render a la vista 
        $router->render("paginas{$idioma}/auth/login", [
            'titulo' => $idioma === 'es' ? 'Iniciar Sesión' : 'Login',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
    }

    public static function olvide(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();

        // Si la página principal es solicitada sin un idioma específico, redirige a la misma página con el idioma predeterminado
        if (empty($_GET['lang']) && empty($_SERVER['QUERY_STRING'])) {
            header("Location: /?lang={$idioma}");
            exit;
        }

        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail($idioma);

            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->enviarInstrucciones($idioma);

                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                    if ($idioma === 'es') {
                        $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                    } else {
                        $alertas['exito'][] = 'We have sent the instructions to your email';
                    }

                } else {
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                    if ($idioma === 'es') {
                        $alertas['error'][] = 'El Usuario no existe';
                    } else {
                        $alertas['error'][] = 'Username does not exist';
                    }
                }
            }
        }
        // Muestra la vista
        $router->render("paginas{$idioma}/auth/olvide", [
            'titulo' => $idioma === 'es' ? 'Olvide mi Contraseña' : 'Forgot my password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();

        // Si la página principal es solicitada sin un idioma específico, redirige a la misma página con el idioma predeterminado
        if (empty($_GET['lang']) && empty($_SERVER['QUERY_STRING'])) {
            header("Location: /?lang={$idioma}");
            exit;
        }

        $token = s($_GET['token']);

        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            if ($idioma === 'es') {
                Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            } else {
                Usuario::setAlerta('error', 'Invalid Token, try again');
            }

            $token_valido = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword($idioma);

            if(empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token y actualizar BD
                $usuario->token = null;
                $usuario->cambiopass = '1';

                // Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    if ($idioma === 'es') {
                        header('Location: /acceder?lang=es');
                    } else {
                        header('Location: /login?lang=en');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render("paginas{$idioma}/auth/reestablecer", [
            'titulo' => $idioma === 'es' ? 'Reestablecer Contraseña' : 'Restore password',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

}