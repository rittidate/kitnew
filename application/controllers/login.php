<?php

class Login extends CI_Controller
{
	public $user_facebook = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fb');
         $this->user_facebook = $this->fb->sdk->getUser();
		//parse_str($_SESSION['QUERY_STRING'], $_REQUEST);
    }

   public function index()
   {

		
   }

   public function facebook(){
        

       

        if($this->user_facebook){
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
               $this->user_facebook = null;
               //header("Location:./index.php?Login=fail");
          }
        }

        if($this->user_facebook){
            $logout = $this->fb->sdk->getLogoutUrl(array("next"=>base_url().'login/logout/'));
            echo "<a href='$logout'>Logout</a>";
        }else{
            redirect($this->fb->sdk->getLoginUrl(array("scope"=>'email')));
        }
   }

   public function twitter(){
        var_dump($_POST);
   }

   public function form(){
        var_dump($_POST);
   }
   
   public function logout(){
        session_destroy();
        redirect(base_url());
   }


}
