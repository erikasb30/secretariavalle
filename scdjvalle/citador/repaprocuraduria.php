<?php
// Verificar si se ha enviado un archivo
if (isset($_FILES['archivo'])) {
    // Obtener detalles del archivo
    $nombreArchivo = $_FILES['archivo']['name'];
    $tipoArchivo = $_FILES['archivo']['type'];
    $tamanioArchivo = $_FILES['archivo']['size'];
    $rutaTemporal = $_FILES['archivo']['tmp_name'];

    // Mover el archivo de la ruta temporal a una ubicación permanente
    $rutaDestino = 'ruta/del/archivo/' . $nombreArchivo;
    move_uploaded_file($rutaTemporal, $rutaDestino);

    // Procesar el archivo (aquí podrías llamar a tu función procesarArchivo)
    // Por ejemplo:
    $contenido = procesarArchivo($rutaDestino, $tipoArchivo);

    // Hacer algo con el contenido del archivo, como imprimirlo
    echo "<pre>$contenido</pre>";
} else {
  
    // Si no se ha enviado ningún archivo, mostrar un mensaje de error
    echo "Error: No se ha seleccionado ningún archivo.";
}
?>
