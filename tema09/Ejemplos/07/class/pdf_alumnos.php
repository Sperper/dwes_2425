<?php

class Pdf_alumnos extends FPDF
{
    public function Header()
    {
        // Select courier normal tamaño 9
        $this->SetFont('Courier', '', 9);

        // Imprimir logo empresa
        $this->image('images/logo_empresa.jpg', 10, 5, 20);

        // Celda
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Lista de Alumnos - 2DAW - Curso 24/25'), 'B', 1, 'C');

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
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Listado de alumnos'), 0, 1, 'C', 1);

        // Imprimir imagen
        $this->image('images/coche_chino.jpeg', 65, 43, 60);

        // Dejar un espacio de 2 líneas
        $this->Ln(43);
    }

    public function cabecera()
    {
        // sobreado de fondo para el encabezado
        $this->SetFillColor(240, 120, 10);

        // Escribimos los nombres de las columnas
        $this->Cell(10, 10, iconv('UTF-8', 'ISO-8859-1', '#'), 1, 0, 'C', 1);
        $this->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', 'Nombre'), 1, 0, 'L', 1);
        $this->Cell(80, 10, iconv('UTF-8', 'ISO-8859-1', 'Apellidos'), 1, 0, 'L', 1);
        $this->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', 'Curso'), 1, 0, 'L', 1);
        $this->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', 'Edad'), 1, 1, 'R', 1);
    }
}