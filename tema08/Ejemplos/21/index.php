<?php 

   /*
      Crear archivoz ZIP con PHP u la clase  zipArchive
   */

   $zipFile = 'archivo.zip';

   // Crear objeto zipArchive
   $zip = new ZipArchive();

   // Crear archivos zip
   if(!$zip->open($zipFile, ZipArchive::CREATE) === FALSE) {
      echo 'Error al crear el archivo ZIP';
      exit;
   }

   $files = glob("files/");

   foreach ($files as $file) {
      if (is_file($file)) {
         $zip->addFile($file, basename($file));
      }
   }

   $zip->close();
   echo 'Archivo ZIP creado exitosamente';

   