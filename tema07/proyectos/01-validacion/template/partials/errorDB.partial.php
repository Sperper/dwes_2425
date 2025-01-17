<h2>ERROR BASE DE DATOS</h2>
<HR>;
<?= "Mensaje:      " . $e->getMessage() . '<BR>' ?>
<?= "Código:       " . $e->getCode() . '<BR>' ?>
<?= "Fichero:      " . $e->getFile() . '<BR>' ?>
<?= "Línea:        " . $e->getLine() . '<BR>' ?>
<?= "Trace:        " . $e->getTraceAsString() . '<BR>' ?>