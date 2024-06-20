<?php
require_once('connect.php'); // Incluir el archivo de conexión a la base de datos
include("header.php"); // Incluir el encabezado de la página

// Verificar si se ha enviado el formulario de búsqueda
if(isset($_POST['buscar'])){
    // Obtener el valor del campo de búsqueda
    $buscar_despacho = $_POST['buscar_despacho'];
    $fechainicio = $_POST['fechainicio'];
    $fechafin = $_POST['fechafin'];

    // Consulta SQL para seleccionar los datos de la tabla filtrando por el código del magistrado ingresado y por el rango de fechas
    $ReadSql = "SELECT * FROM `datos_disciplinaria` WHERE codmagistrado LIKE '%$buscar_despacho%' AND fechareparto BETWEEN '$fechainicio' AND '$fechafin'";
} else {
    // Consulta SQL para seleccionar todos los datos de la tabla si no se ha enviado el formulario de búsqueda
    $ReadSql = "SELECT * FROM `datos_disciplinaria`";
}

$res = mysqli_query($con, $ReadSql); // Ejecutar la consulta SQL y almacenar los resultados en $res
$resultados = []; // Inicializar un array para almacenar los resultados

// Almacenar los resultados en $resultados
while ($row = mysqli_fetch_assoc($res)) {
    $resultados[] = $row;
}
?>

<div class="container">
    <!--<div style="width: 100%; height: 10px; clear: both;"></div>-->
    <h2>Preliminares Funcionarios Secretaria</h2>

    <!-- Formulario de búsqueda por despacho -->
    <p>&nbsp;</p>
    <form action="" method="post" align="right">
        <label for="buscar_despacho">Buscar por Despacho:</label>
        <input type="text" id="buscar_despacho" name="buscar_despacho">

        <!-- Agregar campos para las fechas de inicio y fin -->
        <label for="fecha_reparto">Selecciona Inicio:</label>
        <select name="fechainicio" id="fecha_reparto1">
          <option value="">
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
            </option>
        </select>

        <!--Seleccion Fecha Fin-->
        <label for="fecha_reparto">Selecciona Fin:</label>
        <select name="fechafin" id="fecha_reparto2">
          <option value="">
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
            </option>
        </select>
        <!--Fin fecha de inicio y fin-->

        <button type="submit" name="buscar">Buscar</button>
        </form>
    <p>&nbsp;</p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th> <!-- Columna para el número de fila -->
                <th scope="col">Radicacion</th> <!-- Columna para la radicación -->
                <th scope="col">Procuraduria</th><!--Columna para notificar codigo procurador-->
                <th scope="col">Despacho</th> <!-- Columna para el código del magistrado -->
                <th scope="col">Mes</th> <!-- Columna para el código del magistrado -->
                <th scope="col">Día</th> <!-- Columna para el código del magistrado -->
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0; // Variable para contar las filas
            foreach ($resultados as $r) { // Recorrer cada fila de los resultados
                $i++; // Incrementar el contador de filas
            ?>
                <tr>
                    <td scope="row"><?php echo $i; ?></td> <!-- Mostrar el número de fila -->
                    <?php
                    // Seccionar el nombre del documento
                    $nombre_documento = $r['fechareparto'];
                    $partes_nombre = explode(" ", $nombre_documento); // Divide el nombre del documento por el guion bajo

                    // Mostrar la segunda parte del nombre en la tabla
                    $year = "{$partes_nombre[3]}";

                    ?>
                    <td>
                        <?php
                        $año = $year;
                        $radicacion = $r['radicacion'];//<!-- Mostrar la radicación -->
                        $preliminar = $año . "-" . str_pad($radicacion, 4, '0', STR_PAD_LEFT);
                        echo $preliminar; // Esto imprimirá el formato deseado para la radicación
                         ?>
                    </td>
                    <td></td>
                    <td><?php echo $r['codmagistrado']; ?></td> <!-- Mostrar el código del magistrado -->
                    <?php
                    // Seccionar el nombre del documento
                    $nombre_documento = $r['fechareparto'];
                    $partes_nombre = explode(" ", $nombre_documento); // Divide el nombre del documento por el guion bajo
                    // Mostrar la primera parte del nombre en la tabla
                    $mes = "{$partes_nombre[0]}";
                    ?>
                  <td> <?php
                    echo $mes;
                   ?> </td> <!-- Mostrar el mes que esta generando -->
                   <?php
                   // Seccionar el nombre del documento
                   $nombre_documento = $r['fechareparto'];
                   $partes_nombre = explode(" ", $nombre_documento); // Divide el nombre del documento por el guion bajo
                   // Mostrar la segunda parte del nombre en la tabla
                   $dia = "{$partes_nombre[1]}";
                   ?>
                 <td> <?php
                   echo $dia;
                  ?> </td> <!-- Mostrar el dia que esta generando -->
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
