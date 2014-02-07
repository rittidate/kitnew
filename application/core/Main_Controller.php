<?php
class Main_Controller extends MY_Controller 
{
    public static $varviewer;

    public static $viewerId;

    public static $user_facebook = null;

   function __construct()
   {
      parent::__construct();
      
      $this->varviewer = 'OCID';
      
      $this->load->library('kv');
      $this->load->library('fb');

      $this->user_facebook = $this->fb->sdk->getUser();

      $this->getUniqueViewerId();
   }

   private function getUniqueViewerId($create = true)
    {
        $expire = time()+3600*24*365*10;
        if (isset($_COOKIE[$this->varviewer])) {
            $uniqueViewerId = $_COOKIE[$this->varviewer];
        } else {
            $uniqueViewerId = md5(uniqid('', true));  // Need to find a way to generate this...
            @setcookie($this->varviewer, $uniqueViewerId, $expire, '/');
        }

        $this->viewerId = $uniqueViewerId;

        $this->getSession();
    }

    private function getSession()
    {
       $query = $this->db->having('ocid', $this->viewerId)->get('kt_session');
       if($query->num_rows == 0){
           $this->session['language'] = "english";
           $data = array(
                'ocid' => $this->viewerId,
                'sessiondata' => serialize($this->session),
                'lastused' => date('Y-m-d H:i:s')
           );
            $this->db->insert('kt_session', $data);
       }else{
            $session = $this->db->where('ocid', $_COOKIE[$this->varviewer])
                               ->get('kt_session')->row();
            $this->session = unserialize($session->sessiondata);
       }
    }
	
	public function getIncludeWeight()
	{
	    $SQL = "SELECT value FROM kt_define_data_type WHERE ref_data_type =  'WEIGHT_PACKAGE' ";
		$result = $this->db->query($SQL)->result();
	    return $result[0]->value;
	}
	
	public function getServiceCharge()
	{
		$SQL = "SELECT value FROM kt_define_data_type WHERE ref_data_type =  'SERVICE_CHARGE' ";
		$result = $this->db->query($SQL)->result();
	    return $result[0]->value;
	}
	
	public function getIncludeVat()
	{
		$SQL = "SELECT value FROM kt_define_data_type WHERE ref_data_type =  'INCLUDE_VAT' ";
		$result = $this->db->query($SQL)->result();
	    return $result[0]->value;
	}

    public function loadHeader()
    {
        $this->headerMain();
        $this->navbarMenu();
        $this->modalHeaderMenu();
        $this->advertiserMain();
        $this->sidebarMenu();
		$this->modalImage();
    }

    private function headerMain()
    {
            $this->load->view('include/header');
    }

    public function navbarMenu()
    {
        //$language = "thailand";
        if(empty($this->session['language'])){
            $language = 'english';
        }else{
            $language = $this->session['language'];
        }

        $this->lang->load('menu', $language);
        $data["home"] = $this->lang->line("home");
        $data["about"] = $this->lang->line("about");
        $data["map"] = $this->lang->line("map");
        $data["user"] = $this->lang->line("user");
        $data["order"] = $this->lang->line("order");
        $data["cart"] = $this->lang->line("cart");
        $data["config"] = $this->lang->line("config");
        $data["profile"] = '';
        $data["logout"] = '';

        if(!empty($this->session['user']) && $this->user_facebook){
            $logout_facebook = $this->fb->sdk->getLogoutUrl(array("next"=>base_url()."login/logout/"));
            $logout = "<li class='divider'></li>";
            $logout .= "<li><a href='".$logout_facebook."'>".$this->lang->line("logout")."</a></li>";
            $data["logout"] = $logout;
			if($this->user_facebook){
				$data["profile"] = '<li><a href="#" data-toggle="modal" data-target="#userModal"><img src="http://graph.facebook.com/'.$this->session['facebook_id'].'/picture" height="50" width="50 " class="img-circle"></a></li>';
			}
        }else if(!empty($this->session['user'])){
            $logout = "<li class='divider'></li>";
            $logout .= "<li><a href='".base_url()."login/logout/"."'>".$this->lang->line("logout")."</a></li>";
            $data["logout"] = $logout;
        }
		
		

        $this->load->view('include/navbar', $data);
    }

    public function modalHeaderMenu()
    {
        if(empty($this->session['user'])){
            $this->load->view('include/modal_login');
        }else{
           $user = $this->db->where('id', $this->session['user'])
                           ->get('kt_customer')->row();

            $this->lang->load('modal_user', $this->session['language']);
            $data["label_salutation"] = $this->lang->line("label_salutation");
            $data["label_firstname"] = $this->lang->line("label_firstname");
            $data["label_lastname"] = $this->lang->line("label_lastname");
            $data["label_gender"] = $this->lang->line("label_gender");
            $data["label_birth"] = $this->lang->line("label_birth");
            $data["label_address1"] = $this->lang->line("label_address1");
            $data["label_address2"] = $this->lang->line("label_address2");
            $data["label_address3"] = $this->lang->line("label_address3");
            $data["label_address4"] = $this->lang->line("label_address4");
            $data["label_city"] = $this->lang->line("label_city");
            $data["label_state"] = $this->lang->line("label_state");
            $data["label_country"] = $this->lang->line("label_country");
            $data["label_zipcode"] = $this->lang->line("label_zipcode");
            $data["label_mobile"] = $this->lang->line("label_mobile");
            $data["label_telephone"] = $this->lang->line("label_telephone");
            $data["label_ext"] = $this->lang->line("label_ext");
            $data["label_fax"] = $this->lang->line("label_fax");
            $data["label_submit"] = $this->lang->line("label_submit");
			$data["label_close"] = $this->lang->line("label_close");

           $data["id"] = $user->id;
           $data["firstname"] = $user->firstname;
           $data["lastname"] = $user->lastname;
           $data["salutation"] = form_dropdown('salutation', $this->kv->getSalutation(), $user->salutation, 'class="form-control" id="user_salutation"');
           $data["gender"] = form_dropdown('gender', $this->kv->getGender(), $user->gender, 'class="form-control" id="user_gender"');
           $data["birth"] = $user->birth;
           $data["address1"] = $user->address1;
           $data["address2"] = $user->address2;
           $data["address3"] = $user->address3;
           $data["address4"] = $user->address4;
           $data["city"] = $user->city;
           $data["state"] = $user->state;
           $data["country"] = form_dropdown('country', $this->kv->getCountry(), $user->country, 'class="form-control" id="user_country"');
           $data["zipcode"] = $user->zipcode;
           $data["mobile"] = $user->mobile;
           $data["telephone"] = $user->telephone;
           $data["telephone_ext"] = $user->telephone_ext;
           $data["fax"] = $user->fax;
           $data["fax_ext"] = $user->fax_ext;
           $this->load->view('include/modal_user', $data);

        }

		$this->modalCart();
    }

	private function modalCart()
	{
    	//langague 
        $this->lang->load('product', $this->session['language']);

        $data["plabel_barcode"] = $this->lang->line("plabel_barcode");
		$data["plabel_product"] = $this->lang->line("plabel_product");
        $data["plabel_price"] = $this->lang->line("plabel_price");
        $data["plabel_baht"] = $this->lang->line("plabel_baht");
        $data["plabel_buy"] = $this->lang->line("plabel_buy");
        $data["plabel_qty"] = $this->lang->line("plabel_qty");
		$data["plabel_total"] = $this->lang->line("plabel_total");
		$data["plabel_subtotal"] = $this->lang->line("plabel_subtotal");
		$data["plabel_shipprice"] = $this->lang->line("plabel_shipprice");
		$data["plabel_grandtotal"] = $this->lang->line("plabel_grandtotal");
		$data["plabel_image"] = $this->lang->line("plabel_image");
		
        $this->lang->load('modal_user', $this->session['language']);
		$data["label_salutation"] = $this->lang->line("label_salutation");
		$data["label_firstname"] = $this->lang->line("label_firstname");
		$data["label_lastname"] = $this->lang->line("label_lastname");
		$data["label_gender"] = $this->lang->line("label_gender");
		$data["label_birth"] = $this->lang->line("label_birth");
		$data["label_address1"] = $this->lang->line("label_address1");
		$data["label_address2"] = $this->lang->line("label_address2");
		$data["label_address3"] = $this->lang->line("label_address3");
		$data["label_address4"] = $this->lang->line("label_address4");
		$data["label_city"] = $this->lang->line("label_city");
		$data["label_state"] = $this->lang->line("label_state");
		$data["label_country"] = $this->lang->line("label_country");
		$data["label_zipcode"] = $this->lang->line("label_zipcode");
		$data["label_mobile"] = $this->lang->line("label_mobile");
		$data["label_telephone"] = $this->lang->line("label_telephone");
		$data["label_ext"] = $this->lang->line("label_ext");
		$data["label_fax"] = $this->lang->line("label_fax");
		$data["label_email"] = $this->lang->line("label_email");
		
		$this->lang->load('modal_cart', $this->session['language']);
		$data["clabal_cart"] = $this->lang->line("clabal_cart");
		$data["clabal_shipment"] = $this->lang->line("clabal_shipment");
		$data["clabal_shiperror"] = $this->lang->line("clabal_shiperror");
		$data["clabal_payerror"] = $this->lang->line("clabal_payerror");
		$data["clabal_shipment_head"] = $this->lang->line("clabal_shipment_head");
		$data["clabal_payment_head"] = $this->lang->line("clabal_payment_head");
		$data["clabal_order"] = $this->lang->line("clabal_order");
		$data["clabal_close"] = $this->lang->line("clabal_close");
		$data["clabal_step1"] = $this->lang->line("clabal_step1");
		$data["clabal_step2"] = $this->lang->line("clabal_step2");
		$data["clabal_thank"] = $this->lang->line("clabal_thank");
		$data["clabal_cartdetail"] = $this->lang->line("clabal_cartdetail");
		$data["clabal_order_number"] = $this->lang->line("clabal_order_number");
		
		if(!empty($this->session['user']) && empty($this->session['ship'])){
	       $user = $this->db->where('id', $this->session['user'])
	               ->get('kt_customer')->row();
				   
	       $data["id"] = $user->id;
	       $data["firstname"] = $user->firstname;
	       $data["lastname"] = $user->lastname;
	       $data["salutation"] = form_dropdown('salutation', $this->kv->getSalutation(), $user->salutation, 'class="form-control" id="ship_salutation"');
	       $data["gender"] = form_dropdown('gender', $this->kv->getGender(), $user->gender, 'class="form-control" id="ship_gender"');
	       $data["birth"] = $user->birth;
	       $data["address1"] = $user->address1;
	       $data["address2"] = $user->address2;
	       $data["address3"] = $user->address3;
	       $data["address4"] = $user->address4;
	       $data["city"] = $user->city;
	       $data["state"] = $user->state;
	       $data["country"] = form_dropdown('country', $this->kv->getCountry(), $user->country, 'class="form-control" id="ship_country"');
	       $data["zipcode"] = $user->zipcode;
	       $data["mobile"] = $user->mobile;
	       $data["telephone"] = $user->telephone;
	       $data["telephone_ext"] = $user->telephone_ext;
	       $data["fax"] = $user->fax;
	       $data["fax_ext"] = $user->fax_ext;
		   $data["email"] = $user->email;
        }else if(!empty($this->session['ship'])){
	       //$data["id"] = $user->id;
	       $data["firstname"] = $this->session['ship']['firstname'];
	       $data["lastname"] = $this->session['ship']['lastname'];
	       $data["salutation"] = form_dropdown('salutation', $this->kv->getSalutation(), $this->session['ship']['salutation'], 'class="form-control" id="ship_salutation"');
	       $data["gender"] = form_dropdown('gender', $this->kv->getGender(), $this->session['ship']['gender'], 'class="form-control" id="ship_gender"');
	       $data["birth"] = $this->session['ship']['birth'];
	       $data["address1"] = $this->session['ship']['address1'];
	       $data["address2"] = $this->session['ship']['address2'];
	       $data["address3"] = $this->session['ship']['address3'];
	       $data["address4"] = $this->session['ship']['address4'];
	       $data["city"] = $this->session['ship']['city'];
	       $data["state"] = $this->session['ship']['state'];
	       $data["country"] = form_dropdown('country', $this->kv->getCountry(), $this->session['ship']['country'], 'class="form-control" id="ship_country"');
	       $data["zipcode"] = $this->session['ship']['zipcode'];
	       $data["mobile"] = $this->session['ship']['mobile'];
	       $data["telephone"] = $this->session['ship']['telephone'];
	       $data["telephone_ext"] = $this->session['ship']['telephone_ext'];
	       $data["fax"] = $this->session['ship']['fax'];
	       $data["fax_ext"] = $this->session['ship']['fax_ext'];
	       $data["email"] = $this->session['ship']['email'];
		}else{
       	   $data["id"] = '';
	       $data["firstname"] = '';
	       $data["lastname"] = '';
	       $data["salutation"] = form_dropdown('salutation', $this->kv->getSalutation(), '', 'class="form-control" id="ship_salutation"');
	       $data["gender"] = form_dropdown('gender', $this->kv->getGender(), '', 'class="form-control" id="ship_gender"');
	       $data["birth"] = '';
	       $data["address1"] = '';
	       $data["address2"] = '';
	       $data["address3"] = '';
	       $data["address4"] = '';
	       $data["city"] = '';
	       $data["state"] = '';
	       $data["country"] = form_dropdown('country', $this->kv->getCountry(), 'Thailand', 'class="form-control" id="ship_country"');
	       $data["zipcode"] = '';
	       $data["mobile"] = '';
	       $data["telephone"] = '';
	       $data["telephone_ext"] = '';
	       $data["fax"] = '';
	       $data["fax_ext"] = '';
		   $data["email"] = '';
       }
		$this->load->view('include/modal_cart', $data);
	}

	private function modalImage()
	{
		$this->load->view('include/modal_image');
	}

    public function advertiserMain()
    {
            $this->load->view('include/advertiser');
    }

    public function sidebarMenu()
    {
        $SQL = "select name, id, parentid from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y' and parentid is null
                union
                select name, id, parentid from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y'
                and parentid in (select id from kt_menu_product WHERE is_delete = 'N' and is_active = 'Y' and parentid is null)";

        $result = $this->db->query($SQL)->result();
        $data = array();
        foreach($result as $row){
            if($row->parentid == ""){
                $data['root'][$row->id]['id'] = $row->id;
                $data['root'][$row->id]['name'] = $row->name;
            }else{
                $data['parent'][$row->parentid][$row->id]['id'] = $row->id;
                $data['parent'][$row->parentid][$row->id]['name'] = $row->name;
                $data['parent'][$row->parentid][$row->id]['count'] = $this->db->select('*')->from('kt_menu_product')->where('parentid', $row->id)->where('is_active', 'Y')->where('is_delete', 'N')->count_all_results();
            }
        }
        $this->load->view('include/sidebar', $data);
    }
}
