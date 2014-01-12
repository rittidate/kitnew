<?php

class Unit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // load language file
        $this->lang->load('about');

    }

   public function index()
   {
       $this->lang->load('about', 'thailand');
        $data["name"] = "Satit";
       $data["test"] = $this->lang->line("about.gender");
       $this->load->view('unit', $data);
   }

   public function getall(){
       //$this->load->view('include/header');
      $sql = "select * FROM kt_product Limit 0, 10";
      $query = $this->db->query($sql)->result();
      $this->load->view('include/header');
      print_r($query);
      $this->load->view('include/footer');
      
   }

}
