<?php
    #payment
    if (isset($_GET['payment'])) {

        $curl = curl_init();
        $customer_email = 'ekwuemeugochukwu83@gmail.com';
        $amount = '10000';  
        $currency = "NGN";
        $txref = "rave-" . bin2hex(time()); // ensure you generate unique references per transaction.
        $PBFPubKey = "FLWPUBK-9de0785d520c4849b81f21e1c32ffc28-X"; // get your public key from the dashboard.
        $redirect_url = 'https://storelad.com/payment/flutterwave/?txref';

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'amount'=>$amount,
            'customer_email'=>$customer_email,
            'currency'=>$currency,
            'txref'=>$txref,
            'PBFPubKey'=>$PBFPubKey,
            'redirect_url'=>$redirect_url
        ]),
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "cache-control: no-cache"
        ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            die('Curl returned error: ' . $err);
        }

        $transaction = json_decode($response);

        if(!$transaction->data && !$transaction->data->link){
            print_r('API returned error: ' . $transaction->message);
        }

        header('Location: ' . $transaction->data->link);
    }

    #validate
    if (isset($_GET['txref'])) {
        $ref = $_GET['txref'];
        $amount = '10000'; //Correct Amount from Server
        $currency = "NGN"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK-e351ac7c21cee96cf945c0261c06f585-X",
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            //Give Value and return to Success page
            header('location: https://storelad.com/payment/flutterwave/index.php?success');
            exit();
        } else {
            //Dont Give Value and return to Failure page
            header('location: https://storelad.com/payment/flutterwave/index.php?fail');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flutterwave</title>
    <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/latest/css/bootstrap.min.css">
</head>
<body style="background-color: #eeeeee;">
    <div class="container text-center">
        <div class="row" style="height: 100vh;">
            <?php if(isset($_GET['fail'])):?>
                <div class="col-md-4 col-12 mx-auto my-auto">
                    <a href="?payment"class="btn btn-info">Pay NGN 10, 0000</a><br>
                    <small class="text-danger">*Payment Failed</small><br>
                    <small class="text-danger">*Pay with Flutter Wave Secured Payment system</small>
                </div>
            <?php elseif(isset($_GET['success'])):?>
                <div class="col-md-4 col-12 mx-auto my-auto">
                    <a href="?payment"class="btn btn-success">Pay Again</a><br>
                    <small class="text-success">*Payment Success</small><br>
                    <small class="text-success">*Pay with Flutter Wave Secured Payment system</small>
                </div>
            <?php else:?>
                <div class="col-md-4 col-12 mx-auto my-auto">
                    <a href="?payment"class="btn btn-info">Pay NGN 10, 0000</a><br>
                    <small class="text-warning">*Pay with Flutter Wave Sercured Payment system</small>
                </div>
            <?php endif;?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script async="async" src='https://cdn.usebootstrap.com/bootstrap/latest/js/bootstrap.min.js'></script>
    <script async="async" src='https://cdn.usebootstrap.com/bootstrap/latest/js/bootstrap.bundle.min.js'></script>
</body>
</html>