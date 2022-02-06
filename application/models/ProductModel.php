<?php defined('BASEPATH') OR exit("No direct script access allowed");

class ProductModel extends CI_Model{
    
    public function addProduct($payload, $payload_post){

        if (isset($payload['imagePath'])) {
            $img_name = $payload['imagePath']['name'];
            $extension = explode('.', $img_name);
            $act_extension = strtolower(end($extension));
            $allowed_ext = array("jpeg", "jpg", "png");
            $tmp_name = $payload['imagePath']['tmp_name'];
            $error = $payload['imagePath']['error'];
            $size = $payload['imagePath']['size'];

            if (isset($payload) AND $error == 0 AND in_array($act_extension, $allowed_ext) AND $size <= 2000000) {

                $image_name_new = uniqid('') . '.' . $act_extension;
                $db_img_path = "uploads/products/" . $image_name_new;

                $config['upload_path'] = 'uploads/products/';
                $config['file_name'] = $image_name_new;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 2000000;

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('imagePath')){
                    echo($this->upload->display_errors());//validation error will be printed
                }

                $product = array(
                    "product_name" => $payload_post['productName'],
                    "image" => $db_img_path,
                    "price" => $payload_post['price'],
                    "stocks" => $payload_post['stocks'],
                    "description" => $payload_post['description'],
                    "email" => $payload_post['email'],
                    "category_type" =>$payload_post['category_type'],
                    "category_name" =>$payload_post['category_name'],
                    "featured" =>$payload_post['featured']
                );
    
                $this->db->insert("product", $product);
    
                $response = array(
                    "status" => "Success",
                    "message" => "Product Created"
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

    public function getProduct($payload){
        $products = [];

        if (isset($payload->featured)) {
            $result = $this->db->select("*")->from("product")->where("featured", $payload->featured)->get();
         
            foreach ($result->result() as $value) {
            
                $rating = $this->db->select_avg("rating")->from("feedback")->where("product_id", $value->product_id)->get();
      
                $value->rating = $rating->result()[0]->rating ? $rating->result()[0]->rating : null;
                
                $products[] = $value;
            }
            
        }else if(isset($payload->productid)){
            $result = $this->db->select("*")->from("product")->where("product_id", $payload->productid)->get();

            foreach ($result->result() as $value) {
            
                $rating = $this->db->select_avg("rating")->from("feedback")->where("product_id", $value->product_id)->get();
                $feedback = $this->db->select("*")->from("feedback")->join("transaction", "feedback.transaction_id = transaction.transaction_id")->join("user_info", "transaction.email = user_info.email")->where("feedback.product_id", $value->product_id)->get();

                $this->db->where("feedback.product_id", $value->product_id)->where("feedback.rating", 1);
                $this->db->from('feedback');
                $star1 = $this->db->count_all_results();
                
                $this->db->where("feedback.product_id", $value->product_id)->where("feedback.rating", 2);
                $this->db->from('feedback');
                $star2 = $this->db->count_all_results();

                $this->db->where("feedback.product_id", $value->product_id)->where("feedback.rating", 3);
                $this->db->from('feedback');
                $star3 = $this->db->count_all_results();

                $this->db->where("feedback.product_id", $value->product_id)->where("feedback.rating", 4);
                $this->db->from('feedback');
                $star4 = $this->db->count_all_results();

                $this->db->where("feedback.product_id", $value->product_id)->where("feedback.rating", 5);
                $this->db->from('feedback');
                $star5 = $this->db->count_all_results();


                $stars = array(
                    $star5,
                    $star4,
                    $star3,
                    $star2,
                    $star1,
                );

                $value->rating = $rating->result()[0]->rating ? $rating->result()[0]->rating : null;
                $value->feedback = $feedback->result() ? $feedback->result()  : null;
                $value->stars = $stars;

                $products[] = $value;
            }
        }else{
            $result = $this->db->select("*")->from("product")->get();

            foreach ($result->result() as $value) {
            
                $rating = $this->db->select_avg("rating")->from("feedback")->where("product_id", $value->product_id)->get();
      
                $value->rating = $rating->result()[0]->rating ? $rating->result()[0]->rating : null;
                
                $products[] = $value;
            }
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

    public function addToCart($payload){

        if (isset($payload)){

            $product = array(
                "email" => $payload->email,
                "product_id" => $payload->productId,
                "quantity" => $payload->quantity,
                "price" => $payload->price
            );

            $query = $this->db->query("SELECT product_id, quantity FROM cart WHERE product_id = $payload->productId AND email = '$payload->email'");

            if($query->num_rows() > 0 && isset($payload->deleteItem)){
                $this->db->where('product_id', $payload->productId)->where('email', $payload->email);
                $this->db->delete('cart');
            }else if($query->num_rows() > 0 && !isset($payload->deleteItem)){
                if($query->num_rows() > 0 && !isset($payload->decreaseQuantity)){
                    $this->db->set('quantity', $payload->quantity, FALSE)->where('product_id', $payload->productId)->where('email', $payload->email)->update('cart');
                }
                elseif($query->num_rows() > 0 && isset($payload->decreaseQuantity)){
                    $this->db->set('quantity', $payload->quantity, FALSE)->where('product_id', $payload->productId)->where('email', $payload->email)->update('cart');
                }
                
            }else{
                $this->db->insert('cart', $product);
            }

            $response = array(
                "status" => "Success",
                "message" => "cart updated"
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

    public function getCart($payload){
        if (isset($payload)) {
            $result = $this->db->select("cart.product_id, cart.quantity, cart.price, cart.created_date, product.product_name, product.image, product.price, product.stocks")->from("cart")->join("product", "cart.product_id = product.product_id")->where('cart.email',$payload->email)->order_by("cart.created_date", "DESC")->get();
            
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

    public function updateProduct($payload, $payload_post){
        if (isset($payload['imagePath'])) {
            $img_name = $payload['imagePath']['name'];
            $extension = explode('.', $img_name);
            $act_extension = strtolower(end($extension));
            $allowed_ext = array("jpeg", "jpg", "png");
            $tmp_name = $payload['imagePath']['tmp_name'];
            $error = $payload['imagePath']['error'];
            $size = $payload['imagePath']['size'];

            if (isset($payload) AND $error == 0 AND in_array($act_extension, $allowed_ext) AND $size <= 2000000) {

                $image_name_new = uniqid('') . '.' . $act_extension;
                $db_img_path = "uploads/products/" . $image_name_new;

                $config['upload_path'] = 'uploads/products/';
                $config['file_name'] = $image_name_new;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 2000000;

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('imagePath')){
                    echo($this->upload->display_errors());//validation error will be printed
                }

                $result = $this->db->select("image")->from("product")->where("product_id", $payload_post["product_id"])->get();

                unlink($result->result()[0]->image);

                $product = array(
                    "product_name" => $payload_post['productName'],
                    "image" => $db_img_path,
                    "price" => $payload_post['price'],
                    "stocks" => $payload_post['stocks'],
                    "description" => $payload_post['description'],
                    "email" => $payload_post['email'],
                    "category_type" =>$payload_post['category_type'],
                    "category_name" =>$payload_post['category_name'],
                    "featured" =>$payload_post['featured']
                );
    
                $this->db->set($product);
                $this->db->where('product_id', $payload_post['product_id']);
                $this->db->update('product'); 
    
                $response = array(
                    "status" => "Success",
                    "message" => "Product Created"
                );
    
                return json_encode($response);
            }
        }else{  
            $product = array(
                "product_name" => $payload_post['productName'],
                "price" => $payload_post['price'],
                "stocks" => $payload_post['stocks'],
                "description" => $payload_post['description'],
                "email" => $payload_post['email'],
                "category_type" =>$payload_post['category_type'],
                "category_name" =>$payload_post['category_name'],
                "featured" =>$payload_post['featured']
            );

            $this->db->set($product);
            $this->db->where('product_id', $payload_post['product_id']);
            $this->db->update('product'); 

            $response = array(
                "status" => "Success",
                "message" => "Product Created"
            );

            return json_encode($response);
        }
        $response = array(
            "status" => "Failed",
            "message" => "Missing payload"
        );

        return json_encode($response);
    }

    public function loadShipping($productid){
        if (isset($productid)) {
            $result = $this->db->select("product.product_id, product.product_name, product.image, product.price, product.stocks")->from("product")->where('product.product_id',$productid)->get();

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

    public function getCategory(){
        $result = $this->db->select("*")->from("category")->get();
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

    public function getCategoryDetails($payload){
        $products = [];

        if (isset($payload)) {
            $result = $this->db->select("*")->from("product")->where('category_type', $payload->categoryType)->where('category_name', $payload->categoryName)->get();
            
            foreach ($result->result() as $value) {
            
                $rating = $this->db->select_avg("rating")->from("feedback")->where("product_id", $value->product_id)->get();
      
                $value->rating = $rating->result()[0]->rating ? $rating->result()[0]->rating : null;
                
                $products[] = $value;
            }

            if ($result->num_rows() > 0) {
                $response = array(
                    "status" => "Success",
                    "message" => "Fetch Success",
                    "response" => $products
                );
            }else {
                $response = array(
                    "status" => "Failed",
                    "message" => "No Data",
                    "response" => $products
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
