<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewController extends CI_Controller{
    
    public function getProductsToReview(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ReviewModel->getProductsToReview($payload);
    }

    public function submitReview(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ReviewModel->submitReview($payload);
    }

    public function filterRating(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ReviewModel->filterRating($payload);
    }

    public function getHistoryReview(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ReviewModel->getHistoryReview($payload);
    }

    public function editReview(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->ReviewModel->editReview($payload);
    }


}