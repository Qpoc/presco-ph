<?php defined('BASEPATH') OR exit("No direct script access allowed");

class WishListModel extends CI_Model{

    public function wishList($payload){
        if (isset($payload)){
            $wishlist = array(

                "email" => $payload->email,
                "product_id" => $payload->productId,
                  
            );

            $this->db->insert('wishlist', $wishlist);

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