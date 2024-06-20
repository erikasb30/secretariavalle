<?php
require 'PHPExcel-1.8\Classes\PHPExcel.php'; // Ruta a la biblioteca PHPExcel

// Conexión a la base de datos
$servername = "localhost";$username = "root";
$password = "";
$database = "cndj";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado un archivo
if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
    // Capturar la ruta temporal del archivo cargado
    $tmp_name = $_FILES['excel_file']['tmp_name'];

    // Cargar el archivo Excel
    $excel = PHPExcel_IOFactory::load($tmp_name);

    // Obtener la primera hoja del archivo
    $sheet = $excel->getActiveSheet();

    // Obtener el número de filas y columnas en la hoja
    $highestRow = $sheet->getHighestDataRow();
    $highestColumn = $sheet->getHighestDataColumn();
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

    // Nombres de columna de la tabla datos_disciplinaria
    $column_names = array('radicacion', 'secuencia', 'grupo', 'actor', 'demandado', 'cod_magistrado', 'magistrado', 'fecha_reparto');

    // Insertar los datos en la base de datos
    for ($row = 1; $row <= $highestRow; $row++) {
        $values = array();
        for ($col = 0; $col < $highestColumnIndex; $col++) {
            $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getValue();
            $values[] = $cellValue;
        }

        // Verificar si el número de valores coincide con el número de columnas
        if (count($values) == count($column_names)) {
            // Construir la consulta de inserción
            $sql = "INSERT INTO datos_disciplinaria (".implode(", ", $column_names).") VALUES ('".implode("', '", $values)."')";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                echo "Datos insertados correctamente.";
            } else {
                echo "Error al insertar datos: " . $conn->error;
            }
        } else {
            echo "Error: el número de valores no coincide con el número de columnas.";
        }
    }
} else {
    echo "Error al cargar el archivo.";
}

// Cerrar la conexión
$conn->close();
?>
