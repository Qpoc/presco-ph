<?php defined("BASEPATH") OR exit("No direct script access allowed");

class BuyerController extends CI_Controller{
    
    public function getBuyerInfo(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->BuyerModel->getBuyerInfo($payload);
    }
  
}

