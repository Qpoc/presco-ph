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
        }else if(isset($payload->quantity)){
            $_SESSION['productid'] = $payload;
        }else {
            $_SESSION['productid'] = $payload->productid;
        }
    }

    public function loadShipping(){
        if (is_array($_SESSION['productid'])) {
            if (isset($_SESSION['productid'][0]->viewCart)) {
                echo json_encode(array(
                    "status" => "Success",
                    "message" => "Fetch Success",
                    "response" => $_SESSION['productid'],
                ));
            }
        }else if(isset($_SESSION['productid']->quantity)){
            $result = $this->ProductModel->loadShipping($_SESSION['productid']->productid);
            
            $response[] = array(
                "product_id" => json_decode($result)->response[0]->product_id,
                "product_name" => json_decode($result)->response[0]->product_name,
                "image" => json_decode($result)->response[0]->image,
                "price" => json_decode($result)->response[0]->price,
                "stocks" => json_decode($result)->response[0]->stocks,
                "quantity" => $_SESSION['productid']->quantity,
                "viewCart" => true
            );
            
            echo json_encode(array(
                "status" => "Success",
                "message" => "Fetch Success",
                "response" => $response
            ));

        }else {
            echo $this->ProductModel->loadShipping($_SESSION['productid']);
        }
    }

    public function initProductDetails(){
        $payload = json_decode(file_get_contents("php://input"));
        $_SESSION['productDetails'] = $payload->productid;
    }

    public function getProductDetails(){
        echo json_encode($_SESSION['productDetails']);
    }
    
}
