<?php

$header = 'Mime-Version 1.0' . "\n";
$header .= 'Content-Type: text/html; charset=ISO-8859-1' . "\n";
$header .= 'From: Samuel <nerom24@gmail.com>' . "\n";
$header .= 'X-Mailer: PHP/' . phpversion();

// Definir el destinatario
$destinatario = 'sperper2907@g.educaand.es';
$asunto = 'Prueba de correo';
$mensaje= '<h1>Esto es una prueba de correo</h1>';

// Enviar correo
if (mail($destinatario, $asunto, $mensaje, $header)) {
    echo 'Mensaje enviado correctamente';
} else {
    echo 'Error al enviar el mensaje';
}