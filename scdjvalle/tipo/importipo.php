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

// Obtiene los datos del formulario de registro de radicado
$tipo = $_POST['nombre_tipo'];
$usuario = $_POST['usuario'];


// Verifica si la categoria ya existe en la base de datos
$sql_check_numerorad = "SELECT * FROM registro_tipo WHERE nombre_tipo='$tipo'";
$result_check_numerorad = mysqli_query($conn, $sql_check_numerorad);

// Verifica si ya existe una categoria con ese nombre
if (mysqli_num_rows($result_check_numerorad) > 0) {
    echo "Error: El número de radicado ya existe.";
} else {
    // Prepara la consulta SQL para insertar una nueva categoria
    $sql = "INSERT INTO registro_tipo (nombre_tipo, usuario)
            VALUES ('$tipo', '$usuario')";

    // Ejecuta la consulta de inserción
    if (mysqli_query($conn, $sql)) {
        echo "Nombre Tipo Registrado Correctamente";
    } else {
        echo "Error al registrar Nombre de Tipo: " . mysqli_error($conn);
    }
}

// Cierra la conexión
mysqli_close($conn);
?>


<h4>Ir al Registro</h4><a href="http://localhost/pruebateams/tipo/registrotipo.php">Aqui</a>
