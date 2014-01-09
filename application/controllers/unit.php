<?php

class Unit extends CI_Controller
{

   public function index()
   {
      /*
       * This breaks normal CodeIgniter convention.
       * We need to load the views first before we can
       * execute the unit testing.
       */
      
      $this->load->library('unit_test');

      $this->load->model('unit_model');
      $tests = $this->unit_model->retrieve_tests();

      foreach ($tests as $test)
         $this->unit->run($test['rv'], $test['ev'], $test['t'], $test['n']);
      
      $data['tests'] = $this->unit->result();
      $data['count'] = count($data['tests']);
      $data['failed'] = $this->unit_model->count_failed_tests($data['tests']);

      $this->load->view('include/header');
      $this->load->view('templates/unit', $data);
      $this->load->view('include/footer');
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
