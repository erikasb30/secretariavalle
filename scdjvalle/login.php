<?php
session_start();

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer conexión con la base de datos
    $servername = "localhost";
    $username = "root"; // Cambia el nombre de usuario si es diferente
    $password = ""; // Cambia la contraseña si es diferente
    $dbname = "cndj"; // Nombre de la base de datos que creaste

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Obtener los datos de inicio de sesión del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
  

    // Realizar la consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Obtener la fila del usuario
        $row = mysqli_fetch_assoc($result);

        // Obtener la contraseña almacenada en formato hash
        $stored_password = $row['password'];

        // Verificar la contraseña
        if (password_verify($password, $stored_password)) {
            // Usuario autenticado correctamente, establecer variable de sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username; // Guardar el nombre de usuario en la sesión
            header("Location: portalcndj.php");
            exit(); // Termina el script para evitar que se ejecute el resto del código
        } else {
            // Contraseña incorrecta
            echo "Usuario o contraseña incorrectos";
            echo "<br>";
            echo '<a href="index.html">Volver al inicio de sesión</a>';
        }
    } else {
        // Usuario no encontrado
        echo "Usuario o contraseña incorrectos";
        echo "<br>";
        echo '<a href="index.html">Volver al inicio de sesión</a>';
    }

    // Cerrar la conexión
    mysqli_close($conn);
}
?>
