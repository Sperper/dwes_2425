<?php
 // Abrir el archivo, creándolo si no existe:
 $archivo = fopen("datos.txt","w+b");
 if( $archivo == false ) {
echo "Error al crear el archivo";
 }
Else {
 // Escribir en el archivo:
fwrite($archivo, "Estamos probando\r\n");
fwrite($archivo, "el uso de archivos ");
fwrite($archivo, "en PHP");

 fflush($archivo);
 }
 // Cerrar el archivo:
 fclose($archivo);
?>
