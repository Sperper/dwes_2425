<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {

    // Juego de caracteres
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'quoted-printable';

    $mail->isSMTP();

    // Cabecera del correo
    $detinatario = 'samuelperezperez2004@gmail.com';
    $remitente = 'samuelperezperez2004@gmail.com';
    $asunto = 'Prueba de correo con PHPMailer';
    $mensaje = '
    <body>
        <h1>Prueba de correo con PHPMailer</h1>
        <p>Este es un mensaje de prueba enviado con PHPMailer.</p>
    </body>
    ';

    $mail->setFrom($remitente, 'Samuel Pérez');
    $mail->addAddress($detinatario);
    $mail->addReplyTo($remitente, 'Samuel Pérez');
    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;

    // Enviar correo
    $mail->send();
    echo 'El mensaje se ha enviado correctamente';

} catch (Exception $e) {
    echo "El mensaje no se ha podido enviar. Mailer Error: {$mail->ErrorInfo}";
}
