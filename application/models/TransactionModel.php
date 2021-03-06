<?php defined('BASEPATH') OR exit("No direct script access allowed");

class TransactionModel extends CI_Model{

    public function transaction($payload){
        if (isset($payload)){
            $transaction = array(
                "email" => $payload->email,
                "product_id" => $payload->productId,
                "price"=> $payload->price,
                "delivery_fee" => $payload->delFee,
                "total_price"=> $payload->totalPrice  
            );

            $this->db->insert('transaction', $transaction);

            $response = array(
                "status" => "Success",
                "message" => "Transaction Created"
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

    public function getTransaction($payload){
        if (isset($payload)) {
            $result1 = $this->db->select("transaction_id")->where('transaction_id',$payload->transactionId)->from("transaction")->get();
            $result2 = $this->db->select("first_name,last_name")->where('transaction_id',$payload->transactionId)->from("user_info")->join("transaction","transaction.email = user_info.email")->get();
            if ($result1->num_rows() > 0) {
                $response = array(
                    "status" => "Success",
                    "message" => "Fetch Success",
                    "response" => $result1->result()
                );

                return json_encode($response);
            }

            if ($result2->num_rows() > 0) {
                $response = array(
                    "status" => "Success",
                    "message" => "Fetch Success",
                    "response" => $result2->result()
                );

                return json_encode($response);
            }
        }
        else{
            $response = array(
                "status" => "Failed",
                "message" => "Fetch Failed"
            );
            return json_encode($response);
        }
        
    }

    public function tracKing($payload){
        if (isset($payload)){
            $progression = array(

               "status" => $payload->status,
               "transaction_id" => $payload->transactionId
            );

            $this->db->insert('tracking', $progression);

            $response = array(
                "status" => "Success",
                "message" => "Tracker Created"
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

    public function getTracking($payload){
        if (isset($payload)){
          
            $result = $this->db->select("tracking.tracking_id, product.product_name, transaction.total_price, transaction.created_date, transaction.delivery_fee, transaction.price, tracking.status, product.image, transaction_product.quantity")->from("transaction")->join('tracking', 'transaction.transaction_id = tracking.transaction_id')->join("transaction_product", "transaction.transaction_id = transaction_product.transaction_id")->join("product", "transaction_product.product_id = product.product_id")->where("transaction.email", $payload->email)->get();


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
}