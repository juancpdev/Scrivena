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
            'subtitulo' => $idioma === 'es' ? "Expertos en Inversiones y Financiamient" : "Investment and Financing Experts",
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
                            <link rel="preconnect" href="https://fonts.googleapis.com">
                        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
                            <style>
                                body {
                                    font-family: 'Roboto', sans-serif;
                                    color: #1c626e;
                                    background-color: #00515f7e;
                                }
                                h1 {
                                    text-align: center;
                                    font-weight: bold;
                                    margin-bottom: 30px;
                                }
                                .mensaje {
                                    max-width: 600px;
                                    margin: 0 auto;
                                    padding: 20px;
                                    background-color: white;
                                    border: 1px solid #ddd;
                                    border-radius: 5px;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                }
                                .mensaje img {
                                    margin-top: 30px;
                                    max-width: 100%;
                                    height: auto;
                                }
                            </style>
                        </head>
                        <body>
                        <div class="mensaje">
                            <h1>Mensaje de Contacto</h1>
                            <p><strong>Nombre:</strong> {$respuesta['nombre']} {$respuesta['apellido']}</p>
                            <p><strong>Email:</strong> {$respuesta['email']}</p>
                            <p><strong>Teléfono:</strong> {$respuesta['telefono']}</p>
                            <p><strong>Mensaje:</strong> {$respuesta['mensaje']}</p>
                            <img src="https://i.ibb.co/1GGG4jB/LOGOSCRIVENA.png" alt="Logo Scrivena">
                        </div>
                    </body>
                    </html>
                HTML;
    
                $mail->Body = $contenido;
    
                // Enviar el mail
                $mail->send();
    
                // Éxito
                $mensaje = $idioma === 'es' ? 'Mensaje enviado correctamente' : 'Message sent successfully';
            } catch (Exception $e) {
                // Error
                $mensaje = $idioma === 'es' ? "El mensaje no se pudo enviar: " : "Failed to send the message: ";
                $mensaje .= $e->getMessage();
            }
        }
    
        $router->render("paginas{$idioma}/contacto_{$idioma}", [
            'titulo' => $idioma === 'es' ? 'Contacto' : 'Contact',
            'subtitulo' => $idioma === 'es' ? "Comunicación Directa y Personalizada" : "Direct and Personalized Communication",
            'clase' => 'Contacto',
            'mensaje' => $mensaje
        ]);
    }
    
}