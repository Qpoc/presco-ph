<?php defined("BASEPATH") OR exit("No direct script access allowed");

class AdminController extends CI_Controller{
    
    public function registerAdmin(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->AdminModel->registerAdmin($payload);
    }
    
}

