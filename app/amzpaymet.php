<?php 
namespace PayWithAmazon;

$config = array(
    'merchant_id'   => 'YOUR_MERCHANT_ID',
  'access_key'   => 'YOUR_ACCESS_KEY',
  'secret_key'   => 'YOUR_SECRET_KEY',
  'client_id'   => 'YOUR_LOGIN_WITH_AMAZON_CLIENT_ID',
  'region'   => 'us',
  'sandbox'   => true
);

$client = new Client($config);

// Also you can set the sandbox variable in the config() array of the Client class by

$client->setSandbox(true);