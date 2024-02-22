<?php

namespace Classes;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarInstrucciones($lang) {
        // Crear una instancia de PHPMailer
        $mail = new PHPMailer(true);
    
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls';
    
            // Remitente y destinatario
            $mail->setFrom('contacto@scrivena.com');
            $mail->addAddress($this->email, $this->nombre);
    
            // Asunto
            $subject = $lang === "es" ? 'Reestablecer tu contraseña' : 'Reset your password';
            $mail->Subject = $subject;
    
            // Contenido HTML
            $contenido = <<<HTML
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$subject</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #eaeaea;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 12px;
                box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                margin: 30px auto;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
            }
            .header img {
                max-width: 150px;
                height: auto;
                margin-bottom: 15px;
            }
            .header h1 {
                font-weight: 700;
                color: #00515f;
                margin: 0;
                font-size: 1.2rem;
            }
            .button {
                text-align: center;
                margin-bottom: 30px;
            }
            .button a {
                padding: 1rem;
                background-color: #00515f;
                color: white;
                text-decoration: none;
                border-radius: 1rem;
                display: inline-block;
                width: 12rem;
            }
            .content {
                text-align: center;
            }
            .content p {
                font-size: 15px;
                line-height: 1.8;
                color: #555;
            }
            .content p strong {
                color: #000;
            }
        </style>
    </head>
    <body>
    HTML;
    
            // Concatenar el HTML específico del idioma
            if($lang === "es") {
                $contenido .= <<<HTML
                <div class="container">
                    <div class="header">
                        <img src="https://i.ibb.co/1GGG4jB/LOGOSCRIVENA.png" alt="Logo Scrivena">
                        <h1>Hola {$this->nombre}.</h1>
                        <h1>Para reestablecer tu contraseña presiona en el siguiente boton.</h1>
                    </div>
                    <div class="button">
                        <a href="{$_ENV['HOST']}/reset?token={$this->token}&lang=es">Reestablecer contraseña</a>
                    </div>
                    <div class="content">
                        <p>Si tú no solicitaste este cambio, puedes ignorar el mensaje.</p>
                    </div>
                </div>
    HTML;
            } else if($lang === "en") { 
                $contenido .= <<<HTML
                <div class="container">
                    <div class="header">
                        <img src="https://i.ibb.co/1GGG4jB/LOGOSCRIVENA.png" alt="Logo Scrivena">
                        <h1>Hello {$this->nombre}.</h1>
                        <h1>To reset your password, click on the following button.</h1>
                    </div>
                    <div class="button">
                        <a href="{$_ENV['HOST']}/reset?token={$this->token}&lang=en">Reset Password</a>
                    </div>
                    <div class="content">
                        <p>If you did not request this change, you can ignore the message.</p>
                    </div>
                </div>
    HTML;
            }
    
            // Cerrar el HTML y el correo electrónico
            $contenido .= <<<HTML
    </body>
    </html>
    HTML;
    
            // Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';
            
    
            // Asignar el contenido HTML al cuerpo del correo
            $mail->Body = $contenido;
    
            // Enviar el correo electrónico
            $mail->send();

    }
    
}