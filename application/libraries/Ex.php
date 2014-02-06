<?php
include_once 'excel/PHPExcel.php';
class Ex extends PHPExcel {

    public function __construct() { 
      parent::__construct(); 
    } 
	
   private function load()
   {
      include_once 'excel/PHPExcel.php';

      $this->phpexcel = new PHPExcel();
   }      
   
}
