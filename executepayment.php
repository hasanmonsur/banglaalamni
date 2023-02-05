<?php
session_start(); 
include("bll-common.php");
include("bll-bkash.php");
include("token.php");
$log = new log();

$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
$tokenid=$array['token'];

$paymentID = $_GET['paymentID'];
$amount = $_GET['amount'];
$tranid = $_GET['tranid'];
$vrconvid = $_GET['vrconvid'];
$vrmemid = $_GET['vrmemid'];
//var_dump($paymentID);
$tranid=$_SESSION["invoiceno"];
$proxy = $array["proxy"];
//$tokenid=$_SESSION['token'];

$url = curl_init($array["executeURL"].$paymentID);

$header=array(
    'Content-Type:application/json',
    'authorization:'.$tokenid,
    'x-app-key:'.$array["app_key"]              
);	

  $log->general("execute url:".$array["executeURL"].$paymentID);
  $log->general("execute Heder:".json_encode($header, JSON_PRETTY_PRINT));
   $error_number=0;  
try {
curl_setopt($url,CURLOPT_HTTPHEADER, $header);
curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($url,CURLOPT_TIMEOUT,30);
//curl_setopt($url, CURLOPT_PROXY, $proxy);

$resultdatax=curl_exec($url);
$error_number = curl_errno($url);
//$curl_error = curl_error($url);

} catch (Error $e) {
    // Handle error
    //echo $e->getMessage(); // Call to a member function method() on string
}
$responsedata=new execresponse('','','','','','','','','','','');

$log->general("execute result:".json_encode($resultdatax, JSON_PRETTY_PRINT));
if ($error_number>0) {
    $responsedata->statuscode="201";
    $responsedata->statusmsg="System Timeout";
    $log->general("execute result01:".json_encode($error_number, JSON_PRETTY_PRINT));
}
else{
$resp_data=json_decode($resultdatax);

$log->general("execute result02:".json_encode($resp_data, JSON_PRETTY_PRINT));

if (!property_exists($resp_data, 'errorCode') && !property_exists($resp_data, 'message')) {
  //$amount,$createTime, $currency, $intent,$merchantInvoiceNumber,$paymentID,$transactionStatus,$trxID,$updateTime
  $responsedata->amount=$resp_data->amount;
  $responsedata->currency=$resp_data->currency;
  $responsedata->intent=$resp_data->intent;
  $responsedata->merchantInvoiceNumber=$resp_data->merchantInvoiceNumber;
  $responsedata->paymentID=$resp_data->paymentID;
  $responsedata->transactionStatus=$resp_data->transactionStatus;
  $responsedata->trxID=$resp_data->trxID;
  $responsedata->updateTime=$resp_data->updateTime;  

  if($resp_data->transactionStatus=='Completed' && $responsedata->merchantInvoiceNumber==$tranid ){    
     $responsedata->statuscode="200";
     $responsedata->statusmsg=$resp_data->transactionStatus;
     $amount=$responsedata->amount;
     $opstat=fun_save_paymentinfo($tranid,"bkash",$resp_data->trxID,$paymentID,$tokenid, $amount,"0", "Y",$resp_data->createTime,$vrconvid,$vrmemid);
  }
  else{
	 $responsedata->statuscode="201";
     $responsedata->statusmsg="invoice no is not valid";
  }
}
else if (property_exists($resp_data, 'message')) {
     $responsedata->statuscode="201";
     $responsedata->statusmsg=$resp_data->message;
}
else{
     $responsedata->statuscode=$resp_data->errorCode;
     $responsedata->statusmsg=$resp_data->errorMessage;
}
}

curl_close($url);
echo json_encode($responsedata);  
?>
