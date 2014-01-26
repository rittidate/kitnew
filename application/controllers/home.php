<?php if (!defined('BASEPATH')) die();
class Home extends Main_Controller {

    function  __construct()
    {
        parent::__construct();
        $this->loadHeader();
    }

   public function index()
    {
    	//langague 
        $this->lang->load('product', $this->session['language']);

        $data["plabel_barcode"] = $this->lang->line("plabel_barcode");
        $data["plabel_price"] = $this->lang->line("plabel_price");
        $data["plabel_baht"] = $this->lang->line("plabel_baht");
        $data["plabel_buy"] = $this->lang->line("plabel_buy");
        $data["plabel_qty"] = $this->lang->line("plabel_qty");
	
       $this->load->view('home',$data);
	   $this->load->view('include/modal_image');
       $this->load->view('include/footer');
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
