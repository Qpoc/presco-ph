<?php defined('BASEPATH') OR exit('No direct script access allowed');

class FeedBackController extends CI_Controller {

    public function feedBack(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->FeedBackModel->feedBack($payload);
    }

    public function adminReply(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->FeedBackModel->adminReply($payload);
    }
}