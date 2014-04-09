<?php if (!defined('BASEPATH')) die();
class Listproduct extends Main_Controller {

    function  __construct()
    {
        parent::__construct();
        //$this->loadHeader();
    }

    public function localstock($barcode, $qty)
    {
        $count = $this->db->select('*')->from('kt_product')->where(array('is_active' => 'Y', 'is_delete' => 'N', 'barcode' => '$barcode'))->count_all_results();

        if($count == 0){
            $arr['name'] = "response";
            echo $_GET['callback']."(".json_encode($arr).");";  // 09/01/12 corrected the statement
        }
    }


}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
