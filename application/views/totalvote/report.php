<?php 
/**/require_once("Classes/PHPExcel.php");
ini_set("memory_limit", "500M");
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
$cacheSettings = array("dir" => "/user/local/tmp");
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setTitle("Data");

$rowNumber = 2;
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		$col = "A";
			foreach($row as $cell){
				$objPHPExcel->getActiveSheet()->setCellValue($col .$rowNumber, $cell);
				$col++;
			}
		$rowNumber++;
	}
$hr = 1;
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A1:H1")->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$hr, "First Name")
									->setCellValue("B".$hr, "Last Name")
									->setCellValue("C".$hr, "Gender")
									->setCellValue("D".$hr, "School")
									->setCellValue("E".$hr, "Region")
									->setCellValue("F".$hr, "Email")
									->setCellValue("G".$hr, "Cellphone Number")
									->setCellValue("H".$hr, "Total Votes");
									
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
ob_end_clean();
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition:attachment; filename=PSITEvoteResult.xlsx");
header("Cache-Control: max-age=0");
$objWriter->save("php://output");
exit(0);