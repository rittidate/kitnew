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

}
