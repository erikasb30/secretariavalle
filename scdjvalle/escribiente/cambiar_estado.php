<?php
// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "cndj");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el número de RAD y el nuevo estado
$id = $_POST['id'];
$numerorad = $_POST['numerorad1'];
$nuevo_estado = $_POST['nuevo_estado']; // Reemplaza 'nuevo_estado' por el valor deseado

// Consulta SQL para actualizar el estado
$sql = "UPDATE reg_info_despachos SET estado = '$nuevo_estado' WHERE numerorad = '$numerorad' AND id='$id'";

// Ejecutar la consulta
if (mysqli_query($conexion, $sql)) {
    echo "Estado actualizado correctamente.";
} else {
    echo "Error al actualizar el estado: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
 <a href='http://localhost/pruebateams/escribiente/buscaradicado.html'><button>Volver al Buscador</button></a>
