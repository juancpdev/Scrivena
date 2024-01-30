<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $usuario = new Usuario($_POST);
            
            $alertas = $usuario->validarLogin();
            
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Usuario::where('email', $usuario->email);

                if(!$usuario) {
                    Usuario::setAlerta('error', 'El Usuario No Existe');
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
                            if($usuario->admin) {
                                header('Location: /admin/dashboard');
                            } else {
                                header('Location: /dashboard');
                            }
                            
                        } else {
                            Usuario::setAlerta('error', 'Password Incorrecto');
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
                            if($usuario->admin) {
                                header('Location: /admin/dashboard');
                            } else {
                                header('Location: /');
                            }
                            
                        } else {
                            Usuario::setAlerta('error', 'Password Incorrecto');
                        }
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Render a la vista 
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
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
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

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
                    $email->enviarInstrucciones();

                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                    $alertas['error'][] = 'El Usuario no existe';
                }
            }
        }
        // Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router) {

        $token = s($_GET['token']);

        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword();

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
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

}