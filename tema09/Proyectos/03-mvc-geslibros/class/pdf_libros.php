<?php
require('fpdf/fpdf.php');


class PDF_Libros extends FPDF
{
    // ...existing code...


    public function Header()
    {
        // Select courier normal tamaño 9
        $this->SetFont('Courier', '', 9);

        // Imprimir logo empresa
        $this->image('images/logoTabla.jpEg', 10, 5, 20);

        // Celda
        $this->Cell(0, 10, 'Geslibros', 0, 0, 'L');
        $this->Cell(0, 10, 'Samuel Perez Perez', 0, 0, 'R');
        $this->Ln(5);
        $this->Cell(0, 10, '2DAW 24/25', 0, 1, 'C');

        // Celda
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Lista de Libros - 2DAW - Curso 24/25'), 'B', 1, 'C');

        // Line break
        $this->Ln(10);
    }

    public function Footer()
    {
        $this->setY(-10);
        $this->SetFont('Courier', '', 10);
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Página ') . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

    public function titulo()
    {
        // Establecemos la fuente y el tamaño
        $this->SetFont('Courier', 'B', 10);

        // Color de fondo
        $this->SetFillColor(200, 220, 255);

        // Escribimos el título
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Listado de libros'), 0, 1, 'C', 1);

        // Dejar un espacio de 2 líneas
        $this->Ln(43);
    }

    public function cabecera()
    {
        // sombreado de fondo para el encabezado
        $this->SetFillColor(200, 220, 255);

        $this->Cell(10, 10, iconv('UTF-8', 'ISO-8859-1', '#'), 1, 0, 'C', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Titulo'), 1, 0, 'L', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Autor'), 1, 0, 'L', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Editorial'), 1, 0, 'L', 1);
        $this->Cell(14, 10, iconv('UTF-8', 'ISO-8859-1', 'Stock'), 1, 0, 'C', 1);
        $this->Cell(14, 10, iconv('UTF-8', 'ISO-8859-1', 'Precio'), 1, 1, 'R', 1);
    }

    // ...existing code...
}
