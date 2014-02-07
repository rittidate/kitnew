<?php if (!defined('BASEPATH')) die();
class Home extends Main_Controller {

    function  __construct()
    {
        parent::__construct();
        $this->loadHeader();
    }

   public function index()
    {
       $this->load->view('home');
	   $this->load->view('include/modal_confirm');
       $this->load->view('include/footer');
    }
	

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
