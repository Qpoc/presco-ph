<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Userauthmodel extends CI_Model {
    
    public function registerUser($payload){
        
        if (isset($payload)) {
            $useraccount = array(
                'username' => $payload->username,
                'password' => hash("sha256", $payload->password)
            );
    
            $this->db->insert('user_account', $useraccount);
    
            $userinfo = array(
                'full_name' => $payload->fullName,
                'birthdate' => $payload->birthDate,
                'gender' => $payload->gender,
                'email' => $payload->email,
                'username' => $payload->username,
            );
    
            $this->db->insert('user_info', $userinfo);

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

    public function verifyLogin($payload){
        if (isset($payload)) {
            $result = $this->db->select("user_account.username, user_account.password, user_info.full_name")->from("user_account")->join("user_info", "user_account.username = user_info.username")->where("user_account.username", $payload->username)->where("user_account.password", hash("sha256", $payload->password))->get();
            
            $result = $result->result();
            $isLogin = false;

            if (count($result) > 0) {
    
                $response = array(
                    "status" => "Success",
                    "message" => "Login Successfully",
                );

                $isLogin = true;
            }else{
                $result = $this->db->select("user_info.email, user_account.password, user_info.full_name")->from("user_account")->join("user_info", "user_account.username = user_info.username")->where("user_info.email", $payload->username)->where("user_account.password", hash("sha256", $payload->password))->get();
                $result = $result->result();

                if (count($result)) {
                    $response = array(
                        "status" => "Success",
                        "message" => "Login Successfully",
                    );
    
                    $isLogin = true;
                }else {
                    $response = array(
                        "status" => "Failed",
                        "message" => "Login Failed",
                    );
                }

            }

            if ($isLogin) {

                foreach ($result as $row) {
                    $name = $row->full_name;
                }
                
                $_SESSION['user'] = $name;
                $_SESSION['session_id'] = hash("sha256",uniqid());
            }

            return json_encode($response);
        }else {
            $response = array(
                "status" => "Failed",
                "message" => "Missing payload"
            );

            return json_encode($response);
        }
    }

    public function verifyLogout(){
        if (isset($_SESSION['session_id']) && isset($_SESSION['user'])) {
            session_destroy();
        }
    }
}


