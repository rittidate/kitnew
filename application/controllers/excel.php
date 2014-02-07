<?php if (!defined('BASEPATH')) die();
class Excel extends Main_Controller {

    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

	public function pdf($lang, $lang2)
	{
    	$this->load->library('ex');
		//activate worksheet number 1
		//name the worksheet
		// Create new PHPExcel object
		$activeSheet = $this->ex->getActiveSheet();
		//$FontColor = new PHPExcel_Style_Color();
		
		$type = 'pdf';
		$filename = 'test';
		// Set document properties
		$this->ex->getProperties()->setCreator('user_name')
									 ->setLastModifiedBy('user_name')
									 ->setTitle('media_plan_name')
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Media Plan for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Media Plan");
		
		$activeSheet->setCellValue('A1' , 'WEBSITE AD AVAILABILITY STATUS');
		$activeSheet->setCellValue('A2' , $lang);
		$activeSheet->setCellValue('A3' , $lang2);
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$this->ex->setActiveSheetIndex(0);
		if($type=='excel'){
		    // Redirect output to a client’s web browser (Excel2007)
		    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		    header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		    header('Cache-Control: max-age=0');
		    $objWriter = PHPExcel_IOFactory::createWriter($this->ex, 'Excel2007');
		    $objWriter->save('php://output');
		}elseif($type=='pdf'){
		    $activeSheet->setShowGridLines(FALSE);
		    $activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		    $activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		    $activeSheet->getPageMargins()->setTop(.2);
		    $activeSheet->getPageMargins()->setBottom(.1);
		    $activeSheet->getPageMargins()->setLeft(0.3);
		    header('Content-Type: application/pdf');
		    header('Content-Disposition: inline;filename="'.$filename.'.pdf"');
		    //header('Content-Disposition: attachment;filename="'.$client.'-'.$brand.'.pdf"');
		    header('Cache-Control: max-age=0');
		    $objWriter = PHPExcel_IOFactory::createWriter($this->ex, 'PDF');
		    $objWriter->save('php://output');
		}elseif($type=='save'){
		//    $haveRow = $mdb2->isHaveRow("SELECT * FROM query_report where create_by_id = '$user_ids' and checksum = '$aCellMd5'");
		
		//    if(!$haveRow){
		//    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//    $objWriter->save('../var/export/'.$filename.'.xls');
		//    $mdb2->query("INSERT INTO query_report (query_type, query_data, path_file, checksum, create_date, create_by_id, create_ip)
		//                VALUES ('WEBSITE_AD_STATUS', '$aCellSerialize', '{$filename}.xls', '$aCellMd5', now(), '$user_ids', '$user_ip')");
		//    }
		}
		
		
		exit;
	}

	

}
