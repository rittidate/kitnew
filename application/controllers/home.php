<?php if (!defined('BASEPATH')) die();
class Home extends Main_Controller {

    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {
      
      $this->load->view('home');
      $this->load->view('include/footer');
    }
    
    public function __destruct() {
      
   }


}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
