<?php if (!defined('BASEPATH')) die();
class Language extends Main_Controller {

    function  __construct()
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
       $this->db->update('kt_session', $update, array('ocid' => $_COOKIE[$this->varviewer]));
       redirect(base_url());
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
