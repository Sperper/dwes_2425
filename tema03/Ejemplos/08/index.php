<?

/**
 * Devolver el item de una calificacion 
 *  - Deficiente, insuficiente, suficiente
 */

$calif = 7;
$item;

switch ($calif) {
    case ($calif < 0):
        $item = "Calificacion no permitida";
        break;
    case ($calif < 2):
        $item = "Deficiente";
        break;
    case ($calif < 5):
        $item = "Insuficiente";
        break;
    case ($calif < 6):
        $item = "Suficiente";
        break;
    case ($calif < 7):
        $item = "Bien";
        break;
    case ($calif < 9):
        $item = "Notable";
        break;
}