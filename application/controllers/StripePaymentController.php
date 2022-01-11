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
         require_once('application/libraries/stripe-php/init.php');
     
         \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
      
         \Stripe\Charge::create ([
                 "amount" => $this->input->post('total') * 100,
                 "currency" => "php",
                 "source" => $this->input->post('stripeToken'),
                 "description" => "Dummy stripe payment." 
         ]);
             
         $this->session->set_flashdata('success', 'Payment has been successful.');
              
         redirect('/checkout', 'refresh');
     }
}