<?php if (!defined('BASEPATH')) die();
class Excel extends Main_Controller {

    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

	public function pdf($orderid, $lang2)
	{
		$label = $this->getLabel();
		$order = $this->getOrder($orderid);
    	$this->load->library('ex');
		//activate worksheet number 1
		//name the worksheet
		// Create new PHPExcel object
		$activeSheet = $this->ex->getActiveSheet();
		//$FontColor = new PHPExcel_Style_Color();
		
		$filename = 'test';
		// Set document properties
		
		$this->ex->getProperties()->setCreator('user_name')
									 ->setLastModifiedBy('user_name')
									 ->setTitle('KITTIVATE ORDER ID.'.$orderid)
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Media Plan for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Media Plan");
	 	$this->ex->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsanaupc');
		$activeSheet->setCellValue('A1' , $label->firstname);
		$activeSheet->setCellValue('B1' , $order->firstname);
		$activeSheet->setCellValue('C1' , $label->lastname);
		$activeSheet->setCellValue('D1' , $order->lastname);
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$this->ex->setActiveSheetIndex(0);

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

		
		exit;

		/*
		  <div class="panel-body">
				  	<p> 
				 		<b><?php echo $label_email; ?></b> <span class="ftxt_email"></span>
					</p>
				  	<p> 
				 		<b class="ftxt_salutation"></b> <span class="ftxt_firstname"></span> <b><?php echo $label_lastname; ?></b> <span class="ftxt_lastname"></span>
					</p>
					<p>
						<b><?php echo $label_address1; ?></b> <span class="ftxt_address1"></span> 
				    </p>
				    <p>
					    <b><?php echo $label_address2; ?></b> <span class="ftxt_address2"></span>
					    <b><?php echo $label_address3; ?></b> <span class="ftxt_address3"></span>
					    <b><?php echo $label_address4; ?></b> <span class="ftxt_address4"></span>
				    </p>
				    <p>
				    	<b><?php echo $label_city; ?></b> <span class="ftxt_city"></span>
				    	<b><?php echo $label_state; ?></b> <span class="ftxt_state"></span>
				    	<b><?php echo $label_zipcode; ?></b> <span class="ftxt_zipcode"></span>
				    	<b><?php echo $label_country; ?></b> <span class="ftxt_country"></span>
				    </p>
				    <p>
				    	<b><?php echo $label_mobile; ?></b> <span class="ftxt_mobile"></span>
				    	<b><?php echo $label_telephone; ?></b> <span class="ftxt_telephone"></span>
				    	<b><?php echo $label_fax; ?></b> <span class="ftxt_fax"></span>
				    	<b><?php echo $label_ext; ?></b> <span class="ftxt_fax_ext"></span>
				    </p>
				  </div>
				  
				  
		$activeSheet->setCellValue('A1' , 'WEBSITE AD AVAILABILITY STATUS');
		$activeSheet->setCellValue('A2' , $lang);
		$activeSheet->setCellValue('A3' , $lang2);
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$this->ex->setActiveSheetIndex(0);

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

		
		exit;
		*/
	}

	private function getOrder($id){
		$order = $this->db->where('is_active', 'Y')->where('is_delete', 'N')->where('id',$id)
                          ->get('kt_order')->row();
		return $order;
	}
	
	private function getLabel(){
		$this->lang->load('modal_user', $this->session['language']);
		$res->salutation = $this->lang->line("label_salutation");
		$res->firstname = $this->lang->line("label_firstname");
		$res->lastname = $this->lang->line("label_lastname");
		$res->address1 = $this->lang->line("label_address1");
		$res->address2 = $this->lang->line("label_address2");
		$res->address3 = $this->lang->line("label_address3");
		$res->address4 = $this->lang->line("label_address4");
		$res->city = $this->lang->line("label_city");
		$res->state = $this->lang->line("label_state");
		$res->country = $this->lang->line("label_country");
		$res->zipcode = $this->lang->line("label_zipcode");
		$res->mobile = $this->lang->line("label_mobile");
		$res->telephone = $this->lang->line("label_telephone");
		$res->ext = $this->lang->line("label_ext");
		$res->fax = $this->lang->line("label_fax");
		$res->email = $this->lang->line("label_email");
		
		return $res;
	}

	

}
