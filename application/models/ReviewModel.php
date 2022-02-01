<?php defined('BASEPATH') OR exit("No direct script access allowed");

class ReviewModel extends CI_Model{
   
    public function getProductsToReview($payload){
        if (isset($payload)){
          
            $result = $this->db->select("*")->from("tracking")->join("transaction", "tracking.transaction_id = transaction.transaction_id")->join("transaction_product", "transaction.transaction_id = transaction_product.transaction_id")->join("product", "transaction_product.product_id = product.product_id")->where("transaction.email" , $payload->email)->where("tracking.status", 5)->where("transaction_product.reviewed", 0)->get();

            $response = array(
                "status" => "Success",
                "message" => "Fetch Successfully",
                "response" => $result->result()
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

    public function submitReview($payload){
        $data = array(
            "reviewed" => $payload->reviewed
        );

        $this->db->where("transaction_id", $payload->transaction_id)->where("product_id", $payload->product_id);
        $this->db->update("transaction_product",$data);

        $feedback = array(
           "transaction_id" => $payload->transaction_id,
           "product_id" => $payload->product_id,
           "message" => $payload->feedback,
           "rating" => $payload->rating
        );

        if ($this->db->insert("feedback", $feedback)) {
            $response = array(
                "status" => "Success",
                "message" => "Category Created"
            );
        }else {
            $response = array(
                "status" => "Failed",
                "message" => "Category not Created"
            );
        }

        return json_encode($response);
    }

    public function filterRating($payload){
        $products = [];

        $result = $this->db->select("*")->from("product")->where("product_id", $payload->productid)->get();

        foreach ($result->result() as $value) {
        
            $rating = $this->db->select_avg("rating")->from("feedback")->where("product_id", $value->product_id)->get();
            if ($payload->rating != "all") {
                $feedback = $this->db->select("*")->from("feedback")->join("transaction", "feedback.transaction_id = transaction.transaction_id")->join("user_info", "transaction.email = user_info.email")->where("feedback.product_id", $value->product_id)->where("feedback.rating", $payload->rating)->get();
            }else {
                $feedback = $this->db->select("*")->from("feedback")->join("transaction", "feedback.transaction_id = transaction.transaction_id")->join("user_info", "transaction.email = user_info.email")->where("feedback.product_id", $value->product_id)->get();
            }

            $value->rating = $rating->result()[0]->rating ? $rating->result()[0]->rating : null;
            $value->feedback = $feedback->result() ? $feedback->result()  : null;
            
            $products[] = $value;
        }

        if ($result->num_rows() > 0) {
            $response = array(
                "status" => "Success",
                "message" => "Fetch Success",
                "response" => $products
            );

            return json_encode($response);
        }

        $response = array(
            "status" => "Failed",
            "message" => "Fetch Failed"
        );

        return json_encode($response);
    }
}