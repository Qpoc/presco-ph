<?php defined('BASEPATH') OR exit("No direct script access allowed");

class FeedBackModel extends CI_Model{

    public function feedBack($payload){
        if (isset($payload)){
            $feedBack = array(
                "email" => $payload -> email,
                "product_id" => $payload->productId,
                "message" => $payload->message,
                "modified_date" => $payload->modifiedDate,
            );

            $this->db->insert('feedback', $feedBack);

            $response = array(
                "status" => "Success",
                "message" => "Feedback Created"
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

    public function AdminReply($payload){
        if (isset($payload)){
            $adminReply = array(
                "email" => $payload -> email,
                "feedback_id" => $payload->feedBackId,
                "type" => $payload -> type,
                "message" => $payload->message,
                "modified_date" => $payload->modifiedDate,
            );

            $this->db->insert('reply', $adminReply);

            $response = array(
                "status" => "Success",
                "message" => "Reply Created"
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