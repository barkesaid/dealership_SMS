<!-- this works,use this-->
<?php 

 $from = $_POST['from'];
 $to = $_POST['to'];
 $text = $_POST['text'];
 $date = $_POST['date'];
 $id = $_POST['id'];
 $linkId = $_POST['linkId'];
 

 if (isset($_POST['from'])){
   require_once ('db_connect.php');   
   require_once('db_functions.php');
   require_once('AfricasTalkingGateway.php');
   require_once('config.php');

//get the client id number using their phone number
$idno=getClientbyId($from);

//fetch customer name
$cname=getClientNamebyId($idno);

//select now the chasis number using the id number
$chasis= getChasisusingId($idno);

//get the due date for payment
$duedate=getInstallmentdate($chasis); 
$formatdate=date_create($duedate);
$printdate= date_format($formatdate,"d"); 

//select the reg number using the chasis
$regno= getRegNosusingChasis($chasis);

$initialbalance=getBalance($chasis);

//now fetch the total installment the client has paid
$totalinstallmentspaid= allInstallmentPaid($chasis);

$previousinstallment = getpreviousinstallment($chasis);


//select the balance the client was to pay
$balanceremaining=getBalanceRemaining($chasis,$totalinstallmentspaid);

$recipients = $from;
$message = "Hello $cname, your initial installment balance was KSh.$initialbalance.You have paid a total installment of KSh.$totalinstallmentspaid,your previous installment payment was of Ksh.$previousinstallment and your balance is=Ksh.$balanceremaining which is due on $printdate of this month.\nKindly make your installment payment through this Mpesa Paybill Or Equity Bank;use your car registration number ($regno) as a reference.";
            
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

?>