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
                $response->zipcode =$value->zipcode;
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
        $step = $_REQUEST['step'];
		$menuid = $_REQUEST['menuid'];
		$page = $_REQUEST['page'];
		$where = "";
		$numberLimit = 9;
		
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
		if(empty($page)){
			$limit = "LIMIT $numberLimit";
		}else{
			$start = ($page-1) * $numberLimit;
			$limit = "LIMIT $start, $numberLimit";
		}
		
		$SQL_COUNT = "select count(*) as count
				from kt_product as kp 
				left join kt_product_stock as kps on (kp.id = kps.pid) 
				where kp.is_active='Y' and kp.is_delete='N' {$where}";
		$count = $this->db->query($SQL_COUNT)->result();
		
		$count = $count[0]->count;
		
		$response->page[0] = ceil ( $count / $numberLimit );
		
		
		$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit, kp.price, kps.pstock as stock, kp.weight, kp.image
				from kt_product as kp
				left join kt_define_data_type as kdt on (kp.unit = kdt.id)
				left join kt_product_stock as kps on (kp.id = kps.pid) 
				where kp.is_active='Y' and kp.is_delete='N' {$where} {$limit}";

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
		 $json = $this->session['cart'];
		 if(!empty($this->session['cart'])){
		 $i=0;
		 foreach ($json as $key => $value) {
		 	$where = "and kp.id = {$value->id}";
	 		$SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit, kp.price, kps.pstock as stock, kp.weight, kp.image
				from kt_product as kp
				left join kt_define_data_type as kdt on (kp.unit = kdt.id)
				left join kt_product_stock as kps on (kp.id = kps.pid) 
				where kp.is_active='Y' and kp.is_delete='N' {$where} ";
				
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
		            $i++;
		        }
		 }
		 echo json_encode($response);
		 }

    }
    

}
