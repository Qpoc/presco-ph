<?php defined('BASEPATH') OR exit("No direct script access allowed");

class ProductModel extends CI_Model{
    
    public function addProduct($payload){
        if (isset($payload)) {
            $product = array(
                "product_name" => $payload->productName,
                "image" => $payload->imagePath,
                "price" => $payload->price,
                "stocks" => $payload->stocks,
                "description" => $payload->description,
                "email" => $payload->email
            );

            $this->db->insert("product", $product);

            $response = array(
                "status" => "Success",
                "message" => "Product Created"
            );

            return json_encode($response);
        }else {
            $response = array(
                "status" => "Failed",
                "message" => "Missing payload"
            );

            return json_encode($response);
        }
    }

}
