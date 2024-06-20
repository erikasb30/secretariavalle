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
$numerorad = $_POST['numerorad'];
$categoria = $_POST['categoria'];
$despacho = $_POST['despacho'];
$tipo = $_POST['tipo'];
$usuario = $_POST['usuario'];
$municipio = $_POST['municipio'];
$despachojudicial = $_POST['despachojudicial'];
$serie = $_POST['serie'];
$procesalesa = $_POST['procesalesa'];
$procesalesb = $_POST['procesalesb'];


// Verifica si el numero de radicado ya existe en la base de datos
$sql_check_numerorad = "SELECT * FROM radicado_escribiente WHERE numerorad='$numerorad' AND categoria='$categoria' AND despacho='$despacho' AND tipo='$tipo'";
$result_check_numerorad = mysqli_query($conn, $sql_check_numerorad);


// Verifica si ya existe un radicado con ese número
if (mysqli_num_rows($result_check_numerorad) > 0) {
    echo "Error: El número de radicado ya existe.";
} else {
  
    // Prepara la consulta SQL para insertar un nuevo numero de radicado
    $sql = "INSERT INTO radicado_escribiente (numerorad, categoria,
  despacho, tipo, usuario, municipio, despachojudicial, serie, procesalesa, procesalesb)
        VALUES ('$numerorad', '$categoria', '$despacho',
          '$tipo', '$usuario', '$municipio', '$despachojudicial', '$serie', '$procesalesa', '$procesalesb')";

    // Ejecuta la consulta de inserción
    if (mysqli_query($conn, $sql)) {
        echo "Número de radicado registrado correctamente";
    } else {
        echo "Error al registrar número de radicado: " . mysqli_error($conn);
    }
}

// Cierra la conexión
mysqli_close($conn);
?>


<h4>Ir al Historico</h4><a href="http://localhost/pruebateams/notificaciones.php">Aqui</a>
