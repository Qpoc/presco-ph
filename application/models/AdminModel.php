<?php defined("BASEPATH") OR exit("No direct script access allowed");

class AdminModel extends CI_Model{


    public function registerAdmin($payload){
        if (isset($payload)) {
            $admin = array(
                "first_name" => $payload->firstName,
                "last_name" => $payload->lastName,
                "email" => $payload->email,
                "username" => $payload->username,
                "password" => hash("sha256", $payload->password)
            );

            $this->db->insert("admin_account", $admin);

            $response = array(
                "status" => "Success",
                "message" => "Account Created"
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
