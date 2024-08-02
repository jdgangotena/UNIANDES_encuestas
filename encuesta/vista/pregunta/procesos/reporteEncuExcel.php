<?php
/** Incluir la libreria PHPExcel */
//error_reporting(0);

require_once('../../libs/PHPExcel/Classes/PHPExcel.php');

//Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

//Establecer propiedades
$objPHPExcel->getProperties()
    ->setCreator("BUMH")
    ->setLastModifiedBy("BUMH")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel de Reporte")
    ->setDescription("Reporte desde PHP.")
    ->setKeywords("Excel Office 2007 openxml php")
    ->setCategory("Reportes de Excel");

//Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'N°')
    ->setCellValue('B1', 'ENCUESTA')
    ->setCellValue('C1', 'IDENTIFICADOR')
    ->setCellValue('D1', 'PREGUNTA')
    ->setCellValue('E1', 'ALTERNATIVA');

$filtro = $_POST['my_encu_reporte'];
session_start();


require_once('../../../assets/conx/funciones.php');

//OBTENEMOS TODOS LOS DATOS Y LO ALMACENAMOS EN UNA MATRIZ
$conectar = new Funciones();
//$consulta = "SELECT * FROM horario ORDER BY dia ASC;";
$consulta = "SELECT LL.id_llenado, LL.id_encuesta, LL.my_id_token, P.id_pregunta, P.pregunta, 
CASE P.id_tipo_preg  WHEN 3 THEN  LL.my_respuesta ELSE PA.alternativa END AS 'alternativa'
FROM llenado_ns AS LL 
JOIN preg_alternativa_ns AS PA
ON LL.id_preg_alternativa = PA.id_preg_alternativa
JOIN pregunta_ns AS P
ON PA.id_pregunta = P.id_pregunta
WHERE LL.id_encuesta = 1
ORDER BY LL.my_id_token ASC, P.id_pregunta ASC";

$resultado = $conectar->ejecutarReturn($consulta);

$myFilas = 1;

if($resultado != false){
    if(mysqli_num_rows($resultado)>0){
        $cont = 1;
        $i = 2;
        while($fila=$resultado->fetch_array()){
       
//'="0987"'
            $objPHPExcel->getActiveSheet()
                ->SetCellValue('A'.$i, $cont)
                ->SetCellValue('B'.$i, $fila[1])
                ->setCellValueExplicit('C'.$i, strval($fila[2]), PHPExcel_Cell_DataType::TYPE_STRING)
                ->SetCellValue('D'.$i, $fila[4])
                ->SetCellValue('E'.$i, $fila[5]);

            
            $i += 1;
            $cont += 1;
            $myFilas += 1;
        }
    }
    
    $resultado->free();
}




//Estilo pre definido
$styleArrayBorder = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$styleArrayBgm = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'F28A8C'
    ));

//Set Bordes
$objPHPExcel->getActiveSheet()->getStyle('A1:A'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B1:B'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('D1:D'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('E1:E'.$myFilas)->applyFromArray($styleArrayBorder);


//Set Color de fondo
$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->applyFromArray($styleArrayBgm);

$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$myFilas)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

foreach(range('A','E') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}

//Eliminando Variables
unset($styleArrayBorder);
unset($styleArrayBgm);

//Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Encuesta');

//Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteEncu.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

ob_end_clean();
$objWriter->save('php://output');
exit;
?>