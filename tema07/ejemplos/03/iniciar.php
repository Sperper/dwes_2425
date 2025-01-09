<?php

    session_start();

    echo 'SID: ' . session_id() . '<br>';
    echo 'Name: ' . session_name();

    include 'index.php';