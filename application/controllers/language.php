<?php

class Language extends CI_Controller
{
	public $user_facebook = null;

    public function __construct()
    {
        parent::__construct();
    }

   public function index()
   {
        if(empty($this->session['language']) || $this->session['language'] == 'english'){
            $this->session['language'] = 'thailand';
        }else if($this->session['language'] == 'thailand'){
            $this->session['language'] = 'english';
        }
        $update = array(
            'sessiondata' => serialize($this->session),
            'lastused' => date('Y-m-d H:i:s')
       );
       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE['OCID']));
        redirect(base_url());
   }

   public function facebook(){
        if($this->user_facebook){
          try {
                   $user_profile = $this->fb->sdk->api('/me'); // เป็นการเรียก Method /me ซึ่งเป็นข้อมูลเกี่ยวกับผู้ใช้ท่านนั้นๆ ที่ได้ทำการ Login
                   $have_row = $this->db->having('email', $user_profile['email'])->get('kt_customer');
                   if($have_row->num_rows > 0){
                       $user = $this->db->where('email', $user_profile['email'])
                               ->get('kt_customer')->row();
                       $data = array();
                       $data['user'] = $user->id;
                       $data['facebook_id'] = $user_profile['id'];

                      $update = array(
                            'sessiondata' => serialize($data),
                            'lastused' => date('Y-m-d H:i:s')
                       );
                       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE['OCID']));
                   }
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
        var_dump($_POST);
   }

   public function logout(){

      $data = array();
      // $data['user'] = $user->id;
      // $data['facebook_id'] = $user_profile['id'];

      $update = array(
            'sessiondata' => serialize($data),
            'lastused' => date('Y-m-d H:i:s')
       );
       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE['OCID']));
        session_destroy();
        redirect(base_url());
   }


}
