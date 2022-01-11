<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pages/index';

// stripe
$route['make-stripe-payment'] = "StripePaymentController";
$route['handleStripePayment']['post'] = "StripePaymentController/handlePayment";

$route['admin'] = 'pages/indexAdmin';
$route['admin/(:any)'] = 'pages/viewAdmin/$1';
$route['account'] = 'pages/indexViewProfile/';
$route['account/(:any)'] = 'pages/viewProfile/$1';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;