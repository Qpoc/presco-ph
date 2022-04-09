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
                "description" => "Presco PH payment." 
            ]);
        }
             
        $this->session->set_flashdata('success', "We've receive your order and will send you an email confirmation regarding to your transaction. Check your spam folder message if it does not appear in your inbox message. Thank you for choosing PRESCO PH!");

        $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
        $transactionid = substr(uniqid(str_shuffle($combiStr)), 3 , 9) . time();

        $transaction = array(
            "transaction_id" => $transactionid,
            "email" => $this->input->post('email'),
            "price" => $this->input->post('subTotal'),
            "delivery_fee" => $this->input->post('deliveryFee'),
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

        $this->load->library('email');
        $mail_config['smtp_host'] = 'smtp.gmail.com';
        $mail_config['smtp_port'] = '587';
        $mail_config['smtp_user'] = 'phpresco@gmail.com';
        $mail_config['_smtp_auth'] = TRUE;
        $mail_config['smtp_pass'] = 'prescoph!';
        $mail_config['smtp_crypto'] = 'tls';
        $mail_config['protocol'] = 'smtp';
        $mail_config['mailtype'] = 'html';
        $mail_config['send_multipart'] = FALSE;
        $mail_config['charset'] = 'utf-8';
        $mail_config['wordwrap'] = TRUE;

        $this->email->set_newline("\r\n");
   
        $this->email->initialize($mail_config);

        $this->email->from('info@mail.presco.ph', 'PRESCO PH');
        $this->email->to($this->input->post('email'));
        $modePayment = $this->input->post('modePayment') == 1 ? "Cash on delivery" : "Credit/Debit Card";
        $this->email->subject('Your order has been placed');
        $this->email->message('<strong>Dear ' . $this->input->post('first_name') . '</strong><br><br>Thank you so much for purchasing with <strong>PRESCO PH.</strong> Your order is being prepared and packed with loving care. We know you had a lot of options, it makes us feel special that you decided to go with us. <br><br> Let us know if we can do anything to make your experience better!<br><br><strong>Thanks again,<br>
        The PRECO PH Team</strong><br><br>
        Summary:<br><strong>Tracking no: </strong>' . $trackingid . "<br> <strong>Subtotal: </strong>" . $this->input->post('subTotal') . "<br><strong>Delivery Fee: </strong>" . $this->input->post('deliveryFee') . "<br><strong>Total: </strong>" . $this->input->post('total') . "<br><strong>Mode of Payment: </strong>" . $modePayment);

        
        if (!$this->email->send()) {
            return json_encode($this->email->print_debugger());
        }
        
        redirect('/checkout', 'refresh');

        $response = array(
            "status" => "Success",
            "message" => "Transaction Created"
        );

        
        return json_encode($response);
     }
}