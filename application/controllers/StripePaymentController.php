<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class StripePaymentController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
     }
     
     public function index()
     {
         $this->load->view('pages/checkout');
     }
 
     public function handlePayment()
     {
        if ($this->input->post('modePayment') == "2" || $this->input->post('modePayment') == 2) {
            require_once('application/libraries/stripe-php/init.php');
     
            \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        
            \Stripe\Charge::create ([
                    "amount" => $this->input->post('total') * 100,
                    "currency" => "php",
                    "source" => $this->input->post('stripeToken'),
                    "description" => "Dummy stripe payment." 
            ]);
        }
             
        $this->session->set_flashdata('success', 'Payment has been successful.');

        $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
        $transactionid = substr(uniqid(str_shuffle($combiStr)), 3 , 9) . time();

        $transaction = array(
            "transaction_id" => $transactionid,
            "email" => $this->input->post('email'),
            "total_price" => $this->input->post('total'), 
            "mode_payment" => $this->input->post('modePayment')
        );

        $this->db->insert('transaction', $transaction);

        $trackingid = substr(uniqid(str_shuffle($combiStr)), 3 , 9) . time();

        $tracking = array(
            "tracking_id" => $trackingid,
            "transaction_id" => $transactionid,
            "status" => 1, 
        );

        $this->db->insert('tracking', $tracking);

        $products = $this->input->post('productsid');
        $quantities = $this->input->post('productQuantity');

        for ($i = 0; $i < count($products); $i++) { 
            $transaction_product = array(
                "product_id" => $products[$i],
                "transaction_id" => $transactionid,
                "quantity" => $quantities[$i]
            );
    
            $this->db->insert('transaction_product', $transaction_product);
        }

        redirect('/checkout', 'refresh');

        $response = array(
            "status" => "Success",
            "message" => "Transaction Created"
        );
        
        return json_encode($response);
     }
}