<?php

    session_start();


    $_SESSION['nombre'] = 'Pepe';
    $_SESSION['email'] = 'pepe213@gmail.com';
    $_SESSION['perfil'] = 'admin';


    include 'index.php';