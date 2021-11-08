<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller  {
    public function addProduct(){
        $payload = $_FILES;
        $payload_post = $_POST;
        
        echo $this->ProductModel->addProduct($payload, $payload_post);
    }

    public function getProduct(){
        echo $this->ProductModel->getProduct();
    }

    public function addToCart(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ProductModel->addToCart($payload);
    }

    public function updateProduct(){

        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ProductModel->updateProduct($payload);

    }
    
}
