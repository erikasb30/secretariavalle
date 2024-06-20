<?php
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer conexión con la base de datos
    $servername = "localhost"; // Cambiar por el servidor de la base de datos
    $username = "root"; // Cambiar por el nombre de usuario de la base de datos
    $password = ""; // Cambiar por la contraseña de la base de datos
    $dbname = "cndj"; // Cambiar por el nombre de la base de datos

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta SQL para verificar el usuario y su rol
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='admin'";

    $result = $conn->query($sql);

// Verificar si la consulta tuvo éxito
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Verificar si se encontró algún resultado
if ($result->num_rows > 0) {
    // Usuario y rol son válidos, redireccionar a la página de administrador
    header("Location: universoadmin.html");
    exit();
} else {
    // Usuario o rol no son válidos, mostrar un mensaje de error
    echo "Usuario o contraseña incorrectos, o no tienes permisos de administrador.";
    echo "<br>";
    echo '<a href="/pruebateams/index.html">Volver al Inicio</a>';
}

    // Cerrar la conexión con la base de datos
    $conn->close();
}
?>
