<?php if (!defined('BASEPATH')) die();
class Product extends Main_Controller {

    public function  __construct()
    {
        parent::__construct();
        $this->loadHeader();
    }

    public function index()
    {
		//var_dump($name);
    }
	
	public function get($keyword){
		if(!empty($keyword)){
			$data["keyword"] = $keyword;
		}

       $this->load->view('product',$data);
	   $this->load->view('include/modal_image');
	   $this->load->view('include/modal_confirm');
       $this->load->view('include/footer');
    }

	 private function getProduct($keyword){
			$where = "";
			$numberLimit = 9;
			
			if(!empty($keyword)){
	              $where .= " and ( lower(ifnull(kp.name_th,'')) like lower('%".$keyword."%')  ) ";
	              $where .= "or ( lower(ifnull(kp.name_en,'')) like lower('%".$keyword."%')  ) ";
	              $where .= "or ( lower(ifnull(kp.barcode,'')) like lower('%".$keyword."%')  ) ";
	              $where .= "or ( lower(ifnull(kp.description,'')) like lower('%".$keyword."%')  ) ";
			}

			$limit = "LIMIT $numberLimit";

			
			$SQL_COUNT = "select count(*) as count
					from kt_product as kp 
					left join kt_product_stock as kps on (kp.id = kps.pid) 
					where kp.is_active='Y' and kp.is_delete='N' {$where}";
			$count = $this->db->query($SQL_COUNT)->result();
			
			$count = $count[0]->count;
			
			$response->page[0] = ceil ( $count / $numberLimit );
			
			
			$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit_en, kdt.data_type_name as unit_th, kp.price, kps.pstock as stock, kp.weight, kp.image
					from kt_product as kp
					left join kt_define_data_type as kdt on (kp.unit = kdt.id)
					left join kt_product_stock as kps on (kp.id = kps.pid) 
					where kp.is_active='Y' and kp.is_delete='N' {$where} {$limit}";
			//var_dump($SQL);
	
	        //$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kp.unit, kp.price, kp.stock, kp.weight from kt_product as kp left join kt_product_stock as kps on (kp.id = kps.pid) where kps.pstock = 0";
	        $result = $this->db->query($SQL)->result();
	        $i=0;
	        foreach($result as $row){
	            $response->rows[$i]['pid'] = $row->pid;
	            $response->rows[$i]['barcode'] = $row->barcode;
	            if($this->session['language'] == 'english'){
	            	$response->rows[$i]['name'] = $row->name_en;
					$response->rows[$i]['unit'] = $row->unit_en;
				}else if($this->session['language'] == 'thailand'){
	            	$response->rows[$i]['name'] = $row->name_th;
	            	$response->rows[$i]['unit'] = $row->unit_th;
	            }
	            $response->rows[$i]['volumn'] = $row->volumn;
				$response->rows[$i]['image'] = $row->image;
	            $response->rows[$i]['price'] = $row->price;
	            $response->rows[$i]['stock'] = intval($row->stock);
	            $response->rows[$i]['weight'] = $row->weight;
	            $i++;
	        }
	
	        return json_encode($response);
	    }

}
