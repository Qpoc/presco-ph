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

    public function addToCart($payload){
        if (isset($payload)){
            $product= array(
                "email" => $payload->email,
                "product_id" => $payload->productId,
                "quantity" => $payload->quantity,
                "price" => $payload->price,
                "total_price" => $payload->totalPrice
            );

            $this->db->insert('cart', $product);

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

    public function updateProduct($payload){
        if (isset($payload)) {
            $product = array(
                "product_name" => $payload->productName,
                "image" => $payload->imagePath,
                "price" => $payload->price,
                "stocks" => $payload->stocks,
                "description" => $payload->description,
                "email" => $payload->email,
                "modified_date" => $payload->modifiedDate
            );

            $this->db->set($product);
            $this->db->where('product_id', $payload->productId);
            $this->db->update('product'); 

            $response = array(
                "status" => "Success",
                "message" => "Product Updated"
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
