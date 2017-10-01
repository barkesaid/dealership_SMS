<!--ignore this-->
<?php
 $from = $_POST['from'];
 $to = $_POST['to'];
 $text = $_POST['text'];
 $date = $_POST['date'];
 $id = $_POST['id'];
 $linkId = $_POST['linkId'];

 if (isset($_POST['from'])){
//Using the Africa's talking API
require_once('AfricasTalkingGateway.php');
$username   = "Barkesaid";
$apikey     = "2c569991d3cef6e61e71bf2aeabc083b606100d889d30248541623b023e81ac2";
$recipients = $from;
$message = "Your Balance:Ksh.$recipients and is due on 5/5/2017.\nKindly make your instalments through this mpesa number:+254700138215,under the name: Barke Said.\nOr at Equity Bank account no:1452147896,use your car registration number as a reference.";
$gateway    = new AfricasTalkingGateway($username, $apikey);
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}

}