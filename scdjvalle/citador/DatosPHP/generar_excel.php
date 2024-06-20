<?php
ob_start(); // Inicia el buffer de salida

// Incluir la biblioteca PHPExcel
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

// Crear un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Agregar datos al archivo Excel
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Número')
            ->setCellValue('B1', 'Radicacion')
            ->setCellValue('C1', 'Procuraduria')
            ->setCellValue('D1', 'Despacho')
            ->setCellValue('E1', 'Mes');

// Obtener los datos de datosprueba.php
require_once('datosprueba.php');
$i = 2; // Iniciar desde la segunda fila
while ($r = mysqli_fetch_assoc($res)) {
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-1)
                ->setCellValue('B'.$i, $preliminar) // Reemplaza 'fechareparto' con el nombre correcto del campo
                ->setCellValue('C'.$i, " ") // Reemplaza 'radicacion' con el nombre correcto del campo
                ->setCellValue('D'.$i, $r['codmagistrado']) // Reemplaza 'codmagistrado' con el nombre correcto del campo
                ->setCellValue('D'.$i, $mes); // Reemplaza 'codmagistrado' con el nombre correcto del campo
    $i++;
}

// Configurar el nombre del archivo Excel
$archivo_excel = "datos_procuraduria.xls";

// Configurar el tipo de contenido y la descarga del archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$archivo_excel.'"');
header('Cache-Control: max-age=0');

// Crear el archivo Excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

// Limpiar el buffer de salida y enviar la salida al navegador
ob_end_flush();
exit;
?>
