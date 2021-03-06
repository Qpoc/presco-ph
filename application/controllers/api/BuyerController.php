<?php defined("BASEPATH") OR exit("No direct script access allowed");

class BuyerController extends CI_Controller{
    
    public function getBuyerInfo(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->BuyerModel->getBuyerInfo($payload);
    }

    public function getBuyerList(){
        echo $this->BuyerModel->getBuyerList();
    }

    public function cancelOrder(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->BuyerModel->cancelOrder($payload);
    }

    public function listCancel(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->BuyerModel->listCancel($payload);
    }

    public function searchProduct(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->BuyerModel->searchProduct($payload);
    }

    public function updateProfile(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->BuyerModel->updateProfile($payload);
    }

    public function updateAddress(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->BuyerModel->updateAddress($payload);
    }
  
}

