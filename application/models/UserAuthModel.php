<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Userauthmodel extends CI_Model {
    
    public function registerUser($payload){
        
        if (isset($payload)) {
            $this->db->trans_begin();
            
            $useraccount = array(
                'username' => $payload->username,
                'password' => hash("sha256", $payload->password)
            );
    
            $this->db->insert('user_account', $useraccount);
    
            $userinfo = array(
                'first_name' => $payload->firstName,
                'last_name' => $payload->lastName,
                'birthdate' => $payload->birthDate,
                'gender' => $payload->gender,
                'email' => $payload->email,
                'username' => $payload->username,
                'contact_number'=>$payload->contactNumber
            );
    
            $this->db->insert('user_info', $userinfo);

            $useraddress = array(
                
                'email' => $payload->email,
                'address' => $payload->address                
            );
            
            $this->db->insert('user_address', $useraddress);

            $response = array(
                "status" => "Success",
                "message" => "Account Created"
            );

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
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

    public function verifyLogin($payload){
        if (isset($payload)) {
            $result = $this->db->select("user_account.username, user_info.email, user_info.first_name, user_info.last_name")->from("user_account")->join("user_info", "user_account.username = user_info.username")->where("user_account.username", $payload->username)->where("user_account.password", hash("sha256", $payload->password))->get();
            
            $result = $result->result();
            $isLogin = false;

            if (count($result) > 0) {
    
                $response = array(
                    "status" => "Success",
                    "message" => "Login Successfully",
                );

                $isLogin = true;
            }else{
                $result = $this->db->select("user_info.email, user_info.first_name, user_info.last_name")->from("user_account")->join("user_info", "user_account.username = user_info.username")->where("user_info.email", $payload->username)->where("user_account.password", hash("sha256", $payload->password))->get();
                $result = $result->result();

                if (count($result)) {
                    $response = array(
                        "status" => "Success",
                        "message" => "Login Successfully",
                    );
    
                    $isLogin = true;
                }else {

                    $result = $this->db->select("first_name, last_name, email, username")->from("admin_account")->where("email", $payload->username)->where("password", hash("sha256", $payload->password))->or_where("username", $payload->username)->where("password", hash("sha256", $payload->password))->get();

                    $result = $result->result();

                    if (count($result) > 0) {
                        
                        $response = array(
                            "status" => "Success",
                            "message" => "Login Successfully",
                            "type" => "admin"
                        );
                        
                        foreach ($result as $row) {
                            $name = $row->first_name . " " . $row->last_name;
                        }

                        $_SESSION['user'] = $name;
                        $_SESSION['session_id'] = hash("sha256",uniqid());

                        return json_encode($response);
                    }else {
                        $response = array(
                            "status" => "Failed",
                            "message" => "Login Failed",
                        );

                        return json_encode($response);
                    }

                }
            }

            if ($isLogin) {

                foreach ($result as $row) {
                    $name = $row->first_name . " " . $row->last_name;
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

    public function updateUser($payload){
        if (isset($payload)) {
           
            
            $userAccount = array(
                'username' => $payload->newUsername,
                'password' => hash("sha256", $payload->password)
            );

            
            $this->db->set($userAccount);
            $this->db->where('username', $payload->username);
            $this->db->update('user_account'); 

            $userInfo = array(
                'first_name' => $payload->firstName,
                'last_name' => $payload->lastName,
                'birthdate' => $payload->birthDate,
                'gender' => $payload->gender,
                'email' => $payload->newEmail,
                'contact_number' => $payload->newContact
            );
           
            $this->db->set($userInfo);
            $this->db->where('email', $payload->email);
            $this->db->update('user_info'); 
            
            
            $userAddress = array(
                'email' => $payload->newEmail,
                'address' => $payload->newAddress
            );
            
            $this->db->set($userAddress);
            $this->db->where('email', $payload->email);
            $this->db->where('address',$payload->address);
            $this->db->update('user_address'); 

            $response = array(
                "status" => "Success",
                "message" => "user info Updated"
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

    public function verifyLogout(){
        if (isset($_SESSION['session_id']) && isset($_SESSION['user'])) {
            session_destroy();
            $response = array(
                "status" => "Success",
                "message" => "Log out successfully"
            );

            return json_encode($response);
        }
    }
}


