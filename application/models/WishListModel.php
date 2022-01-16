<?php defined('BASEPATH') OR exit("No direct script access allowed");

class WishListModel extends CI_Model{

    public function addWishList($payload){
        if (isset($payload)){
            $wishlist = array(
                "email" => $payload->email,
                "product_id" => $payload->productId,
            );
            $query = $this->db->query("SELECT product_id, email FROM wishlist WHERE product_id = $payload->productId AND email = '$payload->email'");

            if($query->num_rows() > 0 && isset($payload->removeItem)){
                $this->db->where('product_id', $payload->productId)->where('email', $payload->email);
                $this->db->delete('wishlist');
            }else{
                $this->db->insert('wishlist', $wishlist); 
            }
            
            $response = array(
                "status" => "Success",
                "message" => "wishlist Created"
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

    public function getWishList($payload){
        if (isset($payload->productid)) {
            $result = $this->db->select("*")->from('wishlist')->where('email', $payload->email)->where('product_id', $payload->productid)->get();
        }else {
            $result = $this->db->select("*")->from('wishlist')->where('email', $payload->email)->get();
        }
        
        if ($result->num_rows() > 0) {
            $response = array(
                "status" => "Success",
                "message" => "Fetch Success",
                "response" => $result->result()
            );
        }else {
            $response = array(
                "status" => "Failed",
                "message" => "Fetch Failed"
            );
        }

        return json_encode($response);
    }
}