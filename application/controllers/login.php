<?php

class Login extends CI_Controller
{
	public $user = null;

    public function __construct()
    {
        parent::__construct();
		//parse_str($_SESSION['QUERY_STRING'], $_REQUEST);

        $this->load->library('fb');
        
		$this->user = $this->fb->sdk->getUser();
		//$user = $this->fb->getUser();
		//var_dump($this->fb->sdk->getUser());
    }

   public function index()
   {
   		if($this->user){
   			  try { 
				   $user_profile = $this->fb->sdk->api('/me'); // เป็นการเรียก Method /me ซึ่งเป็นข้อมูลเกี่ยวกับผู้ใช้ท่านนั้นๆ ที่ได้ทำการ Login
				   echo "<br/>";
				   print_r($user_profile);
				   //echo $user_profile['email'];
				   /*
				   $_SESSION['LOGIN_FB_ID'] = $FB_ME_INFO["id"];
				   $_SESSION['LOGIN_FB_FULLNAME'] = $FB_ME_INFO["name"];
				   header("Location:./index.php"); 
				   */
			  } catch(FacebookApiException $e) {
			  	 
				   echo $e;  // print Error
				   $this->user = null;
				   //header("Location:./index.php?Login=fail"); 
			  }
   		}
		
		if($this->user){
				$logout = $this->fb->sdk->getLogoutUrl(array("next"=>base_url().'login/logout/'));
				echo "<a href='$logout'>Logout</a>";
		}else{
				$login = $this->fb->sdk->getLoginUrl(array("scope"=>'email'));
				echo "<a href='$login'>Login</a>";
		}
		
   }
   
   public function logout(){
   		session_destroy();
		redirect(base_url().'login');
   }


}
