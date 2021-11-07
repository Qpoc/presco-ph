<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WishListController extends CI_Controller{
    public function wishList(){
        $payload = json_decode(file_get_contents('php://input'));
        
        echo $this->WishListModel->wishList($payload);
    }
}