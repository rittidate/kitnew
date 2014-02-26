<?php

class Kv {

    public $ci;

   public function __construct()
   {
       $this->ci =& get_instance();
   }

   public function getSalutation()
   {
       $array = array();
       $result = $this->ci->db->select('id, data_type_name')
               ->where('ref_data_type', 'SALUTATION_TYPE')
               ->where('is_active', 'Y')
               ->where('is_delete', 'N')
               ->get('kt_define_data_type')->result();
       foreach($result as $value)
       {
           $array[$value->id] = $value->data_type_name;
       }
       return $array;
   }

   public function getGender()
   {
       $array = array();
       $result = $this->ci->db->select('id, data_type_name')
               ->where('ref_data_type', 'GENDER_TYPE')
               ->where('is_active', 'Y')
               ->where('is_delete', 'N')
               ->get('kt_define_data_type')->result();
       foreach($result as $value)
       {
           $array[$value->id] = $value->data_type_name;
       }
       return $array;
   }

    public function getCountry()
   {
       $array = array();
       $result = $this->ci->db->select('name')
               ->where('is_active', 'Y')
               ->where('is_delete', 'N')
               ->get('kt_country')->result();
       foreach($result as $value)
       {
           $array[$value->name] = $value->name;
       }
       return $array;
   }

    public function getPayment()
   {
       $array = array();
       $result = $this->ci->db->select(array('data_type_name', 'id'))
	   		   ->where('data_type_name !=', 'เงินสด')
	   		   ->where('ref_data_type', 'PAYMENT_TYPE')
               ->where('is_active', 'Y')
               ->where('is_delete', 'N')
               ->get('kt_define_data_type')->result();
       foreach($result as $value)
       {
           $array[$value->id] = $value->data_type_name;
       }
       return $array;
   }
   
   public function getHour()
   {
       $array = array();
       for($i=0; $i<=23;$i++)
       {
           $array[$i] = $i;
       }
       return $array;
   }
   
   public function getMinute()
   {
       $array = array();
       for($i=0; $i<=59;$i++)
       {
           $array[$i] = $i;
       }
       return $array;
   }

}
