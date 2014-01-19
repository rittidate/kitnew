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
                   //print_r($user_profile);
                   $have_row = $this->db->having('email', $user_profile['email'])->get('kt_customer');
                   if($have_row->num_rows > 0){
                       $user = $this->db->where('email', $user_profile['email'])
                               ->get('kt_customer')->row();
                       $this->session['user'] = $user->id;
                       $this->session['facebook_id'] = $user_profile['id'];
                   }else{
                       $data = array('firstname' => $user_profile["first_name"],
                                     'lastname' => $user_profile["last_name"],
                                     'email' => $user_profile["email"],
                                     'password' => md5($user_profile["id"]),
                                     'is_delete' => 'N',
                                     'is_active' => 'Y',
                                     'create_date' => date('Y-m-d H:i:s'),
                                     );
                       $this->db->insert('kt_customer', $data);
                       $insert_id = $this->db->insert_id();
                       $this->session['user'] = $insert_id;
                       $this->session['facebook_id'] = $user_profile['id'];
                   }

                   $update = array(
                        'sessiondata' => serialize($this->session),
                        'lastused' => date('Y-m-d H:i:s')
                   );
                   $this->db->update('kt_session', $update, array('ocid' => $_COOKIE[$this->varviewer]));
                   
          } catch(FacebookApiException $e) {
               echo $e;  // print Error
               $this->user_facebook = null;
          }
        }

        if($this->user_facebook){
            redirect(base_url());
        }else{
            redirect($this->fb->sdk->getLoginUrl(array("scope"=>'email')));
        }
   }

   public function twitter(){
        var_dump($_POST);
   }

   public function form(){
        $email = trim($_POST["email"]);
        $password = md5(trim($_POST["password"]));
        $have_row = $this->db->having('email', $email)->having('password', $password)->get('kt_customer');
        if($have_row->num_rows > 0){
                       $user = $this->db->where('email', $email)
                               ->where('password',$password)
                               ->get('kt_customer')->row();
                       $this->session['user'] = $user->id;

                      $update = array(
                            'sessiondata' => serialize($this->session),
                            'lastused' => date('Y-m-d H:i:s')
                       );
                       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE[$this->varviewer]));
                       redirect(base_url());
        }

   }
   
   public function logout(){
      unset($this->session['user']);
      unset($this->session['facebook_id']);
      $update = array(
            'sessiondata' => serialize($this->session),
            'lastused' => date('Y-m-d H:i:s')
       );
       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE[$this->varviewer]));
       session_destroy();
       redirect(base_url());
   }


}
