<?php
require_once("header.php");
require_once("connect.php");
date_default_timezone_set("America/Lima");

// Verificar si se ha enviado el formulario
if (isset($_POST['enviar'])) {
    $archivo = $_FILES['excel']['name'];
    $tipo = $_FILES['excel']['type'];
    $destino = "cop_" . $archivo;

    // Copiar el archivo al servidor
    if (move_uploaded_file($_FILES['excel']['tmp_name'], $destino)) {
        echo "Archivo Cargado Con Éxito";

        // Cargar las librerías de PHPExcel
        require_once('Classes/PHPExcel.php');
        require_once('Classes/PHPExcel/Reader/Excel2007.php');

        // Cargar el archivo Excel
        $objReader = new PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($destino);

        // Establecer la hoja activa
        $objPHPExcel->setActiveSheetIndex(0);

        // Obtener el número de filas
        $filas = $objPHPExcel->getActiveSheet()->getHighestRow();

        // Recorrer cada fila del archivo Excel
        for ($i = 2; $i <= $filas; $i++) {
            $radicacion = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
            $secuencia = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
            $grupo = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
            $actor = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
            $demandado = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
            $codmagistrado = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
            $magistrado = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
            $fechareparto = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();

            // Verificar si el registro ya existe en la base de datos
            $sql_check = "SELECT COUNT(*) AS count FROM datos_disciplinaria WHERE ";
            $sql_check .= "radicacion = '$radicacion' AND ";
            $sql_check .= "secuencia = '$secuencia' AND ";
            $sql_check .= "grupo = '$grupo' AND ";
            $sql_check .= "actor = '$actor' AND ";
            $sql_check .= "demandado = '$demandado' AND ";
            $sql_check .= "codmagistrado = '$codmagistrado' AND ";
            $sql_check .= "magistrado = '$magistrado' AND ";
            $sql_check .= "fechareparto = '$fechareparto'";

            $result_check = mysqli_query($con, $sql_check);

            if (!$result_check) {
                echo "Error al ejecutar la consulta: " . mysqli_error($con);
            } else {
                $row = mysqli_fetch_assoc($result_check);
                if ($row['count'] == 0) {
                    // Si no existe, insertar el registro
                    $sql_insert = "INSERT INTO datos_disciplinaria (radicacion, secuencia, grupo, actor, demandado, codmagistrado, magistrado, fechareparto, activo) ";
                    $sql_insert .= "VALUES ('$radicacion', '$secuencia', '$grupo', '$actor', '$demandado', '$codmagistrado', '$magistrado', '$fechareparto', 1)";

                    $result_insert = mysqli_query($con, $sql_insert);
                    if (!$result_insert) {
                        echo "Error al insertar registro: " . mysqli_error($con);
                    }
                } else {
                    // Si ya existe, mostrar un mensaje
                    echo "Los datos de la fila $i ya han sido cargados previamente.<br>";
                }
            }
        }

        // Eliminar el archivo del servidor
        unlink($destino);
    } else {
        echo "Error al cargar el archivo.";
    }
}

// Mostrar el formulario para cargar el archivo
?>
<div class="container">
    <h2>Cargar e importar archivo excel a MySQL</h2>
    <form name="importa" method="post" action="" enctype="multipart/form-data">
        <div class="col-xs-4">
            <div class="form-group">
                <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="excel">
            </div>
        </div>
        <div class="col-xs-2">
            <input class="btn btn-default btn-file" type='submit' name='enviar' value="Importar" />
        </div>
    </form>
</div>
<?php
include("footer.php");
?>
