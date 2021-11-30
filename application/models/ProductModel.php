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
        if (isset($payload)) {
            $result = $this->db->select("*")->from("product")->where("featured", $payload->featured)->get();
        }else{
            $result = $this->db->select("*")->from("product")->get();
        }
        
        
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

    public function addToCart($payload){

        if (isset($payload)){
            $product= array(
                "email" => $payload->email,
                "product_id" => $payload->productId,
                "quantity" => $payload->quantity,
                "price" => $payload->price
            );
            $query = $this->db->query("select product_id, quantity, email from cart where product_id = $payload->productId");
            if($query->num_rows() > 0 && isset($payload->deleteItem)){
                $this->db->where('product_id', $payload->productId);
                $this->db->where('email', $payload->email);
                $this->db->delete('cart');
            }
            elseif($query->num_rows() > 0 && !isset($payload->deleteItem)){

                if($query->num_rows() > 0 && !isset($payload->decreaseQuantity)){
                    $this->db
                        ->set('quantity', 'quantity+1', FALSE)
                        ->where('product_id', $payload->productId)
                        ->update('cart');
                }
                elseif($query->num_rows() > 0 && isset($payload->decreaseQuantity)){
                    $this->db
                        ->set('quantity', 'quantity-1', FALSE)
                        ->where('product_id', $payload->productId)
                        ->update('cart');
                }
                
            }
            else{
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

    public function updateProduct($payload){
        if (isset($payload)) {
            $product = array(
                "product_name" => $payload->productName,
                "image" => $payload->imagePath,
                "price" => $payload->price,
                "stocks" => $payload->stocks,
                "description" => $payload->description,
                "email" => $payload->email,
                "modified_date" => $payload->modifiedDate,
                "category" => $payload-> category,
                "featured" => $payload-> featured
            );

            $this->db->set($product);
            $this->db->where('product_id', $payload->productId);
            $this->db->update('product'); 

            $response = array(
                "status" => "Success",
                "message" => "Product Updated"
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
