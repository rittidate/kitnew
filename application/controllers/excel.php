<?php if (!defined('BASEPATH')) die();
class Excel extends Main_Controller {

    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

	public function pdf($orderid = '', $email = '')
	{
		$label = $this->getLabel();
		$style = $this->getArrayStyle();
		$order = $this->getOrder($orderid);
    	$this->load->library('ex');
		//activate worksheet number 1
		//name the worksheet
		// Create new PHPExcel object
		$activeSheet = $this->ex->getActiveSheet();

		$filename = 'Order_reciept_No'.$orderid;
		// Set document properties
		
		$this->ex->getProperties()->setCreator('user_name')
									 ->setLastModifiedBy('user_name')
									 ->setTitle('KITTIVATE ORDER ID.'.$orderid)
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Media Plan for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Media Plan");
	 	$this->ex->getActiveSheet()->getDefaultStyle()->getFont()->setName('angsanaupc');
		$activeSheet->getColumnDimension('A')->setWidth(3);
		
		$this->setStyle($activeSheet,array('B1','D1'), $label->order_head.$orderid, $style->aStyleHead);
		$this->setStyle($activeSheet,array('J1','K1'), $label->order_date, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('L1','M1'), $order->order_date, $style->aStyleDetail);
		
		$this->setStyle($activeSheet,array('B3','C3'), $label->firstname, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('D3','E3'), $order->firstname, $style->aStyleDetail);
		$this->setStyle($activeSheet,array('F3','G3'), $label->lastname, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('H3','I3'), $order->lastname, $style->aStyleDetail);
		
		$this->setStyle($activeSheet,array('I4','J4'), $label->address1, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('K4','M4'), $order->address1, $style->aStyleDetail);
		
		$this->setStyle($activeSheet,array('B5','C5'), $label->address2, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('D5','E5'), $order->address2, $style->aStyleDetail);
		$this->setStyle($activeSheet,array('F5','G5'), $label->address3, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('H5','I5'), $order->address3, $style->aStyleDetail);
		$this->setStyle($activeSheet,array('J5','K5'), $label->address4, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('L5','M5'), $order->address4, $style->aStyleDetail);
		
		$this->setStyle($activeSheet,array('B6','C6'), $label->city, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('D6','E6'), $order->city, $style->aStyleDetail);
		$this->setStyle($activeSheet,array('F6','G6'), $label->state, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('H6','I6'), $order->state, $style->aStyleDetail);
		$this->setStyle($activeSheet,array('J6','K6'), $label->zipcode, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('L6','M6'), $order->zipcode, $style->aStyleDetail);
		
		$this->setStyle($activeSheet,array('B7','C7'), $label->country, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('D7','E7'), $order->country, $style->aStyleDetail);
		$this->setStyle($activeSheet,array('J7','K7'), $label->order_ship, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('L7','M7'), $order->shiptype, $style->aStyleDetail);
		
		$this->setStyle($activeSheet,array('H8','I8'), $label->order_pay, $style->aStyleDetailLabel);
		$this->setStyle($activeSheet,array('J8','M8'), $order->paytype, $style->aStyleDetail);
		
		$activeSheet->getStyle('A2:N8')->getBorders()->getOutline()->setBorderStyle( PHPExcel_Style_Border::BORDER_THIN);
		
		$startDetail = $startRow = 10;
		$this->setStyle($activeSheet,'A'.$startDetail, 'No', $style->aOrderDetailLabelCenter);
		$this->setStyle($activeSheet,array('B'.$startDetail, 'C'.$startDetail), $label->barcode, $style->aOrderDetailLabelCenter);
		$this->setStyle($activeSheet,array('D'.$startDetail, 'I'.$startDetail), $label->product, $style->aOrderDetailLabelCenter);
		$this->setStyle($activeSheet,array('J'.$startDetail, 'K'.$startDetail), $label->price, $style->aOrderDetailLabelCenter);
		$this->setStyle($activeSheet,'L'.$startDetail, $label->qty, $style->aOrderDetailLabelCenter);
		$this->setStyle($activeSheet,array('M'.$startDetail, 'N'.$startDetail), $label->total."(".$label->baht.")", $style->aOrderDetailLabelCenter);
		
		$result = $this->db->where('order_id', $orderid)->get('kt_orderdetail')->result();
		
		$i=1;
        foreach($result as $row) {
        	$startDetail++;
			$product = $this->db->query("select kp.barcode, kdt.data_type_name as unit_en, kdt.description as unit_th
				from kt_product as kp
				left join kt_define_data_type as kdt on (kp.unit = kdt.id)
				WHERE kp.id = {$row->pid}")->row();
				
			if($this->session['language'] == 'thailand'){
				$productName = $row->name_th." ".$row->volumn." ".$product->unit_th;
			}else{
				$productName = $row->name_en." ".$row->volumn." ".$product->unit_en;
			}
			$this->setStyle($activeSheet,'A'.$startDetail, $i, $style->aOrderDetailCenter);
			$this->setStyle($activeSheet,array('B'.$startDetail, 'C'.$startDetail), " ".$product->barcode, $style->aOrderDetail);
			$this->setStyle($activeSheet,array('D'.$startDetail, 'I'.$startDetail), " ".$productName, $style->aOrderDetail);
			$this->setStyle($activeSheet,array('J'.$startDetail, 'K'.$startDetail), $row->price, $style->aOrderDetailCenter, 'number');
			$this->setStyle($activeSheet,'L'.$startDetail, $row->qty, $style->aOrderDetailCenter, 'number');
			$this->setStyle($activeSheet,array('M'.$startDetail, 'N'.$startDetail), $row->sumtotal, $style->aOrderDetailCenter, 'number');
			//$startDetail++;
			$i++;
		}
		
		$activeSheet->getStyle('A'.$startRow.':N'.$startDetail)->getBorders()->getOutline()->setBorderStyle( PHPExcel_Style_Border::BORDER_THIN);
		$endDetail = $startDetail+1;
		$this->setStyle($activeSheet,array('A'.$endDetail, 'L'.$endDetail), $label->subtotal, $style->aOrderDetailLabelRight);
		$this->setStyle($activeSheet,array('M'.$endDetail, 'N'.$endDetail), $order->subtotal, $style->aOrderDetailCenterBottom, 'number');
		$endDetail++;
		
		$this->setStyle($activeSheet,array('A'.$endDetail, 'L'.$endDetail), $label->shipprice, $style->aOrderDetailLabelRight);
		$this->setStyle($activeSheet,array('M'.$endDetail, 'N'.$endDetail), $order->shipprice, $style->aOrderDetailCenterBottom, 'number');
		$endDetail++;
				
		$this->setStyle($activeSheet,array('A'.$endDetail, 'L'.$endDetail), $label->grandtotal, $style->aOrderDetailLabelRight);
		$this->setStyle($activeSheet,array('M'.$endDetail, 'N'.$endDetail), $order->grandtotal, $style->aOrderDetailCenterBottom, 'number');
		$activeSheet->getStyle('A'.$startRow.':N'.$endDetail)->getBorders()->getOutline()->setBorderStyle( PHPExcel_Style_Border::BORDER_THIN);
		
		$endCredit = $endDetail + 3;
		
		$this->setStyle($activeSheet,array('A'.$endCredit, 'F'.$endCredit), $label->order_end, $style->aStyleDetailLabelLeft);
		$this->setStyle($activeSheet,array('I'.$endCredit, 'N'.$endCredit), $label->order_payment_tell, $style->aStyleDetailLabel);
		
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

	}

	private function setStyle($activeSheet, $col = array(), $text, $aStyle = array(), $type = ''){
			
		if(empty($type)){
			if(!empty($col) && is_array($col)){
				$activeSheet->mergeCells($col[0].':'.$col[1] );
				$activeSheet->setCellValue($col[0] , $text);
				$activeSheet->getStyle($col[0])->applyFromArray($aStyle);
			}else if(!empty($col) && !is_array($col)){
				$activeSheet->setCellValue($col , $text);
				$activeSheet->getStyle($col)->applyFromArray($aStyle);
			}
		}else if($type == 'number'){
			if(!empty($col) && is_array($col)){
				$activeSheet->mergeCells($col[0].':'.$col[1] );
				$activeSheet->setCellValue($col[0] , number_format($text, 0));
				$activeSheet->getStyle($col[0])->applyFromArray($aStyle);
			}else if(!empty($col) && !is_array($col)){
				$activeSheet->setCellValue($col , number_format($text, 0));
				$activeSheet->getStyle($col)->applyFromArray($aStyle);
			}
		}
		
	}
	
	private function getArrayStyle(){
		$this->load->library('ex');
		$res->aStyleHead = array(
                        'font'    => array(
								'bold'      => true,
                                'size'      => 20
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
            )
		);
		
		$res->aStyleDetailLabel = array(
                        'font'    => array(
								'bold'      => true,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
            )
		);
		
		$res->aStyleDetailLabelLeft = array(
                        'font'    => array(
								'bold'      => true,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
            )
		);
		
		$res->aStyleDetail = array(
                        'font'    => array(
								'bold'      => false,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
            )
		);
		
		$res->aOrderDetail = array(
                        'font'    => array(
								'bold'      => false,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
            )
		);
		
		$res->aOrderDetailCenter = array(
                        'font'    => array(
								'bold'      => false,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
            )
		);
		
		$res->aOrderDetailRight = array(
                        'font'    => array(
								'bold'      => false,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
            )
		);
		
		$res->aOrderDetailLabelCenter = array(
                        'font'    => array(
								'bold'      => true,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
            )
		);
		
		$res->aOrderDetailLabelRight = array(
                        'font'    => array(
								'bold'      => true,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
            )
		);
		
		$res->aOrderDetailCenterBottom = array(
                        'font'    => array(
								'bold'      => true,
                                'size'      => 14
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM
			),
            'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE,),
            )
		);
		return $res;
	} 

	private function getOrder($id){
		$SQL = "select ord.*, sddt.data_type_name as shiptype, pddt.description as paytype from kt_order as ord 
				left join kt_define_data_type as sddt on ord.shipment_id = sddt.id and sddt.ref_data_type = 'SHIPMENT_TYPE'
				left join kt_define_data_type as pddt on ord.payment_id = pddt.id and pddt.ref_data_type = 'PAYMENT_TYPE'
				WHERE ord.is_active = 'Y' and ord.is_delete = 'N' and ord.id={$id}";
		$order = $this->db->query($SQL)->row();
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
		
        $this->lang->load('product', $this->session['language']);
        $res->barcode = $this->lang->line("plabel_barcode");
		$res->product = $this->lang->line("plabel_product");
        $res->price = $this->lang->line("plabel_price");
        $res->baht = $this->lang->line("plabel_baht");
        $res->qty = $this->lang->line("plabel_qty");
		$res->total = $this->lang->line("plabel_total");
		$res->subtotal = $this->lang->line("plabel_subtotal");
		$res->shipprice = $this->lang->line("plabel_shipprice");
		$res->grandtotal = $this->lang->line("plabel_grandtotal");
		$res->image = $this->lang->line("plabel_image");
		
		$this->lang->load('order', $this->session['language']);
		$res->order_head = $this->lang->line("order_head");
		$res->order_date = $this->lang->line("order_date");
		$res->order_ship = $this->lang->line("order_ship");
		$res->order_pay = $this->lang->line("order_pay");
		$res->order_payment_tell = $this->lang->line("order_payment_tell");
		$res->order_end = $this->lang->line("order_end");
		
		return $res;
	}

	

}
