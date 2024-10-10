<?php

$alumnos = [
    [
        "id" => 1,
        "nombre" => "Juan",
        'poblacion' => "Ubrique",
        'curso' => '2DAW'
    ],
    [
        "id" => 2,
        "nombre" => "Pedro",
        'poblacion' => "Prado del rey",
        'curso' => '2DAW'
    ],
    [
        "id" => 3,
        "nombre" => "Mario",
        'poblacion' => "Villamartin",
        'curso' => '1DAW'
    ],
    [
        "id" => 4,
        "nombre" => "Adrian",
        'poblacion' => "Ubrique",
        'curso' => '2DAW'
    ]
];

foreach ($alumnos as $i => $value) {
    echo "<br>";
    echo "alumno $i";
    echo "<br>";
    echo "<br>";

    foreach ($value as $key => $val) {
        echo "[$key] => $val";
        echo "<br>";
    }
}