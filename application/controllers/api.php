<?php if (!defined('BASEPATH')) die();

require APPPATH.'/libraries/REST_Controller.php';
class Api extends REST_Controller {

//    function  __construct()
//    {
//        parent::__construct();
//        //$this->loadHeader();
//    }



    function products_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $SQL = "select kp.id as pid, kp.barcode, kp.name_en, kp.name_th, kp.volumn, kdt.data_type_name as unit_en, kdt.description as unit_th, kp.price, kps.pstock as stock, kp.weight, kp.image
        from kt_product as kp
        left join kt_define_data_type as kdt on (kp.unit = kdt.id)
        left join kt_product_stock as kps on (kp.id = kps.pid)
        where kp.is_active='Y' and kp.is_delete='N'";

        $result = $this->db->query($SQL)->result();
        $i=0;
        foreach($result as $row){
            $response->rows[$i]['pid'] = $row->pid;
            $response->rows[$i]['barcode'] = $row->barcode;
            $response->rows[$i]['name'] = $row->name_th.' '.$row->volumn.' '.$row->unit_th;
            $response->rows[$i]['price'] = $row->price;
            $i++;
        }
        
        if($response)
        {
            $this->response($response, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function localstock($barcode, $qty)
    {
        $SQL = "select kp.id as pid from kt_product as kp where kp.barcode = '$barcode'";
        $result = $this->db->query($SQL)->result();
        foreach($result as $row){
           $pid = $row->pid;

        }
        $arr = array($pid, $qty);
        $arr['name'] = "response";
        echo $_GET['callback']."(".json_encode($arr).");";  // 09/01/12 corrected the statement
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
