<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WishListController extends CI_Controller{
    public function addWishList(){
        $payload = json_decode(file_get_contents('php://input'));
        
        echo $this->WishListModel->addWishList($payload);
    }
    public function getWishList(){
        $payload = json_decode(file_get_contents('php://input'));
        
        echo $this->WishListModel->getWishList($payload);
    }
}