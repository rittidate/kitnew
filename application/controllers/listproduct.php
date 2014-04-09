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

    public function updateMPID($mp_id, $barcode)
    {
        $SQL = "select id from kt_product where barcode = '{$barcode}' and is_delete = 'N'";
        $result = $this->db->query($SQL)->result();
        if(count($result) > 0){
           $pid = $result[0]->id;
           $SQL2 = "select id from kt_product_barcode_base as pdbb where pdbb.pid = '{$pid}' and  pdbb.mp_id = '{$mp_id}' and pdbb.barcode = '{$barcode}'";
           $result2 = $this->db->query($SQL2)->result();
           if(count($result2) == 0){
               $data = array(
                    'pid' => $pid,
                    'barcode' => $barcode,
                    'mp_id' => $mp_id
               );
                $this->db->insert('kt_product_barcode_base', $data);
           }
        }
            $arr['name'] = "response";
            echo $_GET['callback']."(".json_encode($arr).");";  // 09/01/12 corrected the statement
    }


}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
