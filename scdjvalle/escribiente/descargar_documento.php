<?php
// Verificar si se ha proporcionado la ruta del documento
if(isset($_POST['ruta_documento'])) {
    // Obtener la ruta del documento
    $ruta_documento = $_POST['ruta_documento'];

    // Verificar si el archivo existe en el servidor
    if(file_exists($ruta_documento)) {
        // Establecer encabezados para forzar la descarga del archivo
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($ruta_documento) . '"');
        header('Content-Length: ' . filesize($ruta_documento));

        // Leer el archivo y enviar su contenido al cliente
        readfile($ruta_documento);
        exit;
    } else {
        // Si el archivo no existe, mostrar un mensaje de error
        echo "El archivo no existe en el servidor.";
    }
} else {
    // Si no se proporcionó la ruta del documento, redirigir al usuario a una página de error
    header("Location: error.php");
    exit;
}
?>
