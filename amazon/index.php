<?php 
include('../app/vendor/autoload.php');
//echo 'SDK_VERSION: ' . Amazon\Pay\API\Client::SDK_VERSION . '/n';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Pay</title>
    <script type='text/javascript'>
        window.onAmazonLoginReady = function() {
        amazon.Login.setClientId('CLIENT-ID');
        };
        window.onAmazonPaymentsReady = function() {
                    showButton();
        };
    </script>
        <script async="async" src='https://static-na.payments-amazon.com/OffAmazonPayments/us/sandbox/js/Widgets.js'>
  </script>
</head>
<body>
<div id="AmazonPayButton">
</div>
...
<script type="text/javascript">
  function showButton(){
    var authRequest; 
    OffAmazonPayments.Button("AmazonPayButton", "SELLER-ID", { 
      type:  "PwA", 
      color: "gold", 
      size:  "small", 

      authorization: function() { 
      loginOptions = {scope: "SCOPES", 
        popup: "POPUP-PARAMETER"}; 
      authRequest = amazon.Login.authorize (loginOptions, 
        "REDIRECT-URL"); 
      } ,
      onError: function(error) { 
          // your error handling code.
          alert("The following error occurred: " 
                  + error.getErrorCode() 
                  + ' - ' + error.getErrorMessage());
        }
   }); 
  }
</script>
. . .
   <script type="text/javascript">
     document.getElementById('Logout').onclick = function() {
       amazon.Login.logout();
     };
   </script>
</body>
</html>