<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51L2fFOGtEk5In1sSpQr6hhdVLYAkAIo4n1Ti1rBuyZ83QuBalB8c5Hl974lkSa5SV4bgJm6RmPZ1IKdkSIKYA5HS00Mm2BsF6o";

$secretKey="sk_test_51L2fFOGtEk5In1sSYpcrkjWFD2OcuUmoR2pHJh9tmZ9LygnZhsaoVGEfl7Cx3hMlMUCmQfkYdJjuGCt5nWcaX5cy00fpdP6PIi";

\Stripe\Stripe::setApiKey($secretKey);
?>