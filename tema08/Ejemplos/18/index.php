<?php

const alumnos = [
  ["Ana", "García López", "1 DAW", "Ubrique"],
  ["Carlos", "Pérez Fernández", "2 DAW", "Cádiz"],
  ["Lucía", "Martínez Sánchez", "1 SMR", "Prado"],
  ["Marcos", "Rodríguez Jiménez", "2 SMR", "Ubrique"],
  ["Sofía", "Hernández Ruiz", "1 AD", "Cádiz"],
  ["Javier", "Gómez Morales", "2 AD", "Prado"],
  ["Raquel", "Muñoz Díaz", "1 DAW", "Ubrique"],
  ["David", "Navarro Torres", "2 SMR", "Cádiz"],
  ["Elena", "Vega Martín", "1 SMR", "Prado"],
  ["Luis", "Domínguez Castro", "2 AD", "Ubrique"]
];

// creamos el fichero csv
$fichero = fopen('csv/alumnos.csv', 'ab');

// escribo los datos de los alumnos
foreach (alumnos as $alumno) {
    fputcsv($fichero, $alumno);
}

fclose($fichero);

