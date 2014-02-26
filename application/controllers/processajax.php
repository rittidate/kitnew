<?php if (!defined('BASEPATH')) die();
class Processajax extends Main_Controller {
    
    function __construct()
    {
        parent::__construct();
    }

   public function index()
   {


   }

    public function getAutoCity(){
        $keyword = $_REQUEST['keyword'];
        $country = $_REQUEST['country'];
        $state = $_REQUEST['state'];
        $where = '';
        if(!empty($keyword)){
                $where .= "and ( lower(ifnull(city.name,'')) like lower('%{$keyword}%')  ) ";
        }

        if(!empty($country)){
                $where .= "and country.name = '{$country}' ";
        }

        if(!empty($state)){
                $where .= " and state.id = (select id from kt_state WHERE name_th = '{$state}' or name_en = '{$state}')";
        }

        $SQL = " SELECT city.name as name FROM kt_city as city
        JOIN kt_state as state ON (state.id = city.state_id)
        JOIN kt_country as country ON (country.id = state.country_id)
        WHERE city.is_delete = 'N' and city.is_active = 'Y' {$where} ORDER BY city.name";

        $result = $this->db->query($SQL)->result();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['name']=$value->name;
            $i++;
        }

        echo json_encode($response);

    }

    public function saveUser(){
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $birth = $_REQUEST['birth'];
        $address1 = $_REQUEST['address1'];
        $address2 = $_REQUEST['address2'];
        $address3 = $_REQUEST['address3'];
        $address4 = $_REQUEST['address4'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $country = $_REQUEST['country'];
        $salutation = $_REQUEST['salutation'];
        $gender = $_REQUEST['gender'];
        $zipcode = $_REQUEST['zipcode'];
        $mobile = $_REQUEST['mobile'];
        $telephone = $_REQUEST['telephone'];
        $telephone_ext = $_REQUEST['telephone_ext'];
        $fax = $_REQUEST['fax'];
        $fax_ext = $_REQUEST['fax_ext'];

        $update = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'birth' => $birth,
                    'address1' => $address1,
                    'address2' => $address2,
                    'address3' => $address3,
                    'address4' => $address4,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'salutation' => $salutation,
                    'gender' => $gender,
                    'zipcode' => $zipcode,
                    'mobile' => $mobile,
                    'telephone' => $telephone,
                    'telephone_ext' => $telephone_ext,
                    'fax' => $fax,
                    'fax_ext' => $fax_ext
                );
       $this->db->update('kt_customer', $update, array('id' => $this->session['user']));

    }

    public function getAutoState(){
            $keyword = $_REQUEST['keyword'];
            $country = $_REQUEST['country'];
            $where = '';
            if(!empty($keyword)){
                    $where .= "and ( lower(ifnull(state.name_en,'')) like lower('%{$keyword}%')  ) ";
                    $where .= "or ( lower(ifnull(state.name_th,'')) like lower('%{$keyword}%')  ) ";
            }

            if(!empty($country)){
                    $where .= "and country.name = '{$country}' ";
            }

        $SQL = " SELECT COALESCE(state.name_th, state.name_en) as name FROM kt_state as state
        JOIN kt_country as country ON (country.id = state.country_id)
        WHERE state.is_delete = 'N' and state.is_active = 'Y' {$where} ORDER BY name";
        
        $result = $this->db->query($SQL)->result();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['name']=$value->name;
            $i++;
        }

        echo json_encode($response);
    }

    public function getAutoZipcode(){
        $city = $_REQUEST['city'];
        $country = $_REQUEST['country'];
        $state = $_REQUEST['state'];
        $where = '';

        if(!empty($country)){
            $where .= "and country.name = '{$country}' ";
        }

        if(!empty($state)){
            $where .= " and state.id = (select id from kt_state WHERE name_th = '{$state}' or name_en = '{$state}')";
        }

        if(!empty($city) && !empty($state)){
            $where .= "and city.name ='{$city}' ";
            $SQL = " SELECT city.zipcode as zipcode FROM kt_city as city
            JOIN kt_state as state ON (state.id = city.state_id)
            JOIN kt_country as country ON (country.id = state.country_id)
            WHERE city.is_delete = 'N' and city.is_active = 'Y' {$where} ORDER BY city.name";
            
            $result = $this->db->query($SQL)->result();
            foreach($result as $value){
                $response->zipcode['zipcode'] =$value->zipcode;
            }
        }
        
        echo json_encode($response);
    }

    //function product

    public function buildMenuStep2(){
        $id = $_REQUEST['id'];

        $SQL = "select name, name_th, id, parentid from kt_menu_product WHERE parentid='{$id}' and is_delete = 'N' and is_active = 'Y'
                and parentid in (select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y' and parentid is null) order by name";
        $result = $this->db->query($SQL)->result();
        $data = array();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['id']= $value->id;
	        if($this->session['language'] == 'english'){
	        	$response->rows[$i]['name']= $value->name;
	        }else if($this->session['language'] == 'thailand'){
            	$response->rows[$i]['name']= $value->name_th;
	        }
                
            
            $i++;
        }

        echo json_encode($response);
    }
    
    public function buildMenuStep3(){
        $id = $_REQUEST['id'];

        $SQL = "select name, name_th, id, parentid from kt_menu_product WHERE parentid='{$id}' and is_delete = 'N' and is_active = 'Y'
                and parentid in ( select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y'
                    and parentid in (select id from kt_menu_product  WHERE is_delete = 'N'  and is_active = 'Y' and parentid is null) )
                order by name";
        $result = $this->db->query($SQL)->result();
        $data = array();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['id']= $value->id;
	        if($this->session['language'] == 'english'){
	        	$response->rows[$i]['name']= $value->name;
	        }else if($this->session['language'] == 'thailand'){
            	$response->rows[$i]['name']= $value->name_th;
	        }
            $i++;
        }

        echo json_encode($response);
    }
	
    public function getProduct(){
        $step = !empty($_REQUEST['step']) ? trim($_REQUEST['step']) : '';
		$menuid = !empty($_REQUEST['menuid']) ? trim($_REQUEST['menuid']) : '';
		$page = $_REQUEST['page'];
		$keyword = !empty($_REQUEST['keyword']) ? trim($_REQUEST['keyword']) : '';
		$where = "";
		$numberLimit = 9;
		
		if(!empty($keyword)){
              $where .= " and ( lower(ifnull(kp.name_th,'')) like lower('%".$keyword."%')  ) ";
              $where .= "or ( lower(ifnull(kp.name_en,'')) like lower('%".$keyword."%')  ) ";
              $where .= "or ( lower(ifnull(kp.barcode,'')) like lower('%".$keyword."%')  ) ";
              $where .= "or ( lower(ifnull(kp.description,'')) like lower('%".$keyword."%')  ) ";

		}else{
			if(!empty($step) && !empty($menuid)){
				if($step == 1){
					$SQL = "select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y'
	                                and parentid in ( select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y'
	                                    and parentid = '{$menuid}')";
	    			$result = $this->db->query($SQL)->result();
					$pmenuid = array();
					foreach($result as $row){
						array_push($pmenuid, $row->id);
					}
					$pmenuid = implode(",", $pmenuid);
					$where .= " and pmenu_id in ($pmenuid)";
				}else if($step == 2){
					$SQL = "select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y'
	                                and parentid = '{$menuid}'";
	    			$result = $this->db->query($SQL)->result();
					$pmenuid = array();
					foreach($result as $row){
						array_push($pmenuid, $row->id);
					}
					$pmenuid = implode(",", $pmenuid);
					$where .= " and pmenu_id in ($pmenuid)";
				}else if($step == 3){
					$where .= " and pmenu_id = $menuid";
				}
				
	
			}
		}
		if(empty($step) && empty($menuid) && empty($keyword)){
			if(empty($page)){
				$limit = "LIMIT $numberLimit";
			}else{
				$start = ($page-1) * $numberLimit;
				$limit = "LIMIT $start, $numberLimit";
			}
			$SQL_COUNT = "select count(*) as count
			from kt_product as kp 
			left join kt_product_stock as kps on (kp.id = kps.pid) 
			left join kt_product_view as kpv on (kp.id = kpv.pid) 
			where kp.is_active='Y' and kp.is_delete='N' and kps.pstock > 0 {$where}";
			
			$count = $this->db->query($SQL_COUNT)->result();
			
			$count = $count[0]->count;
			$maxcount= $numberLimit * 4;
			if($count > $maxcount)
				$count = $maxcount;
			
		}else{
			if(empty($page)){
				$limit = "LIMIT $numberLimit";
			}else{
				$start = ($page-1) * $numberLimit;
				$limit = "LIMIT $start, $numberLimit";
			}
			$SQL_COUNT = "select count(*) as count
				from kt_product as kp 
				left join kt_product_stock as kps on (kp.id = kps.pid) 
				where kp.is_active='Y' and kp.is_delete='N' and kps.pstock > 0 {$where}";
			
			$count = $this->db->query($SQL_COUNT)->result();
			
			$count = $count[0]->count;
		}
		
		$response->page[0] = ceil ( $count / $numberLimit );
		
		if(empty($step) && empty($menuid) && empty($keyword)){
			$order = "order by kpv.view desc";
			$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit_en, kdt.description as unit_th, kp.price, kps.pstock as stock, kp.weight, kp.image
				from kt_product as kp
				left join kt_define_data_type as kdt on (kp.unit = kdt.id)
				left join kt_product_stock as kps on (kp.id = kps.pid) 
				left join kt_product_view as kpv on (kp.id = kpv.pid) 
				where kp.is_active='Y' and kp.is_delete='N' and kps.pstock > 0 {$where} {$order} {$limit}";
		}else{
			if($this->session['language'] == 'thailand'){
				$order = "order by kp.name_th desc";
			}else if($this->session['language'] == 'english'){
				$order = "order by kp.name_en desc";
			}
			
		$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit_en, kdt.description as unit_th, kp.price, kps.pstock as stock, kp.weight, kp.image
				from kt_product as kp
				left join kt_define_data_type as kdt on (kp.unit = kdt.id)
				left join kt_product_stock as kps on (kp.id = kps.pid) 
				where kp.is_active='Y' and kp.is_delete='N' and kps.pstock > 0 {$where} {$order} {$limit}";
		}
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

        echo json_encode($response);
    }
    
    public function saveSessionCart(){
		 $json = json_decode($_REQUEST['json']);
		 
		 $this->session['cart'] = $json;
		 
	      $update = array(
	            'sessiondata' => serialize($this->session),
	            'lastused' => date('Y-m-d H:i:s')
	       );
	       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE[$this->varviewer]));
    	
    	
    }

    public function getSessionCart(){
		 if(!empty($this->session['cart'])){
		 	$json = $this->session['cart'];
			 $i=0;
			 foreach ($json as $key => $value) {
			 	$where = "and kp.id = {$value->id}";
		 		$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit_en, kdt.description as unit_th, kp.price, kps.pstock as stock, kp.weight, kp.image
					from kt_product as kp
					left join kt_define_data_type as kdt on (kp.unit = kdt.id)
					left join kt_product_stock as kps on (kp.id = kps.pid) 
					where kp.is_active='Y' and kp.is_delete='N' and kps.pstock > 0 {$where} ";
					
			        $result = $this->db->query($SQL)->result();
			        
			        foreach($result as $row){
			            $response->rows[$i]['id'] = $row->pid;
			            $response->rows[$i]['barcode'] = $row->barcode;
			            if($this->session['language'] == 'english'){
			            	$response->rows[$i]['name'] = $row->name_en;
							$response->rows[$i]['unit'] = $row->unit_en;
						}else if($this->session['language'] == 'thailand'){
			            	$response->rows[$i]['name'] = $row->name_th;
			            	$response->rows[$i]['unit'] = $row->unit_th;
			            }
			            $response->rows[$i]['volumn'] = $row->volumn;
			            $response->rows[$i]['unit'] = $row->unit;
			            $response->rows[$i]['price'] = $row->price;
			            $response->rows[$i]['stock'] = intval($row->stock);
			            $response->rows[$i]['weight'] = $row->weight;
			            $response->rows[$i]['qty'] = $value->qty;
			            $response->rows[$i]['image'] = $row->image;
			            $i++;
			        }
			 }
		 }
		 
		 if(!empty($this->session['order']) && !empty($this->session['user'])){
		 	$where = array('customer_id' => $this->session['user'],
							'is_active' => 'Y',
							'is_delete' => 'N');
		 	$result = $this->db->where($where)->order_by('id', 'ASC')->get('kt_order')->result();
			$i = 0;
			$aOrder = array();
			foreach($result as $order){
				$response->orders[$i]['id'] = $order->id;
				array_push($aOrder, $order->id);
				$i++;
			}
			
			foreach ($this->session['order'] as $value) {
				if(!in_array($value, $aOrder)){
					$response->orders[$i]['id'] = $value;
					$i++;
				}
			}
		 }else if(empty($this->session['order']) && !empty($this->session['user'])){
		 	$where = array('customer_id' => $this->session['user'],
							'is_active' => 'Y',
							'is_delete' => 'N');
		 	$result = $this->db->where($where)->order_by('id', 'ASC')->get('kt_order')->result();
			$i = 0;
			$aOrder = array();
			foreach($result as $order){
				$response->orders[$i]['id'] = $order->id;
				array_push($aOrder, $order->id);
				$i++;
			}
		 }else if(!empty($this->session['order']) && empty($this->session['user'])){
			$i = 0;
			foreach ($this->session['order'] as $value) {
					$response->orders[$i]['id'] = $value;
					$i++;
			}
		 }

		if(!empty($response)){
			echo json_encode($response);
		 }else{
		 	echo json_encode('');
		 }


    }
    
    public function getRatePrice(){
    	$city = $_REQUEST["city"];
		$country = $_REQUEST["country"];
		$state = $_REQUEST["state"];
		$subtotal = $_REQUEST["subtotal"];
		$weight = $_REQUEST["weight"];
		$shipType =  FALSE;
		
		
		$includeWeight = $this->getIncludeWeight();
        $serviceCharge = $this->getServiceCharge();
		
		$SQL = "SELECT sht.data_type_id as shipmentid FROM kt_ship_company as shc
						JOIN kt_ship_type as sht ON (sht.ship_company_id = shc.id) WHERE shc.is_active = 'Y' and shc.is_delete = 'N' ORDER BY shc.id";
		$result = $this->db->query($SQL)->result();
		$i = 0;
		foreach($result as $row){
         	$shipment_id = $row->shipmentid;
			$SQL_ZONE = "SELECT shr.rate_price as shipprice, sht.ship_company_id as ship_company_id, shc.name AS ship_company_name, sht.data_type_id as ship_type_id, kddt.data_type_name as ship_type_name FROM kt_ship_rate as shr
		                    join kt_ship_type as sht on (sht.id = shr.ship_type_id and sht.ship_type_ref = 'AREA')
		                    join kt_define_data_type as kddt on (kddt.id = sht.data_type_id)
		                    join kt_ship_company as shc on (shc.id = sht.ship_company_id)
		                    WHERE sht.data_type_id = {$shipment_id} and shr.min < '{$subtotal}' and shr.max >= '{$subtotal}'
		                    and shr.zone = (
		                    SELECT ci.zone from kt_country as c
		                    join kt_state as s on (s.country_id = c.id)
		                    join kt_city as ci on (ci.state_id = s.id)
		                    WHERE c.name = '{$country}' and s.name_th = '{$state}' and ci.name = '{$city}') and shr.is_active = 'Y' and shr.is_delete = 'N'";
			$result_zone = $this->db->query($SQL_ZONE)->result();
			
			
			foreach ($result_zone as $row_zone){
				$response->shipprice[$i]['id'] = $row_zone->ship_company_id;
				$response->shipprice[$i]['shiptype_id'] = $row_zone->ship_type_id;
				$response->shipprice[$i]['shiptype_name'] = $row_zone->ship_type_name;
				$response->shipprice[$i]['name'] = $row_zone->ship_company_name;
				$response->shipprice[$i]['shipprice'] = $row_zone->shipprice;
				$i++;
				if($country == 'Thailand'){
					$shipType =  TRUE;
				}
			}
			
			//WEIGHT
            $maxWeightPrice = $this->getMaxWeightPrice($shipment_id);
			if(!empty($maxWeightPrice->maxweight) and !empty($maxWeightPrice->maxprice)){
	            $maxWeight = !empty($maxWeightPrice->maxweight) ? $maxWeightPrice->maxweight : '';
	            $maxPrice = !empty($maxWeightPrice->maxprice) ? $maxWeightPrice->maxprice : '';
	            $weigth_new = $weight + ($weight*$includeWeight);
	            $weight_over = floor($weigth_new/$maxWeight);
	            $shipprice = $weight_over*$maxPrice;
	            $queryWeight =  $weigth_new % $maxWeight;
				
				$SQL_WEIGHT = "SELECT shr.rate_price as shipprice, sht.ship_company_id as ship_company_id, shc.name AS ship_company_name, sht.data_type_id as ship_type_id, kddt.data_type_name as ship_type_name FROM kt_ship_rate as shr
		                    join kt_ship_type as sht on (sht.id = shr.ship_type_id and sht.ship_type_ref = 'WEIGHT')
		                    join kt_define_data_type as kddt on (kddt.id = sht.data_type_id)
		                    join kt_ship_company as shc on (shc.id = sht.ship_company_id)
		                    WHERE sht.data_type_id = {$shipment_id} and shr.min < '{$queryWeight}' and shr.max >= '{$queryWeight}' and shr.is_active = 'Y' and shr.is_delete = 'N'"; 

				$result_weight = $this->db->query($SQL_WEIGHT)->result();
				foreach ($result_weight as $row_weight){
					$response->shipprice[$i]['id'] = $row_weight->ship_company_id;
					$response->shipprice[$i]['shiptype_id'] = $row_weight->ship_type_id;
					$response->shipprice[$i]['shiptype_name'] = $row_weight->ship_type_name;
					$response->shipprice[$i]['name'] = $row_weight->ship_company_name;
					$response->shipprice[$i]['shipprice'] = $row_weight->shipprice + $shipprice + $serviceCharge;
					$i++;
				}
				
			}
		}

		if(!empty($response)){
			$response = (object) array_merge((array)$response, (array)$this->getPaymentTerm($shipType));
        	echo json_encode($response);
        }else{
        	echo json_encode('');
        }

    }
    
    private function getPaymentTerm($shipType = False){
    	$where = '';
    	if(!$shipType){
    		$where = " and data_type_name <> 'เงินสด'";
    	}
    	
        $SQL = "SELECT id, data_type_name, description FROM kt_define_data_type
        		WHERE is_delete = 'N' and is_active = 'Y' and ref_data_type = 'PAYMENT_TYPE' $where ORDER BY id ";

		$result = $this->db->query($SQL)->result();
		$i=0;
        foreach($result as $row) {
            $response->payment[$i]['id']=$row->id;
            $response->payment[$i]['name']=$row->data_type_name;
			$response->payment[$i]['description']=$row->description;
			$i++;
		}
        return $response;
    }

     private function getMaxWeightPrice($shipid){
         if(!empty($shipid)){
            $SQL = "SELECT max(shr.max) as maxweight, max(shr.rate_price) as maxprice  FROM kt_ship_rate as shr
                    join kt_ship_type as sht on (sht.id = shr.ship_type_id and sht.ship_type_ref = 'WEIGHT')
                    WHERE sht.data_type_id = {$shipid} and shr.is_active = 'Y' and shr.is_delete = 'N'";

			$result = $this->db->query($SQL)->result();
		    return $result[0];
         }
     }

    public function shipAddressSession(){
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $birth = $_REQUEST['birth'];
        $address1 = $_REQUEST['address1'];
        $address2 = $_REQUEST['address2'];
        $address3 = $_REQUEST['address3'];
        $address4 = $_REQUEST['address4'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $country = $_REQUEST['country'];
        $salutation = $_REQUEST['salutation'];
        $gender = $_REQUEST['gender'];
        $zipcode = $_REQUEST['zipcode'];
        $mobile = $_REQUEST['mobile'];
        $telephone = $_REQUEST['telephone'];
        $telephone_ext = $_REQUEST['telephone_ext'];
        $fax = $_REQUEST['fax'];
        $fax_ext = $_REQUEST['fax_ext'];
        $email = $_REQUEST['email'];
		
        $this->session['ship'] = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birth' => $birth,
            'address1' => $address1,
            'address2' => $address2,
            'address3' => $address3,
            'address4' => $address4,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'salutation' => $salutation,
            'gender' => $gender,
            'zipcode' => $zipcode,
            'mobile' => $mobile,
            'telephone' => $telephone,
            'telephone_ext' => $telephone_ext,
            'fax' => $fax,
            'fax_ext' => $fax_ext,
            'email' => $email
        );
       $update = array(
            'ocid' => $this->viewerId,
            'sessiondata' => serialize($this->session),
            'lastused' => date('Y-m-d H:i:s')
       );
       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE[$this->varviewer]));
	   echo json_encode('success');
    	
    }

	public function saveOrder(){
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        //$birth = $_REQUEST['birth'];
        $address1 = $_REQUEST['address1'];
        $address2 = $_REQUEST['address2'];
        $address3 = $_REQUEST['address3'];
        $address4 = $_REQUEST['address4'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $country = $_REQUEST['country'];
        //$salutation = $_REQUEST['salutation'];
        //$gender = $_REQUEST['gender'];
        $zipcode = $_REQUEST['zipcode'];
        $mobile = $_REQUEST['mobile'];
        $telephone = $_REQUEST['telephone'];
        $telephone_ext = $_REQUEST['telephone_ext'];
        $fax = $_REQUEST['fax'];
        $fax_ext = $_REQUEST['fax_ext'];
        $email = $_REQUEST['email'];
		
		$payment_id = $_REQUEST['payment_id'];
		$shipment_id = $_REQUEST['shipment_id'];
		
		$subtotal = $_REQUEST['subtotal'];
		$shipprice = $_REQUEST['shipprice'];
		$grandtotal = $_REQUEST['grandtotal'];
		
		$json = json_decode($_REQUEST['json']);
		
		$aDetail = array(
						'firstname' =>$firstname,
						'lastname' =>$lastname,
						'address1' =>$address1,
						'address2' =>$address2,
						'address3' =>$address3,
						'address4' =>$address4,
						'city' => $city,
						'state' => $state,
						'country' => $country,
						'zipcode' => $zipcode,
						'mobile' =>$mobile,
						'telephone' =>$telephone,
						'telephone_ext' =>$telephone_ext,
						'fax' =>$fax,
						'fax_ext' =>$fax_ext,
						'email' =>$email,
						'payment_id' =>$payment_id,
						'shipment_id' =>$shipment_id,
						'subtotal' =>$subtotal,
						'shipprice' =>$shipprice,
						'grandtotal' =>$grandtotal,
						);
		
		$cid = !empty($this->session['user']) ? $this->session['user'] : 0;
		
      	$insert_order = array(
      		'order_date' => date('Y-m-d H:i:s'),
      		'subtotal' => $subtotal,
      		'shipprice' => $shipprice,
      		'grandtotal' => $grandtotal,
      		'customer_id' => $cid,
            'firstname' => $firstname,
            'lastname' => $lastname,
            //'birth' => $birth,
            'address1' => $address1,
            'address2' => $address2,
            'address3' => $address3,
            'address4' => $address4,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            //'salutation' => $salutation,
            //'gender' => $gender,
            'zipcode' => $zipcode,
            'mobile' => $mobile,
            'telephone' => $telephone,
            'telephone_ext' => $telephone_ext,
            'fax' => $fax,
            'fax_ext' => $fax_ext,
            'email' => $email,
            'shipment_id' => $shipment_id,
            'payment_id' => $payment_id,
            'order_status' => 10,
            'is_active' => 'Y',
            'is_delete' => 'N',
            'create_date' => date('Y-m-d H:i:s'),
            'create_by_id' => $cid
       	);
       	$this->db->insert('kt_order', $insert_order);
		$order_id = $this->db->insert_id();
		
		foreach($json as $value){
			$product = $this->db->query("select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unittype, kp.unit as unit,  kp.price, kp.weight, kp.image
				from kt_product as kp
				left join kt_define_data_type as kdt on (kp.unit = kdt.id)
				WHERE kp.id = {$value->id}")->row();
			$sumweight = $value->weight * $value->qty;
			
			$insert_orderDetail = array(
				'order_id' => $order_id,
				'pid' => $value->id,
				'name_en' => $product->name_en,
				'name_th' => $product->name_th,
				'volumn' => $product->volumn,
				'unit' => $product->unit,
				'price' => $value->price,
				'qty' => $value->qty,
				'sumtotal' => $value->total,
				'weight' => $value->weight,
				'sumweight' => $sumweight,
            	'is_active' => 'Y',
            	'is_delete' => 'N'
			);
			$this->db->insert('kt_orderdetail', $insert_orderDetail);
		}

		$message = $this->orderEmailMessage($order_id, $aDetail, $json);
		$this->sendEmailOrder($email, $order_id, $message);
		
		if($email !== "arraieot@gmail.com"){
			//send mail to me
			$this->sendEmailOrder("arraieot@gmail.com", $order_id, $message);
		}
		
		unset($this->session['cart']);
		
		if(empty($this->session['order'])){
			$this->session['order'] = array($order_id);
		}else{
			array_push($this->session['order'], $order_id);
		}
		
       $update = array(
            'ocid' => $this->viewerId,
            'sessiondata' => serialize($this->session),
            'lastused' => date('Y-m-d H:i:s')
       );
       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE[$this->varviewer]));
		
		$response->order[0]['id'] = $order_id;
		echo json_encode($response);
		
	}

	public function sendEmailOrder($email = '', $orderid = '', $message = ''){
		$this->lang->load('email', $this->session['language']);
		$email_header = $this->lang->line("email_header");
		$this->load->library('email');
		$this->email->from('arraieot@gmail.com');
		$this->email->to($email);
		$this->email->subject($email_header.$orderid);
		$this->email->message($message);
		$this->email->send();
	}
	
	private function orderEmailMessage($orderid = '', $aDetail = array(), $json = array()){
        $this->lang->load('modal_user', $this->session['language']);
		$label_address1 = $this->lang->line("label_address1");
		$label_address2 = $this->lang->line("label_address2");
		$label_address3 = $this->lang->line("label_address3");
		$label_address4 = $this->lang->line("label_address4");
		$label_city = $this->lang->line("label_city");
		$label_state = $this->lang->line("label_state");
		$label_country = $this->lang->line("label_country");
		$label_zipcode = $this->lang->line("label_zipcode");
		$label_mobile = $this->lang->line("label_mobile");
		$label_telephone = $this->lang->line("label_telephone");
		$label_ext = $this->lang->line("label_ext");
		$label_fax = $this->lang->line("label_fax");
		$label_email = $this->lang->line("label_email");
		
        $this->lang->load('product', $this->session['language']);

        $plabel_barcode = $this->lang->line("plabel_barcode");
		$plabel_product = $this->lang->line("plabel_product");
        $plabel_price = $this->lang->line("plabel_price");
        $plabel_baht = $this->lang->line("plabel_baht");
        $plabel_qty = $this->lang->line("plabel_qty");
		$plabel_total = $this->lang->line("plabel_total");
		$plabel_subtotal = $this->lang->line("plabel_subtotal");
		$plabel_shipprice = $this->lang->line("plabel_shipprice");
		$plabel_grandtotal = $this->lang->line("plabel_grandtotal");
		$plabel_image = $this->lang->line("plabel_image");
		
		$this->lang->load('email', $this->session['language']);
		$email_header = $this->lang->line("email_header");
		$email_document = $this->lang->line("email_document");
		$email_payment_tell = $this->lang->line("email_payment_tell");
		$email_end = $this->lang->line("email_end");
		
		$message = '';
		
		$message .= "<style type='text/css'>";
		$message .= ".Table { background-color:#FFFFE0;border-collapse:collapse;color:#000;font-size:18px; }";
		$message .= ".Table th { background-color:#BDB76B;color:white; }";
		$message .= ".Table td, .myOtherTable th { padding:5px;border:0; }";
		$message .= ".Table td { border-bottom:1px dotted #BDB76B; }";
		$message .= "</style>";

		$message .= "<table><tbody>";
		$message .= "<tr><td>";
		$message .= $email_header.$orderid."<br><br>";
		$message .= $aDetail['firstname']." ".$aDetail['lastname']."<br>";
				
		$message .= $label_address1." ".$aDetail['address1']."<br>";
		$message .= $label_address2." ".$aDetail['address2']." ".$label_address3." ".$aDetail['address3']." ".$label_address4." ".$aDetail['address4']."<br>";
		$message .= $label_city." ".$aDetail['city']." ".$label_state." ".$aDetail['state']." ".$label_zipcode." ".$aDetail['zipcode']." ".$label_country." ".$aDetail['country']."<br>";
		$message .= $label_mobile." ".$aDetail['mobile']." ".$label_telephone." ".$aDetail['telephone']." ".$label_ext." ".$aDetail['telephone_ext']." ".$label_fax." ".$aDetail['fax']." ".$label_ext." ".$aDetail['fax_ext'];
		$message .= "</td></tr>";
		$message .= "</tbody></table>";
		$message .= "<br><br>";
		$message .= "<table class='Table'><thead><tr>";
		$message .= "<th>".$plabel_image."</th>";    
		$message .= "<th>".$plabel_barcode."</th>";  
		$message .= "<th>".$plabel_product."</th>";  
		$message .= "<th>".$plabel_price."</th>";  
		$message .= "<th style='width:20px;'>".$plabel_qty."</th>";
		$message .= "<th align='right'>".$plabel_total."</th>";                          
		$message .= "</tr></thead><tbody>"; 
		
		foreach($json as $value){
			$product = $this->db->query("select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unittype, kp.unit as unit,  kp.price, kp.weight, kp.image
				from kt_product as kp
				left join kt_define_data_type as kdt on (kp.unit = kdt.id)
				WHERE kp.id = {$value->id}")->row();
			
			if($this->session['language'] == 'english'){
				$productName = $product->name_en." ".$product->volumn." ".$product->unittype;
			}else{
				$productName = $product->name_th." ".$product->volumn." ".$product->unittype;
			}
    		if($product->image == ''){
    			$image = base_url('pimage/').'no_image.jpg';
    		}else{
    			$image = base_url('pimage/').'large/'.$product->image;
    		}
			
			$message .= "<tr>";
			$message .= "<td><img alt='".$productName."' style='width: 60px; height: 40px;' src='".$image."'></td>";
			$message .= "<td>".$product->barcode."</th>";  
			$message .= "<td>".$productName."</th>";  
			$message .= "<td align='center'>".$value->price."</td>";  
			$message .= "<td align='center' style='width:20px;'>".$value->qty."</td>";  
			$message .= "<td align='right'>".$value->total." ".$plabel_baht."</td>";   
			$message .= "</tr>";     
		}

		$message .= "<tr>";
		$message .= "<td colspan='4' align='right'>".$plabel_subtotal."</td>";
		$message .= "<td colspan='2' align='right'>".$aDetail['subtotal']." ".$plabel_baht."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td colspan='4' align='right'>".$plabel_shipprice."</td>";
		$message .= "<td colspan='2' align='right'>".$aDetail['shipprice']." ".$plabel_baht."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td colspan='4' align='right'>".$plabel_grandtotal."</td>";
		$message .= "<td colspan='2' align='right'>".$aDetail['grandtotal']." ".$plabel_baht."</td>";
		$message .= "</tr>";
		$message .= "</tbody></table>";
		$message .= "<br><br>";
		$message .= "<a href='".base_url()."excel/pdf/".$orderid."/".$aDetail['email']."'>".$email_document."</a>";
		$message .= "<br><br>";
		
		$payment = $this->db->query("SELECT * FROM kt_define_data_type WHERE id = '{$aDetail['payment_id']}'")->row();
		$message .= $payment->description."<br><br>";
		$message .= $email_payment_tell;
		$message .= "<br><br>";
		$message .= $email_end;
		
		return $message;
	}
	
	public function countProduct(){
		$id = $_REQUEST['id'];
		$SQL = "INSERT INTO kt_product_view (pid,view) VALUES ({$id}, 1) ON DUPLICATE KEY UPDATE view=view+1";
		$result = $this->db->query($SQL);
	}
	
	public function savePayment(){
		$payment_date = $_REQUEST['payment_date'];
		$payment_hour = $_REQUEST['payment_hour'];
		$payment_minute = $_REQUEST['payment_minute'];
		$payment_order = $_REQUEST['payment_order'];
		$payment_select = $_REQUEST['payment_select'];
                $payment_grandtotal = $_REQUEST['payment_grandtotal'];

                list($d, $m, $y) = explode('/', $payment_date);
                $mk=mktime($payment_hour, $payment_minute, 0, $m, $d, $y);
                $payment_date=strftime('%Y-%m-%d %H:%M:%S',$mk);

                $count = $this->db->select('*')->from('kt_payment')->where('payment_date', $payment_date)->where('order_id', $payment_order)->where('grandtotal', $payment_grandtotal)->count_all_results();

                if($count == 0){
                    $SQL = "INSERT INTO kt_payment (order_id, payment_date, payment_id, grandtotal) VALUES ('{$payment_order}', '{$payment_date}', '{$payment_select}', '{$payment_grandtotal}')";
                    $result = $this->db->query($SQL);
                    $message = $this->paymentEmailMessage($payment_order, $payment_date, $payment_select, $payment_grandtotal);
                    //$this->sendEmailPayment($payment_order, $message);
                    $response->status = 'success';
                }else{
                    $response->status = 'error';
                }
                echo json_encode($response);
	}

        private function paymentEmailMessage($orderid = '', $date = '', $payment = '', $total = ''){
		$this->lang->load('email', $this->session['language']);
		$email_end = $this->lang->line("email_end");

                $this->lang->load('modal_payment', $this->session['language']);
		$email_header = $this->lang->line("payment_email_header");
                $payment_order_number = $this->lang->line("payment_order_number");
                $payment_select = $this->lang->line("payment_select");
                $payment_date = $this->lang->line("payment_date");
                $payment_grandtotal = $this->lang->line("payment_grandtotal");

		$message = '';

		$message .= $email_header.$orderid."<br><br>";
		$message .= "<br><br>";
                $message .= "<table><tbody>";
		$message .= "<tr><td>";
                $message .= $payment_order_number;
                $message .= "</td><td>";
                $message .= $orderid;
                $message .= "</td></tr>";
		$message .= "<tr><td>";
                $message .= $payment_select;
                $message .= "</td><td>";
                $payment = $this->db->where('id', $payment )->get('kt_define_data_type')->row();
                $message .= $payment->description;
                $message .= "</td></tr>";
                $message .= "<tr><td>";
                $message .= $payment_date;
                $message .= "</td><td>";
                $message .= $date;
                $message .= "</td></tr>";
                $message .= "<tr><td>";
                $message .= $payment_grandtotal;
                $message .= "</td><td>";
                $message .= $total;
                $message .= "</td></tr>";
                $message .= "</tbody></table>";
                $message .= "<br><br>";
		$message .= $email_end;

		return $message;
	}
	
	public function sendEmailPayment($orderid = '', $message = ''){
                $order = $this->db->where('id', $orderid )->get('kt_order')->row();
                if(!empty($order)){
                    $this->lang->load('modal_payment', $this->session['language']);
                    $email_header = $this->lang->line("payment_email_header");
                    $this->load->library('email');
                    $this->email->from('arraieot@gmail.com');
                    $this->email->to($order->email);
                    $this->email->cc('arraieot@gmail.com');
                    $this->email->subject($email_header.$orderid);
                    $this->email->message($message);
                    $this->email->send();
                }
	}
    
}
