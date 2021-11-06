<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller  {
    public function addProduct(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ProductModel->addProduct($payload);
    }
}
