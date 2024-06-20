<?php
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirige a la página de inicio de sesión
    header("Location: /pruebateams");
    exit;
}

// Obtener el nombre de usuario de la sesión
$nombre_usuario = $_SESSION['username'];

//Verificar si existe la variable de tiempo de inicio de sesión
if (isset($_SESSION['last_action_time'])) {
    $last_action_time = $_SESSION['last_action_time'];
    $current_time = time();
    // Si han pasado más de 5 minutos, redirigir a la página de inicio de sesión
    if ($current_time - $last_action_time > 300) {
        session_unset(); // Limpia todas las variables de sesión
        session_destroy(); // Destruye la sesión
        header("Location: /pruebateams");
        exit;
    }
}

//Establecer la variable de tiempo de inicio de sesion
$_SESSION['last_action_time'] = time();

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

// Consulta SQL para verificar el rol del usuario
$query = "SELECT role FROM users WHERE username = '$nombre_usuario'";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if ($result) {
    // Obtener el rol del usuario
    $fila = mysqli_fetch_assoc($result);
    $rol_usuario = $fila['role'];

    // Verificar si el usuario tiene rol=1
    if ($rol_usuario == 1) {
        // Mostrar los elementos solo si el usuario tiene rol=1
        ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
</head>
<body>
<h1>Portal Comision Seccional de Disciplina Judicial / Módulo Administrador</h1>
<div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="notificaciones.php">Registro de Radicaciones</a></li>
                <li><a href="salavirtual.html">Audiencias Virtuales</a></li>
                <li><a href="/pruebateams/escribiente/cargueinfo.php">Cargue Proceso</a></li>
                <li><a href="/pruebateams/escribiente/buscaradicado.html">Actualizar Estado Proceso</a></li>
                <li><a href="/pruebateams/escribiente/indiceradicado.html">Eliminar o Descargar Actuación </a></li>
                <li><a href="/pruebateams/GestionDocumental/buscaprocesopro.html">Visualizar Proceso Reparto</a></li>
                <li><a href="/pruebateams/juegoenlinea.php">Juego Ayuda Memoria</a></li>
            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>
                <li><a href="">Efinomina</a></li>

            </ul>
        </li>
        <li><a href="admin/admin.html">Administrador</a></li>
        <li><a href="contactosecretaria.html">Contacto</a></li>
          <li> <a href="/pruebateams">Salir</a></li>
    </ul>
</div>
</body>
</html>
<?php
    }

    // Verificar si el usuario tiene rol=2 (Escribiente)
    if ($rol_usuario == 2) {
        // Mostrar los elementos solo si el usuario tiene rol=1
        ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
</head>
<body>
<h1>Portal Comisión Seccional de Disciplina Judicial / Módulo Escribiente</h1>
<div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="notificaciones.php">Registro de Radicaciones</a></li>
                <li><a href="salavirtual.html">Audiencias Virtuales</a></li>
                <li><a href="/pruebateams/escribiente/cargueinfo.php">Cargue Proceso</a></li>
                <li><a href="/pruebateams/escribiente/buscaradicado.html">Actualizar Estado Proceso</a></li>
                  <li><a href="/pruebateams/escribiente/indiceradicado.html">Eliminar o Descargar Actuación </a></li>


            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>

            </ul>
        </li>
        <li> <a href="/pruebateams">Salir</a></li>
    </ul>
</div>
</body>
</html>
<?php
    }
    // Verificar si el usuario tiene rol=3 (Citador)
    if ($rol_usuario == 3) {
        // Mostrar los elementos solo si el usuario tiene rol=3
        ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
</head>
<body>
<h1>Portal Comision Seccional de Disciplina Judicial / Módulo Citador</h1>
<div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="salavirtual.html">Audiencias Virtuales</a></li>
                  <li><a href="/pruebateams/citador/indiceradicado.html">Eliminar o Descargar Actuación </a></li>
                  <li><a href="/pruebateams/citador/cargueinfo.php">Cargue Proceso</a></li>
                  <li><a href="/pruebateams/citador/DatosPHP/index.php">Reparto Procuraduria</a></li>


            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>
                <li><a href="">Efinomina</a></li>

            </ul>
        </li>
          <li> <a href="/pruebateams">Salir</a></li>
    </ul>
</div>
</body>
</html>
<?php
    }

    // Verificar si el usuario tiene rol=4 (Oficial Mayor)
    if ($rol_usuario == 4) {
        // Mostrar los elementos solo si el usuario tiene rol=4
        ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
</head>
<body>
<h1>Portal Comision Seccional de Disciplina Judicial / Oficial Mayor</h1>
<div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="/pruebateams/escribiente/indiceradicado.html">Eliminar o Descargar Actuación</a></li>
                <li><a href="">Siglo XXI</a></li>

            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>
                <li><a href="">Efinomina</a></li>


            </ul>
        </li>
          <li> <a href="/pruebateams">Salir</a></li>
    </ul>
</div>
</body>
</html>
<?php
    }
    // Verificar si el usuario tiene rol=5 (Profesional)
    if ($rol_usuario == 5) {
        // Mostrar los elementos solo si el usuario tiene rol=5
        ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
 </head>
 <body>
 <h1>Portal Comision Seccional de Disciplina Judicial / Módulo Profesional</h1>
 <div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="/pruebateams/escribiente/indiceradicado.html">Eliminar o Descargar Actuación</a></li>
                <li><a href="">Siglo XXI</a></li>

            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>
                <li><a href="">Efinomina</a></li>


            </ul>
        </li>
          <li> <a href="/pruebateams">Salir</a></li>
    </ul>
 </div>
 </body>
 </html>
 <?php
    }
    // Verificar si el usuario tiene rol=6 (Secretario)
    if ($rol_usuario == 6) {
        // Mostrar los elementos solo si el usuario tiene rol=6
        ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
 </head>
 <body>
 <h1>Portal Comision Seccional de Disciplina Judicial / Módulo Secretario</h1>
 <div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="/pruebateams/escribiente/indiceradicado.html">Eliminar o Descargar Actuación</a></li>
                <li><a href="">Siglo XXI</a></li>

            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>
                <li><a href="">Efinomina</a></li>


            </ul>
        </li>
          <li> <a href="/pruebateams">Salir</a></li>
    </ul>
 </div>
 </body>
 </html>
 <?php
    }

    // Verificar si el usuario tiene rol=7 (Magistrado)
    if ($rol_usuario == 7) {
        // Mostrar los elementos solo si el usuario tiene rol=7
        ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
 </head>
 <body>
 <h1>Portal Comision Seccional de Disciplina Judicial / Módulo Magistrado</h1>
 <div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="/pruebateams/escribiente/indiceradicado.html">Eliminar o Descargar Actuación</a></li>
                <li><a href="">Siglo XXI</a></li>

            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>
                <li><a href="">Efinomina</a></li>


            </ul>
        </li>
          <li> <a href="/pruebateams">Salir</a></li>
    </ul>
 </div>
 </body>
 </html>
 <?php
    }

    // Verificar si el usuario tiene rol=8 (Gestion Documental y Salas Virtuales)
    if ($rol_usuario == 8) {
        // Mostrar los elementos solo si el usuario tiene rol=8
        ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/pruebateams/css/styles.css">
    <title>Portal SDJ VALLE</title>
 </head>
 <body>
 <h1>Portal Comision Seccional de Disciplina Judicial / Módulo Gestión Documental y Salas</h1>
 <div id="header">
    <ul class="nav">
        <li><a href="portalcndj.php">Inicio</a></li>
        <li><a href="">Servicios</a>
            <ul>
                <li><a href="/pruebateams/GestionDocumental/creacionexpedientes.html">Creación de Expedientes </a></li>
                <li><a href="/pruebateams/GestionDocumental/buscaprocesos.html">Buscar Procesos </a></li>
                <li><a href="/pruebateams/GestionDocumental/generateindice.html">Generación de Indices</a></li>
            </ul>
        </li>
        <li><a href="">Acerca de</a>
            <ul>
                <li><a href="https://www.ramajudicial.gov.co/portal/inicio?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&saveLastPath=0&_58_struts_action=%2Flogin%2Flogin">Acceso a Portal Rama Judicial</a></li>
                <li><a href="">Efinomina</a></li>


            </ul>
        </li>
          <li> <a href="/pruebateams">Salir</a></li>
    </ul>
 </div>
 </body>
 </html>
 <?php
    }
 }else {
    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
