<?php 

# Ejemplo 1. Crear sesión personalizada
session_id('123carlosMoreno');
session_name('SESION-UBRIQUE');

# Inicio ahora la sesión
session_start();

echo 'SID: ' . session_id() . '<br>';
echo 'Nombre de la sesión: ' . session_name() . '<br>';