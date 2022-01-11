<?php defined("BASEPATH") OR exit("No direct script access allowed");

class BuyerModel extends CI_Model{

    public function getBuyerInfo($payload){
        if (isset($payload)) {
            $result = $this->db->select("user_info.first_name,user_info.last_name, user_info.email, user_address.address")->from("user_info")->join("user_address", "user_info.email = user_address.email")->where('user_info.email',$payload->email)->get();

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
