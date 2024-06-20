<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda por Fecha de Reporte Procuraduria</title>
</head>
<body>
    <h2>Buscar por Fecha Reporte Procuraduria</h2>
    <form action="datosprueba.php" method="POST">
        <label for="fecha_reparto">Selecciona Inicio:</label>
        <select name="fecha_reparto" id="fecha_reparto">
            <?php
            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "cndj");

            // Verificar la conexión
            if (mysqli_connect_errno()) {
                echo "Error en la conexión a MySQL: " . mysqli_connect_error();
                exit();
            }

            // Consulta para obtener las fechas de reparto disponibles
            $query = "SELECT DISTINCT fechareparto FROM datos_disciplinaria ORDER BY fechareparto DESC";
            $result = mysqli_query($conexion, $query);

            // Crear opciones para la lista desplegable
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['fechareparto'] . "'>" . $row['fechareparto'] . "</option>";
            }

            // Cerrar conexión
            mysqli_close($conexion);
            ?>
        </select>
        <label for="fecha_reparto">Selecciona Fin:</label>
        <select name="fecha_reparto" id="fecha_reparto">
            <?php
            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "cndj");

            // Verificar la conexión
            if (mysqli_connect_errno()) {
                echo "Error en la conexión a MySQL: " . mysqli_connect_error();
                exit();
            }

            // Consulta para obtener las fechas de reparto disponibles
            $query = "SELECT DISTINCT fechareparto FROM datos_disciplinaria ORDER BY fechareparto DESC";
            $result = mysqli_query($conexion, $query);

            // Crear opciones para la lista desplegable
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['fechareparto'] . "'>" . $row['fechareparto'] . "</option>";
            }

            // Cerrar conexión
            mysqli_close($conexion);
            ?>
        </select>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>
