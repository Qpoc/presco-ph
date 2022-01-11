<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller  {
    public function addProduct(){
        $payload = $_FILES;
        $payload_post = $_POST;
        
        echo $this->ProductModel->addProduct($payload, $payload_post);
    }

    public function getProduct(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ProductModel->getProduct($payload);
    }

    public function addToCart(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ProductModel->addToCart($payload);
    }

    public function getCart(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ProductModel->getCart($payload);
    }

    public function updateProduct(){

        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ProductModel->updateProduct($payload);

    }

    public function shipping(){
        $payload = json_decode(file_get_contents("php://input"));
        if (is_array($payload)) {
            $_SESSION['productid'] = $payload;
        }else {
            $_SESSION['productid'] = $payload->productid;
        }
    }

    public function loadShipping(){
        if (isset($_SESSION['productid'][0]->viewCart)) {
            echo json_encode(array(
                "status" => "Success",
                "message" => "Fetch Success",
                "response" => $_SESSION['productid'],
            ));
        }else {
            echo $this->ProductModel->loadShipping($_SESSION['productid']);
        }
    }
    
}
