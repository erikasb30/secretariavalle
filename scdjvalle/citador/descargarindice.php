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
    // Consulta SQL para buscar el número de radicado
    $sql = "SELECT * FROM reg_info_despachos WHERE numerorad = '$numerorad'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
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
    <button type="submit" name="export_excel">Exportar a Excel</button> <!-- Botón de descarga -->
    <p>&nbsp;</p>
    <table align="left" cellspacing="0" border="1">
        <tr>
            <th>Nombre de Documento</th>
            <th>Fecha Creación de Documento</th>
            <th>Fecha de Incorporación Expediente</th>
            <th>Orden de Documento</th>
            <th>Número Paginas</th>
            <th>Pagina Inicio</th>
            <th>Pagina Fin</th>
            <th>Formato</th>
            <th>Tamaño</th>
            <th>Origen</th>
            <th>Observaciones</th>
        </tr>

        <?php
        $contador_filas = 0; // Inicializa el contador de filas

        while ($row = $result->fetch_assoc()) {
            $contador_filas++; // Aumenta el contador de filas en cada iteración
            ?>
            <tr>
                <?php
                // Seccionar el nombre del documento
                $nombre_documento = $row['rutadocumento'];
                $partes_nombre = explode("/", $nombre_documento); // Divide el nombre del documento por el guion bajo

                // Mostrar la segunda parte del nombre en la tabla
                echo "<td>{$partes_nombre[5]}</td>";
                ?>
                <!--Fecha de Creacion Expediente-->
                <td><?php echo $row['timestamp']; ?></td>

                <!--Fecha de Incorporacion-->
                <td><?php echo $row['timestamp']; ?></td>

                <!--Orden de Documento-->
                <?php echo "<td>{$contador_filas}</td>"; // Muestra el número de fila?>

                <!--Numero de Paginas-->
                 <td><?php
                     $filename = "{$partes_nombre[5]}";
                     $page_count = shell_exec("pdfinfo $filename | grep Pages: | awk '{print $2}'");
                     echo "Número de páginas: $page_count";
                     ?>
                 </td>


                <!--Pagina de Inicio-->
                <td></td>

                <!--Pagina Fin-->
                <td></td>

                <!--Formato-->
                <?php
                // Obtener la extensión del archivo
                $extension = pathinfo($filename, PATHINFO_EXTENSION);

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
        <?php } ?>
    </table>
</form>
<table>
  <a href='http://localhost/pruebateams/citador/indiceradicado.html'><button>Volver al Buscador</button></a>
</table>
</body>
</html>

<?php
}else {
    echo "¡El número de radicado no cuenta con archivos disponibles!";
}

// Procesar la solicitud de exportación a Excel
if(isset($_POST['export_excel'])) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="data.xls"');

    // Salida de datos a Excel
    $output = fopen("php://output", "w");
    fputcsv($output, array('Nombre de Documento', 'Fecha Creación de Documento', 'Fecha de Incorporación Expediente'));
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
}
}
?>
