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

    public function addCategory($payload, $payload_post){
        $db_img_path_icon = $this->uploadCategoryIcon($payload);
        $db_img_path_bg = $this->uploadCategorybg($payload);

        $category = array(
            "category_type" => $payload_post['category_type'],
            "category_name" => $payload_post['category_name'],
            "category_icon" => $db_img_path_icon,
            "category_bg" => $db_img_path_bg
        );

        if ($this->db->insert("category", $category)) {
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

    public function uploadCategoryIcon($payload){
        if (isset($payload['category_icon']) == false) {
            $payload['category_icon'] = null;
            $db_img_path_icon = null;
        }else if(isset($payload['category_icon'])){
            $img_name = $payload['category_icon']['name'];
            $extension = explode('.', $img_name);
            $act_extension = strtolower(end($extension));
            $allowed_ext = array("jpeg", "jpg", "png");
            $tmp_name = $payload['category_icon']['tmp_name'];
            $error = $payload['category_icon']['error'];
            $size = $payload['category_icon']['size'];

            $image_name_new = uniqid('') . '.' . $act_extension;
            $db_img_path_icon = "uploads/categories/category_icon/" . $image_name_new;

            $config['upload_path'] = 'uploads/categories/category_icon';
            $config['file_name'] = $image_name_new;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 2000000;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if(!$this->upload->do_upload('category_icon')){
                echo($this->upload->display_errors());//validation error will be printed
            }

        }
        return $db_img_path_icon;
    }

    public function uploadCategorybg($payload){
        if (isset($payload['category_bg']) == false) {
            $payload['category_bg'] = null;
            $db_img_path_bg = null;
        }else if(isset($payload['category_bg'])){
            $img_name = $payload['category_bg']['name'];
            $extension = explode('.', $img_name);
            $act_extension = strtolower(end($extension));
            $allowed_ext = array("jpeg", "jpg", "png");
            $tmp_name = $payload['category_bg']['tmp_name'];
            $error = $payload['category_bg']['error'];
            $size = $payload['category_bg']['size'];

            $image_name_new = uniqid('') . '.' . $act_extension;
            $db_img_path_bg = "uploads/categories/category_type/" . $image_name_new;

            $config['upload_path'] = 'uploads/categories/category_type';
            $config['file_name'] = $image_name_new;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 2000000;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('category_bg')){
                echo($this->upload->display_errors());//validation error will be printed
            }
        }

        return $db_img_path_bg;
    }

    public function getCategory(){
        $result = $this->db->select("*")->from("category")->get();
        
        if ($result->num_rows() > 0) {
            $response = array(
                "status" => "Success",
                "message" => "Fetch Success",
                "response" => $result->result()
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
