<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

        private static $language;

        public static $varviewer;

        public static $viewerId;
		
        public $user_facebook = null;
        
        public $session = array();
	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		$this->varviewer = 'OCID';

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();

                $this->load->library('kv');

		$this->load->library('fb');
                $this->user_facebook = $this->fb->sdk->getUser();
		
		log_message('debug', "Controller Class Initialized");


                $this->getUniqueViewerId();

                if(empty($this->session['language'])){
                    $this->session['language'] = 'english';
                }

	}

        public function loadHeader()
        {
            $this->headerMain();
            $this->navbarMenu();
            $this->modalHeaderMenu();
            $this->advertiserMain();
            $this->sidebarMenu();
        }
	
	public function headerMain()
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
        $data["logout"] = '';
		
        if(!empty($this->session['user']) && $this->user_facebook){
            $logout_facebook = $this->fb->sdk->getLogoutUrl(array("next"=>base_url()."login/logout/"));
            $logout = "<li class='divider'></li>";
            $logout .= "<li><a href='".$logout_facebook."'>".$this->lang->line("logout")."</a></li>";
            $data["logout"] = $logout;
        }else if(!empty($this->session['user'])){
            $logout = "<li class='divider'></li>";
            $logout .= "<li><a href='".base_url()."login/logout/"."'>".$this->lang->line("logout")."</a></li>";
            $data["logout"] = $logout;
        }

        $this->load->view('include/navbar', $data);
    }
	
	public function advertiserMain()
	{
		$this->load->view('include/advertiser');
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

               
               $data["id"] = $user->id;
               $data["firstname"] = $user->firstname;
               $data["lastname"] = $user->lastname;
               $data["salutation"] = form_dropdown('salutation', $this->kv->getSalutation(), $user->salutation, 'class="form-control" id="salutation"');
               $data["gender"] = form_dropdown('gender', $this->kv->getGender(), $user->gender, 'class="form-control" id="gender"');
               $data["birth"] = $user->birth;
               $data["address1"] = $user->address1;
               $data["address2"] = $user->address2;
               $data["address3"] = $user->address3;
               $data["address4"] = $user->address4;
               $data["city"] = $user->city;
               $data["state"] = $user->state;
               $data["country"] = form_dropdown('country', $this->kv->getCountry(), $user->country, 'class="form-control" id="country"');
               $data["zipcode"] = $user->zipcode;
               $data["mobile"] = $user->mobile;
               $data["telephone"] = $user->telephone;
               $data["telephone_ext"] = $user->telephone_ext;
               $data["fax"] = $user->fax;
               $data["fax_ext"] = $user->fax_ext;
               $this->load->view('include/modal_user', $data);

            }
	}

	public function sidebarMenu()
	{
		$this->load->view('include/sidebar');
	}
	
	public static function &get_instance()
	{
		return self::$instance;
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
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */