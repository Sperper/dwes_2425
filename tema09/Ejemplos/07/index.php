<?php
/*
    Ejemplo
    
    Hola mundo fpdf
*/

// Incluimos la librería fpdf
require('fpdf186/fpdf.php');

// Incluimos la clase pdf_alumnos
require('class/pdf_alumnos.php');

// Incluir datos
require('datos/basedatos.php');

// Creo objeto pdf_alumnos
$pdf = new Pdf_alumnos('P','mm','A4');

// Imprimir número página actual
$pdf->AliasNbPages();

// Añadimos una página
$pdf->AddPage();

// Añado el título
$pdf->titulo();

// Cabecera del listado
$pdf->cabecera();

// Cuerpo listado
$pdf->SetFont('Courier','',10);
// Fondo pautado para las líneas pares
$pdf->SetFillColor(205,205,205);

$fondo = false;
// Escribimos los datos de los alumnos
foreach ($alumnos as $alumno) {
    $pdf->Cell(10,8,iconv('UTF-8', 'ISO-8859-1', $alumno[0]), 1, 0, 'C',$fondo);
    $pdf->Cell(60,8,iconv('UTF-8', 'ISO-8859-1', $alumno[1]), 1, 0, 'L',$fondo);
    $pdf->Cell(80,8,iconv('UTF-8', 'ISO-8859-1', $alumno[2]), 1, 0, 'L',$fondo); 
    $pdf->Cell(20,8,iconv('UTF-8', 'ISO-8859-1', $alumno[4]), 1, 0, 'L',$fondo);
    $pdf->Cell(20,8,iconv('UTF-8', 'ISO-8859-1', $alumno[3]), 1, 1, 'R',$fondo);
    $fondo = !$fondo;
}


// Cerramos pdf
$pdf->Output('I', 'listado_alumnos.pdf', true);
