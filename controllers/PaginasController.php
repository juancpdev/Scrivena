<?php

namespace Controllers;

use Exception;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

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
            'titulo' => $idioma === 'es' ? 'Servicios' : 'Services',
            'subtitulo' => $idioma === 'es' ? "Potenciando el Futuro: Inversión Estratégica y Financiamiento Sostenible" : "Empowering the Future: Strategic Investment and Sustainable Financing",
            'clase' => 'Servicios'
        ]);
    }

    public static function nosotros(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/nosotros_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Nosotros' : 'About Us',
            'subtitulo' => $idioma === 'es' ? "Expertos en Inversiones y Financiamiento" : "Investment and Financing Experts",
            'clase' => 'Nosotros'
        ]);
    }

    public static function portafolio(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/portafolio_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Portafolio' : 'Portfolio',
            'subtitulo' => $idioma === 'es' ? "Rendimientos Sólidos - Conoce Nuestro Portafolio" : "Solid Returns - Learn About Our Portfolio",
            'clase' => 'Portafolio'
        ]);
    }
    
    public static function contacto(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
    
        $mensaje = null;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuesta = $_POST['contacto'];
    
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer(true);
    
            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = $_ENV['EMAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Port = $_ENV['EMAIL_PORT'];
                $mail->Username = $_ENV['EMAIL_USER'];
                $mail->Password = $_ENV['EMAIL_PASS'];
                $mail->SMTPSecure = 'tls';
    
                // Configurar el contenido del mail
                $mail->setFrom($respuesta['email'], $respuesta['nombre']);
                $mail->addAddress('contacto@scrivena.com', 'Scrivena Contacto');
                $mail->Subject = 'Mensaje de contacto';
    
                // Habilitar HTML
                $mail->isHTML(true);
                $mail->CharSet = "UTF-8";
    
                // Contenido HTML mejorado
                $contenido = <<<HTML
                        <!DOCTYPE html>
                        <html lang="es">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&display=swap" rel="stylesheet">
                            <title>Contacto Profesional</title>
                            <style>
                                body {
                                    font-family: 'Source Sans Pro', sans-serif;
                                    background-color: #eaeaea;
                                    color: #333;
                                    margin: 0;
                                    padding: 0;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    height: 100vh;
                                }

                                .contacto-container {
                                    background-color: #ffffff;
                                    padding: 20px;
                                    border-radius: 12px;
                                    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
                                    width: 100%;
                                    max-width: 600px;
                                    text-align: center;
                                }

                                .contacto-header {
                                    margin-bottom: 30px;
                                }

                                .contacto-header .logo {
                                    max-width: 100px;
                                    height: auto;
                                    margin-bottom: 15px;
                                }

                                .contacto-header h1 {
                                    font-weight: 700;
                                    color: #00515f;
                                    margin: 0;
                                }

                                .contacto-info p {
                                    font-size: 16px;
                                    line-height: 1.8;
                                    margin: 10px 0;
                                    color: #555;
                                }

                                .contacto-info p strong {
                                    color: #000;
                                }

                            </style>
                        </head>
                        <body>
                            <div class="contacto-container">
                                <div class="contacto-header">
                                    <img src="https://i.ibb.co/1GGG4jB/LOGOSCRIVENA.png" alt="Logo Scrivena" class="logo">
                                    <h1>Mensaje de Contacto</h1>
                                </div>
                                <div class="contacto-info">
                                    <p><strong>Nombre:</strong> {$respuesta['nombre']} {$respuesta['apellido']}</p>
                                    <p><strong>Email:</strong> {$respuesta['email']}</p>
                                    <p><strong>Teléfono:</strong> {$respuesta['telefono']}</p>
                                    <p><strong>Mensaje:</strong> {$respuesta['mensaje']}</p>
                                </div>
                            </div>
                        </body>
                        </html>
                HTML;
    
                $mail->Body = $contenido;
    
                // Enviar el mail
                if($mail->send()) {
                    $mensaje = "Mensaje enviado correctamente";
                } else {
                    $mensaje = "El mensaje no se pudo enviar...";
                }
    
                // Éxito
                $mensaje = $idioma === 'es' ? 'Mensaje enviado correctamente' : 'Message sent successfully';
            } catch (Exception) {
                // Error
                $mensaje = $idioma === 'es' ? "El mensaje no se pudo enviar" : "Failed to send the message";
            }
        }
    
        $router->render("paginas{$idioma}/contacto_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Contacto' : 'Contact',
            'subtitulo' => $idioma === 'es' ? "Comunicación Directa y Personalizada" : "Direct and Personalized Communication",
            'clase' => 'Contacto',
            'mensaje' => $mensaje
        ]);
    }

    public static function preguntas(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/preguntas_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Preguntas Frecuentes' : 'Frequent Questions'
        ]);
    }
    
    public static function terminos(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/terminos_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Términos y Condiciones' : 'Terms and Conditions'
        ]);
    }

    public static function privacidad(Router $router) {
        $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : self::obtenerIdiomaNavegador();
        $router->render("paginas{$idioma}/privacidad_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Aviso de Privacidad' : 'Notice of Privacy'
        ]);
    }
}