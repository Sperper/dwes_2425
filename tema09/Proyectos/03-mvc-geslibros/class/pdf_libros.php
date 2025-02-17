<?php
require ('fpdf.php');


class PDF_Libros extends FPDF {
    // ...existing code...

    function Header() {
        // Establecer fuente
        $this->SetFont('Arial', 'B', 12);
        // Título
        $this->Cell(0, 10, 'Encabezado del PDF', 0, 1, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Establecer fuente
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    function titulo($titulo) {
        // Establecer fuente
        $this->SetFont('Arial', 'B', 16);
        // Título
        $this->Cell(0, 10, $titulo, 0, 1, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    function encabezado($encabezado) {
        // Establecer fuente
        $this->SetFont('Arial', 'B', 12);
        // Encabezado
        $this->Cell(0, 10, $encabezado, 0, 1, 'L');
        // Salto de línea
        $this->Ln(5);
    }

    // ...existing code...
}


