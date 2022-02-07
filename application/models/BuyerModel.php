<?php defined("BASEPATH") OR exit("No direct script access allowed");

class BuyerModel extends CI_Model{

    public function getBuyerInfo($payload){
        if (isset($payload)) {
            $result = $this->db->select("user_info.first_name,user_info.last_name, user_info.email, user_info.gender, user_info.contact_number, user_info.birthdate, user_address.address")->from("user_info")->join("user_address", "user_info.email = user_address.email")->where('user_info.email',$payload->email)->get();

            if ($result->num_rows() > 0) {
                $response = array(
                    "status" => "Success",
                    "message" => "Fetch Success",
                    "response" => $result->result()
                );
            }else {
                $response = array(
                    "status" => "Failed",
                    "message" => "No Data",
                    "response" => $result->result()
                );
            }
            return json_encode($response);
        }else{
            $response = array(
                "status" => "Failed",
                "message" => "Fetch Failed"
            );
            return json_encode($response);
        }
    }

    public function getBuyerList(){
      
        $result = $this->db->select("user_info.first_name,user_info.last_name, user_info.ban, user_info.email, user_info.gender, user_info.contact_number, user_info.birthdate, user_address.address")->from("user_info")->join("user_address", "user_info.email = user_address.email")->get();

        if ($result->num_rows() > 0) {
            $response = array(
                "status" => "Success",
                "message" => "Fetch Success",
                "response" => $result->result()
            );
        }else {
            $response = array(
                "status" => "Failed",
                "message" => "No Data",
                "response" => $result->result()
            );
        }
        return json_encode($response);
    }

    public function cancelOrder($payload){
        if (isset($payload)) {

            $tracking = array(
                "status" => 6,
                "modified_date" => date("Y-m-d H:i:s")
            );

            $this->db->trans_begin();

            $this->db->set($tracking);
            $this->db->where("tracking_id", $payload->tracking_id);
            $this->db->update("tracking");

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                $response = array(
                    "status" => "Failed",
                    "message" => "An error occurred while canceling your order."
                );
            }else {
                $this->db->trans_commit();

                $response = array(
                    "status" => "Success",
                    "message" => "You successfully cancel your order."
                );
            }

            return json_encode($response);
        }
    }
   
    public function listCancel($payload){
        if (isset($payload)) {
            $result = $this->db->select("*")->from("product")->join("transaction_product", "product.product_id = transaction_product.product_id")->join("tracking", "transaction_product.transaction_id = tracking.transaction_id")->join("transaction", "transaction_product.transaction_id = transaction.transaction_id")->where("transaction.email", $payload->email)->where("tracking.status", 6)->get();

            if ($result->num_rows() > 0) {
                $response = array(
                    "status" => "Success",
                    "message" => "Fetch Success",
                    "response" => $result->result()
                );
            }else {
                $response = array(
                    "status" => "Failed",
                    "message" => "No Data",
                    "response" => $result->result()
                );
            }
            return json_encode($response);
        }else{
            $response = array(
                "status" => "Failed",
                "message" => "Fetch Failed"
            );
            return json_encode($response);
        }
    }

    public function searchProduct($payload){
        if (isset($payload)) {
            $result = $this->db->select("*")->from("product")->like("product_name",  $payload->product_name)->get();

            if ($result->num_rows() > 0) {
                $response = array(
                    "status" => "Success",
                    "message" => "Fetch Success",
                    "response" => $result->result()
                );
            }else {
                $response = array(
                    "status" => "Failed",
                    "message" => "No Data",
                    "response" => $result->result()
                );
            }
            return json_encode($response);
        }else{
            $response = array(
                "status" => "Failed",
                "message" => "Fetch Failed"
            );
            return json_encode($response);
        }
    }
}
