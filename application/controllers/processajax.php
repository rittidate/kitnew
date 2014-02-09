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

        $SQL = "select name, id, parentid from kt_menu_product WHERE parentid='{$id}' and is_delete = 'N' and is_active = 'Y'
                and parentid in (select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y' and parentid is null) order by name";
        $result = $this->db->query($SQL)->result();
        $data = array();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['id']= $value->id;
            $response->rows[$i]['name']= $value->name;
            $i++;
        }

        echo json_encode($response);
    }
    
    public function buildMenuStep3(){
        $id = $_REQUEST['id'];

        $SQL = "select name, id, parentid from kt_menu_product WHERE parentid='{$id}' and is_delete = 'N' and is_active = 'Y'
                and parentid in ( select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y'
                    and parentid in (select id from kt_menu_product  WHERE is_delete = 'N'  and is_active = 'Y' and parentid is null) )
                order by name";
        $result = $this->db->query($SQL)->result();
        $data = array();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['id']= $value->id;
            $response->rows[$i]['name']= $value->name;
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
			$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit, kp.price, kps.pstock as stock, kp.weight, kp.image
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
			
		$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit, kp.price, kps.pstock as stock, kp.weight, kp.image
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
			}else if($this->session['language'] == 'thailand'){
            	$response->rows[$i]['name'] = $row->name_th;
            }
            $response->rows[$i]['volumn'] = $row->volumn;
            $response->rows[$i]['unit'] = $row->unit;
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
		 		$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit, kp.price, kps.pstock as stock, kp.weight, kp.image
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
						}else if($this->session['language'] == 'thailand'){
			            	$response->rows[$i]['name'] = $row->name_th;
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
			$product = $this->db->where('id', $value->id)->get('kt_product')->row();
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
		$this->sendEmailOrder($email, $order_id);
		
		$response->order[0]['id'] = $order_id;
		echo json_encode($response);
		
	}

	public function sendEmailOrder($email = '', $orderid = ''){
		$this->load->library('email');
		$this->email->from('arraieot@gmail.com');
		$this->email->to($email);
		$this->email->subject('Test email');
		$this->email->message('test message email');
		$this->email->send();
	}
	
	public function countProduct(){
		$id = $_REQUEST['id'];
		$SQL = "INSERT INTO kt_product_view (pid,view) VALUES ({$id}, 1) ON DUPLICATE KEY UPDATE view=view+1";
		$result = $this->db->query($SQL);
	}
    
}
