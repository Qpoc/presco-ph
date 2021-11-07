<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionController extends CI_Controller{

    public function tranSaction(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->TransactionModel->tranSaction($payload);
    }

    public function tracKing(){
        $payload = json_decode(file_get_contents("php://input"));
        echo $this->TransactionModel->tracKing($payload);
    }
}