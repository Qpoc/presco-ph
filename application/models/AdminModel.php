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
            "message" => $payload_post['category_text'],
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

    public function updateCategory($payload, $payload_post){
        $db_img_path_icon = isset($payload['category_icon']) ? $this->uploadCategoryIcon($payload) : null;
        $db_img_path_bg = isset($payload['category_bg']) ? $this->uploadCategorybg($payload) : null;

        $result = $this->db->select("category_icon, category_bg")->from("category")->where("category_type", $payload_post['category_type_key'])->where("category_name", $payload_post['category_name_key'])->get();


        $db_img_path_icon ? unlink($result->result()[0]->category_icon) : $db_img_path_icon;
        $db_img_path_bg ? unlink($result->result()[0]->category_bg) : $db_img_path_bg;
        
        $category = array(
            "category_type" => $payload_post['category_type'],
            "category_name" => $payload_post['category_name'],
            "category_icon" => $db_img_path_icon ? $db_img_path_icon : $result->result()[0]->category_icon,
            "category_bg" => $db_img_path_bg ? $db_img_path_bg : $result->result()[0]->category_bg
        );

        $this->db->trans_begin();

        $this->db->set($category);
        $this->db->where("category_type", $payload_post['category_type_key'])->where("category_name", $payload_post['category_name_key']);
        $this->db->update('category');

        $product_category = array(
            "category_type" => $payload_post['category_type'],
            "category_name" => $payload_post['category_name']
        );

        $this->db->set($product_category);
        $this->db->where("category_type", $payload_post['category_type_key'])->where("category_name", $payload_post['category_name_key']);

        $this->db->update('product');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            $response = array(
                "status" => "Success",
                "message" => "Category Created"
            );

            return json_encode($response);
        }
        

        $response = array(
            "status" => "Failed",
            "message" => "Category not Created"
        );
    
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

    public function getTransactionStatus(){
        $result = $this->db->select("*")->from("tracking")->join("transaction", "tracking.transaction_id =  transaction.transaction_id")->join("transaction_product", "tracking.transaction_id = transaction_product.transaction_id")->join("product", "transaction_product.product_id = product.product_id")->join("user_info", "transaction.email = user_info.email")->join("user_address", "transaction.email = user_address.email")->where("tracking.status !=", "5")->where("tracking.status !=", "6")->group_by("tracking.tracking_id")->get();
        
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

    public function getCompleteTransaction(){
        $result = $this->db->select("*")->from("tracking")->join("transaction", "tracking.transaction_id =  transaction.transaction_id")->join("transaction_product", "tracking.transaction_id = transaction_product.transaction_id")->join("product", "transaction_product.product_id = product.product_id")->join("user_info", "transaction.email = user_info.email")->join("user_address", "transaction.email = user_address.email")->where("tracking.status", "5")->or_where("tracking.status", "6")->group_by("tracking.tracking_id")->get();
        
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

    public function updateCustomerStatus($payload){
        $data = array(
            'status' => $payload->status
        );
    
        $this->db->where('tracking_id', $payload->tracking_id);
        $this->db->update('tracking', $data);
   
    }

    public function getTrackingInformation($payload){
        $result = $this->db->select("*")->from("tracking")->join("transaction", "tracking.transaction_id = transaction.transaction_id")->join("transaction_product", "transaction.transaction_id = transaction_product.transaction_id")->join("product", "transaction_product.product_id = product.product_id")->where("tracking.tracking_id" , $payload->tracking_id)->get();

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

    public function getMonthlySales($payload){
        $result = $this->db->select("*")->from("transaction")->join('tracking', 'transaction.transaction_id = tracking.transaction_id')->where('tracking.status', 5)->where('MONTH(transaction.created_date)', date('m'))->where("YEAR(transaction.created_date)", date('Y'))->get();

        $result2 = $this->db->select("*")->from("transaction")->join('tracking', 'transaction.transaction_id = tracking.transaction_id')->where('tracking.status', 5)->where('MONTH(transaction.created_date)', date('m'))->where('DAY(transaction.created_date)', date('d'))->where("YEAR(transaction.created_date)", date('Y'))->get();

        $result3 = $this->db->select("COUNT(*)")->from('user_info')->get();

        $result4 = $this->db->select("*")->from("transaction")->join('tracking', 'transaction.transaction_id = tracking.transaction_id')->where('tracking.status', 5)->where("YEAR(transaction.created_date)", date('Y'))->get();

        if ($result->num_rows() > 0) {
            $response = array(
                "status" => "Success",
                "message" => "Fetch Success",
                "response" => $result->result(),
                "daily_income" => $result2->num_rows() > 0 ? $result2->result() : null,
                "num_of_user" => $result3->result(),
                "chart_data" => $result4->result()
            );

            return json_encode($response);
        }

        $response = array(
            "status" => "Failed",
            "message" => "Fetch Failed"
        );

        return json_encode($response);
    }

    public function getProductSales(){
        $result = $this->db->select("*")->from("product")->join("transaction_product", "product.product_id = transaction_product.product_id")->join("tracking", "transaction_product.transaction_id = tracking.transaction_id")->where("tracking.status", 5)->get();

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

    public function getProductNoSales(){
        $result = $this->db->select("*")->from("product")->join("transaction_product", "product.product_id = transaction_product.product_id", 'left')->where("transaction_product.product_id IS NULL")->get();

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

    public function banBuyer($payload){

        $this->db->trans_begin();

        $buyer = array(
            "ban" => $payload->ban,
        );

        $this->db->set($buyer);
        $this->db->where("email", $payload->email);

        $this->db->update('user_info');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            $response = array(
                "status" => "Success",
                "message" => "Ban successfully"
            );

            return json_encode($response);
        }
        

        $response = array(
            "status" => "Failed",
            "message" => "An error occurred"
        );
    
        return json_encode($response);
    }
}
