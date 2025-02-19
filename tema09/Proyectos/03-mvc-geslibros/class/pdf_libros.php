<?php
require ('fpdf/fpdf.php');


class PDF_Libros extends FPDF {
    // ...existing code...


    public function Header()
    {
        // Select courier normal tamaño 9
        $this->SetFont('Courier', '', 9);

        // Imprimir logo empresa
        $this->image('images/logoTabla.jpEg', 10, 5, 20);

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

        // Escribimos los nombres de las columnas con márgenes ajustados
        $this->Cell(10, 10, iconv('UTF-8', 'ISO-8859-1', '#'), 1, 0, 'C', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Titulo'), 1, 0, 'C', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Autor'), 1, 0, 'C', 1);
        $this->Cell(55, 10, iconv('UTF-8', 'ISO-8859-1', 'Editorial'), 1, 0, 'C', 1);
        $this->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', 'Precio'), 1, 1, 'C', 1);
    }

    // ...existing code...
}


