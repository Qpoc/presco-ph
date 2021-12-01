<?php defined('BASEPATH') OR exit("No direct script access allowed");

class WishListModel extends CI_Model{

    public function wishList($payload){
        if (isset($payload)){
            $wishlist = array(

                "email" => $payload->email,
                "product_id" => $payload->productId,
                  
            );
            $query = $this->db->query("SELECT product_id, email FROM cart WHERE product_id = $payload->productId AND email = '$payload->email'");

            if($query->num_rows() > 0 && isset($payload->removeItem)){
                $this->db->where('product_id', $payload->productId)->where('email', $payload->email);
                $this->db->delete('wishList');
            }else if($query->num_rows() > 0 && !isset($payload->removeItem)){
               
                $this->db->insert('wishlist', $wishlist);
            }
            else{
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
}