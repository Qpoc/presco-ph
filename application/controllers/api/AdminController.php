<?php defined("BASEPATH") OR exit("No direct script access allowed");

class AdminController extends CI_Controller{
    
    public function registerAdmin(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->AdminModel->registerAdmin($payload);
    }

    public function addCategory(){
        $payload = $_FILES;
        $payload_post = $_POST;
        
        echo $this->AdminModel->addCategory($payload, $payload_post);
    }

    public function updateCategory(){
        $payload = $_FILES;
        $payload_post = $_POST;
        
        echo $this->AdminModel->updateCategory($payload, $payload_post);
    }

    public function getCategory(){
        echo $this->AdminModel->getCategory();
    }

    public function getTransactionStatus(){
        echo $this->AdminModel->getTransactionStatus();
    }

    public function updateCustomerStatus(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->AdminModel->updateCustomerStatus($payload);
    }

    public function getTrackingInformation(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->AdminModel->getTrackingInformation($payload);
    }

    public function getMonthlySales(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->AdminModel->getMonthlySales($payload);
    }
    
    public function getProductSales(){
        echo $this->AdminModel->getProductSales();
    }

    public function getProductNoSales(){
        echo $this->AdminModel->getProductNoSales();
    }

    public function banBuyer(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->AdminModel->banBuyer($payload);
    }
    
}

