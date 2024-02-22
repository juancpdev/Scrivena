<?php

namespace Classes;

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

       if($lang === "es") {
            // create a new object
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
        
            $mail->setFrom('cuentas@devwebcamp.com');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Reestablece tu contraseña';

            // Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p class='hola'><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
            $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "&lang=es'>Reestablecer Contraseña</a>";        
            $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;

            //Enviar el mail
            $mail->send();
       } else if($lang === "en"){
            // create a new object
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
        
            $mail->setFrom('cuentas@devwebcamp.com');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Reset your password';

            // Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hello " . $this->nombre .  "</strong> You have requested to reset your password, follow the following link to do so.</p>";
            $contenido .= "<p>Press here: <a href='" . $_ENV['HOST'] . "/reset?token=" . $this->token . "&lang=en'>Reset Password</a>";        
            $contenido .= "<p>If you did not request this change, you can ignore the message</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;

            //Enviar el mail
            $mail->send();
       }
    }

}