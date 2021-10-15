<?php

namespace Sample;

require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

require('payment.php');
$orderID = $_GET['orderId'];
function dd($value) { // to be deleted
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

class GetOrder
{

  // 2. Set up your server to receive a call from the client
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {

    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();
    $response = $client->execute(new OrdersGetRequest($orderId));

    //get transaction details
    //dd($response);
    $orderID = $response->result->id;
    $email = $response->result->payer->email_address;
    $name = $response->result->purchase_units[0]->shipping->name->full_name;
    $address = $response->result->purchase_units[0]->shipping->address->address_line_1;
    
    //insert data to database
    require('database/db.php');

    $customer = create('customer_details', ['email' => $email, 'orderID' => $orderID, 'address' => $address, 'name' => $name]);
    if($customer){
        header('loaction: succ.php');
    }
  }
}

if (!count(debug_backtrace()))
{
  GetOrder::getOrder($orderID, true);
}
?>