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
//$tranid = $_GET['tranid'];
$proxy = $array["proxy"];
//$tokenid=$_SESSION['token'];

//echo $tokenid;
$url = curl_init($array["queryURL"].$paymentID);

$header=array(
    'Content-Type:application/json',
    'authorization:'.$tokenid,
    'x-app-key:'.$array["app_key"]              
);	

  $log->general("query url:".$array["queryURL"].$paymentID);
  $log->general("query Heder:".json_encode($header, JSON_PRETTY_PRINT));
  $error_number=0;  
try {
curl_setopt($url,CURLOPT_HTTPHEADER, $header);
curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($url,CURLOPT_TIMEOUT,30);

$resultdatax=curl_exec($url);
$error_number = curl_errno($url);

} catch (Error $e) {
    // Handle error
    //echo $e->getMessage(); // Call to a member function method() on string
}
$responsedata=new execresponse('','','','','','','','','','','');

$log->general("query result:".json_encode($resultdatax, JSON_PRETTY_PRINT));
if ($error_number>0) {
    $responsedata->statuscode="201";
    $responsedata->statusmsg="System Timeout";
    $log->general("query result01:".json_encode($error_number, JSON_PRETTY_PRINT));
}
else{
  $log->general("query result02:".json_encode($resultdatax, JSON_PRETTY_PRINT));

  $resp_data=json_decode($resultdatax);
  if (!property_exists($resp_data, 'errorCode') && !property_exists($resp_data, 'message')) {
    $responsedata->paymentID=$resp_data->paymentID;
    $responsedata->createTime=$resp_data->createTime;
    $responsedata->amount=$resp_data->amount;
    $responsedata->currency=$resp_data->currency;
    $responsedata->intent=$resp_data->intent;
    $responsedata->merchantInvoiceNumber=$resp_data->merchantInvoiceNumber; 
    $responsedata->transactionStatus=$resp_data->transactionStatus;    
    $responsedata->updateTime=$resp_data->updateTime;  

    if($resp_data->transactionStatus=='Completed'){
      $responsedata->statuscode="200";
      $responsedata->statusmsg=$resp_data->transactionStatus;
      $responsedata->trxID=$resp_data->trxID;
      $amount=(float)$responsedata->amount;  
      $opstat=fun_save_paymentinfo($resp_data->merchantInvoiceNumber,"bkash",$resp_data->trxID,$resp_data->paymentID,"", $amount,"0", "Y",$resp_data->createTime);   
    }
    else if($resp_data->transactionStatus=='Initiated'){
      $responsedata->statuscode="203";
      $responsedata->statusmsg=$resp_data->transactionStatus;       
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
