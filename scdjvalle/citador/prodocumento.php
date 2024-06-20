<?php
// Verificar si se ha enviado el formulario
if(isset($_POST['registrar'])) {
    // Recuperar los datos del formulario
    $numerorad = $_POST['numerorad'];
    $categoria = $_POST['categoria'];
    $despacho = $_POST['despacho'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $usuario = $_POST['usuario'];

    // Verificar si se ha enviado un archivo y si no hubo errores en su carga
    if(isset($_FILES['documento']) && $_FILES['documento']['error'] === UPLOAD_ERR_OK) {
        // Manejar la carga del archivo
        $file_name = $_FILES['documento']['name'];
        $file_tmp = $_FILES['documento']['tmp_name'];
        $file_destination = "C:/xampp/htdocs/pruebateams/CargueDocumentos/" . $file_name;

        // Verificar si ya existe un archivo con el mismo nombre y la misma combinación de categoria, despacho, tipo y estado
        if (!file_exists($file_destination) && !documentoYaCargado($file_destination)) {
            // Mover el archivo cargado a la carpeta de destino
            if(move_uploaded_file($file_tmp, $file_destination)) {
                // Conectar con la base de datos
                $conn = new mysqli("localhost", "root", "", "cndj");

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                // Preparar la consulta SQL para insertar los datos en la base de datos
                $sql = "INSERT INTO reg_info_despachos (numerorad, categoria, despacho, tipo, estado, usuario, rutadocumento) VALUES ('$numerorad', '$categoria', '$despacho', '$tipo', '$estado', '$usuario', '$file_destination')";

                // Ejecutar la consulta SQL
                if ($conn->query($sql) === TRUE) {
                    echo "Documento cargado y datos insertados correctamente.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Cerrar la conexión
                $conn->close();
            } else {
                echo "Error al mover el archivo cargado a la carpeta de destino.";
            }
        } else {
            echo "Error: Ya existe un documento con la misma ruta en la base de datos.";
        }
    } else {
        // Error en la carga del archivo
        echo "Error al cargar el archivo.";
    }
}

// Función para verificar si ya se ha cargado un documento con la misma ruta en la base de datos
function documentoYaCargado($rutadocumento) {
    $conn = new mysqli("localhost", "root", "", "cndj");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL
    $sql = "SELECT * FROM reg_info_despachos WHERE rutadocumento = '$rutadocumento'";

    // Ejecutar la consulta SQL
    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result && $result->num_rows > 0) {
        // Documento ya cargado con la misma ruta
        return true;
    } else {
        // No se encontraron documentos cargados con la misma ruta
        return false;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<a href="/pruebateams/escribiente/cargueinfo.php">Volver</a>
