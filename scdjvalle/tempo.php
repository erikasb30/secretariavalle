<!--Aqui inicia el script tiempo-->
<?php
// Iniciar la sesión
session_start();

// Tiempo de inactividad en segundos (5 minutos)
$tiempo_inactividad = 300;

// Verificar si hay una sesión activa
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso']) > $tiempo_inactividad) {
    // Si el usuario está inactivo por más tiempo del permitido, destruir la sesión y redirigir al inicio
    session_unset();
    session_destroy();
    header("http://localhost/pruebateams/"); // Cambiar 'inicio.php' al archivo de inicio de tu aplicación
    exit();
}

// Actualizar el tiempo de la última actividad
$_SESSION['ultimo_acceso'] = time();
?>
