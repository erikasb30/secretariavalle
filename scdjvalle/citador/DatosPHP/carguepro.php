<?php
// Cargar las librerías de PHPExcel
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php'; // Cambiado a IOFactory.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Configuración para manejar el archivo subido
    $target_dir = "uploads/"; // Directorio donde se guardará el archivo subido
    $target_file = $target_dir . basename($_FILES["documento"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si es un archivo Excel
    if ($fileType != "xls" && $fileType != "xlsx") {
        echo "Error: El archivo debe ser un archivo Excel (XLS, XLSX).";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo (opcional)
    if ($_FILES["documento"]["size"] > 500000) {
        echo "Error: El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Crear el directorio uploads si no existe
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["documento"]["tmp_name"], $target_file)) {
        // Procesar el archivo Excel
        $objPHPExcel = PHPExcel_IOFactory::load($target_file);
        $sheet = $objPHPExcel->getActiveSheet();
        $highestRow = $sheet->getHighestRow();

        // Conexión a la base de datos (debes configurar tus propios datos de conexión)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cndj";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Recorrer cada fila del archivo Excel a partir de la fila 14
            for ($i = 14; $i <= $highestRow; $i++) {
                $radicacion = $sheet->getCell('B'.$i)->getValue();
                $procuraduria = $sheet->getCell('C'.$i)->getValue();
                $despacho = $sheet->getCell('D'.$i)->getValue();
                $mes = $sheet->getCell('E'.$i)->getValue();
                $dia = $sheet->getCell('F'.$i)->getValue();

                // Validar que 'radicacion' no sea null
                if ($radicacion !== null) {
                    // Validar que 'despacho' no sea null
                    if ($despacho !== null) {
                        // Insertar los datos en la base de datos
                        $stmt = $conn->prepare("INSERT INTO repa_procuraduria (radicacion, procuraduria, despacho, mes, dia)
                                               VALUES (:radicacion, :procuraduria, :despacho, :mes, :dia)");
                        $stmt->bindParam(':radicacion', $radicacion);
                        $stmt->bindParam(':procuraduria', $procuraduria);
                        $stmt->bindParam(':despacho', $despacho);
                        $stmt->bindParam(':mes', $mes);
                        $stmt->bindParam(':dia', $dia);
                        $stmt->execute();
                    } else {
                        echo "Advertencia: Se encontró una fila con 'despacho' nulo en la fila $i, no se insertó en la base de datos.";
                    }
                } else {
                    echo "Advertencia: Se encontró una fila con 'radicacion' nula en la fila $i, no se insertó en la base de datos.";
                }
            }
            echo "Los datos se han cargado correctamente.";

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
    } else {
        echo "Error al subir el archivo.";
    }
}
?>
