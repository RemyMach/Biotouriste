<?

use Stripe\PaymentIntent;
use Stripe\Stripe;


Stripe::setApiKey('sk_test_29f8IED2htzibLtmaXU9Xwz0004BcqvvUT');

$intent = PaymentIntent::create([
'amount' => 50,
'currency' => 'eur',
]); ?>