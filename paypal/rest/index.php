<?php
$subData = [
                'item' => [
                    'id' => 1,
                    'amount' => 20,
                    'name' => 'T-Shirt'
                ],
                'user' => [
                    'id' => 1,
                    'firstName' => 'Ugochukwu',
                    'lastName' => 'Ugochukwu',
                    'email' => 'ekwuemeugochukwu83@gmail.com'
                ]
            ];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paypal Integration Test</title>
</head>

<body>

    <form class="paypal" action="payments.php" method="post" id="paypal_form">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="lc" value="UK" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" name="first_name" value="<?php echo $subData['user']['id']; ?>" />
        <input type="hidden" name="last_name" value="<?php echo $subData['user']['id']; ?>" />
        <input type="hidden" name="payer_email" value="<?php echo $subData['user']['email']; ?>" />
        <input type="hidden" name="item_number" value="123456" />
        <input type="hidden" name="item_id" value="<?php echo $subData['item']['id']; ?>" />
        <input type="submit" name="submit" value="Submit Payment" />
    </form>

</body>

</html>