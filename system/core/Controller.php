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

        private static $varviewer;

        private static $viewerId;

        private static $language;
		
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
		
		$this->load->library('fb');
                $this->user_facebook = $this->fb->sdk->getUser();
		
		log_message('debug', "Controller Class Initialized");


                $this->getUniqueViewerId();
                
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
		
        if($this->user_facebook){
            $logout_facebook = $this->fb->sdk->getLogoutUrl(array("next"=>base_url()."login/logout/"));
            $logout = "<li class='divider'></li>";
            $logout .= "<li><a href='".$logout_facebook."'>".$this->lang->line("logout")."</a></li>";
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

               $data["id"] = $user->id;
               $data["firstname"] = $user->firstname;
               $data["lastname"] = $user->lastname;
               
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

        $this->getSession($uniqueViewerId);
    }

    private function getSession($uniqueViewerId = null)
    {
       $query = $this->db->having('ocid', $uniqueViewerId)->get('kt_session');
       if($query->num_rows == 0){
           $serial = array('language' => 'english');
           $data = array(
                'ocid' => $uniqueViewerId,
                'sessiondata' => serialize($serial),
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