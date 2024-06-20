<?php
require_once('connect.php'); // Incluir el archivo de conexión a la base de datos
$ReadSql = "SELECT * FROM `datos_disciplinaria`"; // Consulta SQL para seleccionar todos los datos de la tabla
$res = mysqli_query($con, $ReadSql); // Ejecutar la consulta SQL y almacenar los resultados en $res
include("header.php"); // Incluir el encabezado de la página
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<!--<div style="width: 100%; height: 10px; clear: both;"></div>-->
<h2>Mantenimiento de registros insertados con PHP Excel</h2>
<form action="" method="post">

  <button type="submit" name="export_excel">Generar</button>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th> <!-- Columna para el número de fila -->
            <th scope="col">Radicacion</th> <!-- Columna para la radicación -->
            <th scope="col">Secuencia</th> <!-- Columna para la secuencia -->
            <th scope="col">Grupo</th> <!-- Columna para el grupo -->
            <th scope="col">Actor</th> <!-- Columna para el actor -->
            <th scope="col">Demandado</th> <!-- Columna para el demandado -->
            <th scope="col">Codigo Magistrado</th> <!-- Columna para el código del magistrado -->
            <th scope="col">Magistrado</th> <!-- Columna para el magistrado -->
            <th scope="col">Fecha Reparto</th> <!-- Columna para la fecha de reparto -->
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0; // Variable para contar las filas
        while ($r = mysqli_fetch_assoc($res)) { // Recorrer cada fila de los resultados
            $i++; // Incrementar el contador de filas
        ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th> <!-- Mostrar el número de fila -->
                <td><?php echo $r['radicacion']; ?></td> <!-- Mostrar la radicación -->
                <td><?php echo $r['secuencia']; ?></td> <!-- Mostrar la secuencia -->
                <td><?php echo $r['grupo']; ?></td> <!-- Mostrar el grupo -->
                <td><?php echo $r['actor']; ?></td> <!-- Mostrar el actor -->
                <td><?php echo $r['demandado']; ?></td> <!-- Mostrar el demandado -->
                <td><?php echo $r['codmagistrado']; ?></td> <!-- Mostrar el código del magistrado -->
                <td><?php echo $r['magistrado']; ?></td> <!-- Mostrar el magistrado -->
                <td><?php echo $r['fechareparto']; ?></td> <!-- Mostrar la fecha de reparto -->
            </tr>
        <?php } ?>
    </tbody>
</table>
</form>
<?php

// Procesar la solicitud de exportación a Excel
if(isset($_POST['export_excel'])) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="datasoult.xls"');

    // Salida de datos a Excel
    $output = fopen("php://output", "w");
    fputcsv($output, array('#', 'radicacion', 'secuencia'));
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
}

include("footer.php"); //<!-- Incluir el pie de página -->

?>
