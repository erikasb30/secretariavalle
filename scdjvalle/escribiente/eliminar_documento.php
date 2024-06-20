<?php

$recibir_id=$_POST['numerador_id'];

// Verificar si se ha enviado un ID a través de POST
if(isset($recibir_id)) {

    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "cndj");

    // Verificar la conexión
    if (mysqli_connect_errno()) {
        echo "Error al conectar con la base de datos: " . mysqli_connect_error();
        exit();
    }

    // Consulta SQL para eliminar el registro
    $sqldelete = "DELETE FROM reg_info_despachos WHERE id='$recibir_id'";

    // Ejecutar la consulta de eliminación
    if (mysqli_query($conexion, $sqldelete)) {
        echo "¡El Documento fue eliminado con éxito!";
        header:"<a href='http://localhost/pruebateams/escribiente/buscaradicado.html'>Volver</a>"
    } else {
        echo "Error al eliminar el Documento: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    echo "No se ha proporcionado un ID válido para eliminar.";
}
?>
