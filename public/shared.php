<?php

use \Stripe\Stripe;
require '../vendor/autoload.php';

header('Content-Type: application/json');


// Make sure the configuration file is good.
if (!$config) {
	http_response_code(500);
	echo json_encode([ 'error' => 'Internal server error.' ]);
	exit;
}

Stripe::setApiKey($config['sk_test_29f8IED2htzibLtmaXU9Xwz0004BcqvvUT']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$input = file_get_contents('php://input');
	$body = json_decode($input);	
}

if (json_last_error() !== JSON_ERROR_NONE) {
	http_response_code(400);
	echo json_encode([ 'error' => 'Invalid request.' ]);
	exit;
}
