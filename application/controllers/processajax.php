<?php if (!defined('BASEPATH')) die();
class Processajax extends Main_Controller {
    
    function __construct()
    {
        parent::__construct();
    }

   public function index()
   {


   }

    public function getAutoCity(){
        $keyword = $_REQUEST['keyword'];
        $country = $_REQUEST['country'];
        $state = $_REQUEST['state'];
        $where = '';
        if(!empty($keyword)){
                $where .= "and ( lower(ifnull(city.name,'')) like lower('%{$keyword}%')  ) ";
        }

        if(!empty($country)){
                $where .= "and country.name = '{$country}' ";
        }

        if(!empty($state)){
                $where .= " and state.id = (select id from kt_state WHERE name_th = '{$state}' or name_en = '{$state}')";
        }

        $SQL = " SELECT city.name as name FROM kt_city as city
        JOIN kt_state as state ON (state.id = city.state_id)
        JOIN kt_country as country ON (country.id = state.country_id)
        WHERE city.is_delete = 'N' and city.is_active = 'Y' {$where} ORDER BY city.name";

        $result = $this->db->query($SQL)->result();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['name']=$value->name;
            $i++;
        }

        echo json_encode($response);

    }

    public function getAutoState(){
            $keyword = $_REQUEST['keyword'];
            $country = $_REQUEST['country'];
            $where = '';
            if(!empty($keyword)){
                    $where .= "and ( lower(ifnull(state.name_en,'')) like lower('%{$keyword}%')  ) ";
                    $where .= "or ( lower(ifnull(state.name_th,'')) like lower('%{$keyword}%')  ) ";
            }

            if(!empty($country)){
                    $where .= "and country.name = '{$country}' ";
            }

        $SQL = " SELECT COALESCE(state.name_th, state.name_en) as name FROM kt_state as state
        JOIN kt_country as country ON (country.id = state.country_id)
        WHERE state.is_delete = 'N' and state.is_active = 'Y' {$where} ORDER BY name";
        
        $result = $this->db->query($SQL)->result();
        $i=0;
        foreach($result as $value){
            $response->rows[$i]['name']=$value->name;
            $i++;
        }

        echo json_encode($response);
    }

    public function getAutoZipcode(){
        $city = $_REQUEST['city'];
        $country = $_REQUEST['country'];
        $state = $_REQUEST['state'];
        $where = '';

        if(!empty($country)){
            $where .= "and country.name = '{$country}' ";
        }

        if(!empty($state)){
            $where .= " and state.id = (select id from kt_state WHERE name_th = '{$state}' or name_en = '{$state}')";
        }

        if(!empty($city) && !empty($state)){
            $where .= "and city.name ='{$city}' ";
            $SQL = " SELECT city.zipcode as zipcode FROM kt_city as city
            JOIN kt_state as state ON (state.id = city.state_id)
            JOIN kt_country as country ON (country.id = state.country_id)
            WHERE city.is_delete = 'N' and city.is_active = 'Y' {$where} ORDER BY city.name";
            
            $result = $this->db->query($SQL)->result();
            foreach($result as $value){
                $response->zipcode =$value->zipcode;
            }
        }
        
        echo json_encode($response);
    }

}
