<?php
// Establece la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia el nombre de usuario si es diferente
$password = ""; // Cambia la contraseña si es diferente
$dbname = "cndj"; // Nombre de la base de datos que creaste

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtiene los datos del formulario de registro
$full_name = $_POST['full_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$role = 'normal'; // Puedes ajustar el rol según tus necesidades

// Verifica si el nombre de usuario ya existe en la base de datos
$sql_check_username = "SELECT * FROM users WHERE username='$username'";
$result_check_username = mysqli_query($conn, $sql_check_username);

// Verifica si el correo electrónico ya existe en la base de datos
$sql_check_email = "SELECT * FROM users WHERE email='$email'";
$result_check_email = mysqli_query($conn, $sql_check_email);

if (mysqli_num_rows($result_check_username) > 0) {
    echo "El nombre de usuario ya está registrado. Por favor, elige otro.";
} elseif (mysqli_num_rows($result_check_email) > 0) {
    echo "El correo electrónico ya está registrado. Por favor, utiliza otro.";
} else {
    // Encripta la contraseña antes de almacenarla en la base de datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepara la consulta SQL para insertar un nuevo usuario
    $sql = "INSERT INTO users (full_name, username, password, email, role)
            VALUES ('$full_name', '$username', '$hashed_password', '$email', '$role')";

    if (mysqli_query($conn, $sql)) {
      echo "Usuario registrado correctamente";
      echo "<br>";
      echo '<a href="index.html">Ir a la página de inicio</a>';
      exit(); // Termina el script para evitar que se ejecute el resto del código
    } else {
        echo "Error al registrar usuario: " . mysqli_error($conn);
    }
}

// Cierra la conexión
mysqli_close($conn);
?>

<h1>Loguearse para acceder al portal</h1><a href="http://localhost/pruebateams/index.html">Aqui</a>
