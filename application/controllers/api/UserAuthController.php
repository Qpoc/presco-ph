<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuthController extends CI_Controller {

    public function registerUser(){
        $payload = json_decode(file_get_contents('php://input'));
        
        echo $this->UserAuthModel->registerUser($payload);
    }

    public function verifyLogin(){
        $payload = json_decode(file_get_contents('php://input'));
        
        echo $this->UserAuthModel->verifyLogin($payload);
    }

    public function updateUser(){
        $payload = json_decode(file_get_contents('php://input'));
        
        echo $this->UserAuthModel->updateUser($payload);
    }

    public function verifyLogout(){
        echo $this->UserAuthModel->verifyLogout();
    }
    
}
