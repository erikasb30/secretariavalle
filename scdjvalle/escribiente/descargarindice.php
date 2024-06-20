<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "cndj";
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió un número de radicado desde el formulario
if(isset($_GET['numerorad1'])) {
    $numerorad = $_GET['numerorad1'];

    // Consulta SQL para buscar el número de radicado en la tabla radicado_escribiente
    $sql = "SELECT * FROM radicado_escribiente WHERE numerorad = '$numerorad'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener los datos de la tabla radicado_escribiente
        $row1 = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Tabla de Registros</title>
    <style type="text/css">
        body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
        a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  }
        a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  }
        comment { display:none;  }
    </style>
</head>
<body>

<form action="" method="post"> <!-- Agrega un formulario para el botón de descarga -->
    <button type="submit" name="export_excel">Exportar a Excel</button></br> <!-- Botón de descarga -->
    <button type="button" name="button"><a href="http://localhost/pruebateams/escribiente/indiceradicado.html">Volver al Portal</a></button>
    <p>&nbsp;</p>
    <main>
        <table>
        <tr>
           <th><img src="imagenes/ramajudicial.png" alt="Descripción de la imagen"></th>
            <th><h1>ÍNDICE DEL EXPEDIENTE JUDICIAL ELECTRÓNICO</h1></th>
        </tr>
        </table>
        <table align="left" cellspacing="0" border="1">
        <tr>
            <th>Ciudad</th>
        </tr>
        <tr>
            <td><?php echo $row1['municipio']; ?></td>
            <td></td>
        </tr>
        <tr>
            <th>Despacho Judicial</th>
        </tr>
        <tr>
            <td><?php echo $row1['despachojudicial']; ?></td>
        </tr>
        <tr>
            <th>Serie o Subserie Documental</th>
        </tr>
        <tr>
            <td><?php echo $row1['serie']; ?></td>
        </tr>
        <tr>
            <th>No.Radicación del Proceso</th>
        </tr>
        <tr>
            <td><?php echo '\'' . $row1['numerorad']; ?></td> <!-- Agregar comillas simples al principio del número de radicación -->
        </tr>
        <tr>
            <th>Partes Procesales (Parte A)(demandado,procesado,accionado)</th>
        </tr>
        <tr>
            <td><?php echo $row1['procesalesa']; ?></td>
        </tr>
        <tr>
            <th>Partes Procesales (Parte B)(demandante, denunciante, accionante)</th>
        </tr>
        <tr>
            <td><?php echo $row1['procesalesb']; ?></td>
        </tr>
    </table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
    }
}

// Verificar si se envió un número de radicado desde el formulario
if(isset($_GET['numerorad1'])) {
    $numerorad = $_GET['numerorad1'];

// Consulta SQL para buscar el número de radicado en la tabla reg_info_despachos
$sql2 = "SELECT * FROM reg_info_despachos WHERE numerorad = '$numerorad'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $contador_filas = 0; // Inicializa el contador de filas

    while ($row2 = $result2->fetch_assoc()) {
        $contador_filas++; // Aumenta el contador de filas en cada iteración
?>
    <table align="left" cellspacing="0" border="1">
        <tr>
            <th>Nombre de Documento</th>
            <th>Fecha Creación de Documento</th>
            <th>Fecha de Incorporación Expediente</th>
            <th>Orden de Documento</th>
            <th>Número Páginas</th>
            <th>Página Inicio</th>
            <th>Página Fin</th>
            <th>Formato</th>
            <th>Tamaño</th>
            <th>Origen</th>
            <th>Observaciones</th>
        </tr>

        <tr>
<?php
            // Seccionar el nombre del documento
            $nombre_documento = $row2['rutadocumento'];
            $partes_nombre = explode("/", $nombre_documento); // Divide el nombre del documento por el guion bajo

            // Mostrar la segunda parte del nombre en la tabla
            echo "<td>{$partes_nombre[5]}</td>";
?>
            <!--Fecha de Creacion Expediente-->
            <td><?php echo $row2['timestamp']; ?></td>

            <!--Fecha de Incorporacion-->
            <td><?php echo $row2['timestamp']; ?></td>

            <!--Orden de Documento-->
            <?php echo "<td>{$contador_filas}</td>"; // Muestra el número de fila?>

            <!-- Numero de Paginas -->
            <td>
            </td>

            <!--Pagina de Inicio-->
            <td></td>

            <!--Pagina Fin-->
            <td></td>

            <!--Formato-->
            <?php
                // Obtener la extensión del archivo
                $extension = pathinfo($nombre_documento, PATHINFO_EXTENSION);

                // Definir un array de mapeo entre extensiones y formatos
                $formatos = array(
                    'pdf' => 'PDF',
                    'xls' => 'EXCEL',
                    'xlsx' => 'EXCEL',
                    'ppt' => 'POWER POINT',
                    'pptx' => 'POWER POINT',
                    'jpg' => 'JPG',
                    'jpeg' => 'JPEG',
                    'png' => 'PNG',
                    'sql' => 'SQL'
                );

                // Verificar si el formato está en el array
                $formato = isset($formatos[$extension]) ? $formatos[$extension] : 'Desconocido';

                // Mostrar el formato en la tabla HTML
                echo "<td>$formato</td>";
            ?>

            <!--Tamaño-->
            <?php
                // Obtener el tamaño del archivo en bytes
                $tamaño = filesize($nombre_documento);

                // Convertir el tamaño a kilobytes, megabytes, etc. según sea necesario
                $tamaño_kb = $tamaño / 1024; // Tamaño en kilobytes
                $tamaño_mb = $tamaño / (1024 * 1024); // Tamaño en megabytes

                // Mostrar el tamaño en la tabla HTML
                echo "<td>Tamaño: $tamaño bytes ($tamaño_kb KB o $tamaño_mb MB)</td>";
            ?>

            <!--Origen-->
            <td>Electrónico</td>

            <!--Observaciones-->
            <td></td>
        </tr>
<?php
    }
}
}
?>
    </table>
    </main>
</form>
</body>

</html>

<?php
// Procesar la solicitud de exportación a Excel
if(isset($_POST['export_excel'])) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="data.xls"');

    // Salida de datos a Excel
    $output = fopen("php://output", "w");
    fputcsv($output, array('Nombre de Documento', 'Fecha Creación de Documento', 'Fecha de Incorporación Expediente', '\No.Radicacion del Proceso\'')); // Agregar comillas simples al principio del encabezado
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        // Agregar comillas simples al principio del número de radicación
        $row['numerorad'] = '\'' . $row['numerorad'];
        fputcsv($output, $row);
    }
    fclose($output);
}
?>
