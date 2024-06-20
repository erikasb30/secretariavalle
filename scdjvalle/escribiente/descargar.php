<?php
// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cndj");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el número de RAD del archivo a descargar
$numerorad = $_GET['numerorad'];

// Consulta SQL para obtener la ruta del archivo
$sql = "SELECT rutadocumento FROM reg_info_despachos WHERE numerorad = '$numerorad'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $ruta = $fila['rutadocumento'];

    // Descargar el archivo
    header("Content-Disposition: attachment; filename=" . basename($ruta));
    readfile($ruta);
} else {
    echo "No se encontró la ruta del archivo.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
