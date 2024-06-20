<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "cndj";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió un número de radicado desde el formulario
if(isset($_POST['id'])) {
    $numerorad = $_POST['id'];

    // Consultar la ruta del documento antes de eliminar el registro
    $sql_select = "SELECT rutadocumento FROM reg_info_despachos WHERE id = '$numerorad'";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $rutadocumento = $row['rutadocumento'];

        // Eliminar el archivo asociado
        if (file_exists($rutadocumento)) {
            unlink($rutadocumento);
        } else {
            echo "El archivo no existe o no se puede acceder.";
        }
    } else {
        echo "No se encontró el registro en la base de datos.";
    }

    // Consulta SQL para eliminar el registro
    $sql = "DELETE FROM reg_info_despachos WHERE id = '$numerorad'";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    echo "No se recibió el número de radicado para eliminar.";
}

// Cerrar conexión
$conn->close();
?>
<a href='http://localhost/pruebateams/escribiente/indiceradicado.html'>Volver al Buscador</a>
