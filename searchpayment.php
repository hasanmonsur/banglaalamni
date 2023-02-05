<?php
session_start(); 
include("bll-common.php");
include("bll-bkash.php");
include("token.php");
$log = new log();

$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
$tokenid=$array['token'];
$trxID = $_GET['trxID'];
$proxy = $array["proxy"];

//$tokenid=$_SESSION['token'];


$url = curl_init($array["searchURL"].$trxID);

$header=array(
    'Content-Type:application/json',
    'authorization:'.$tokenid,
    'x-app-key:'.$array["app_key"]              
);	

  $log->general("search url:".$array["searchURL"].$trxID);
  $log->general("search Heder:".json_encode($header, JSON_PRETTY_PRINT));
  
try {
curl_setopt($url,CURLOPT_HTTPHEADER, $header);
curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
//pppp
$resultdatax=curl_exec($url);

} catch (Error $e) {
    // Handle error
    echo $e->getMessage(); // Call to a member function method() on string
}
//echo $resultdatax;

$log->general("search result:".json_encode($resultdatax, JSON_PRETTY_PRINT));

$resp_data=json_decode($resultdatax);

//var_dump($resp_data);

$responsedata=new searchresponse('','','','','','','','','','');

if (!property_exists($resp_data, 'errorCode') && !property_exists($resp_data, 'message')) {
  $responsedata->trxID=$resp_data->trxID;
  $responsedata->completedTime=$resp_data->completedTime;
  $responsedata->amount=$resp_data->amount;
  $responsedata->currency=$resp_data->currency;
  $responsedata->customerMsisdn=$resp_data->customerMsisdn;
  $responsedata->initiationTime=$resp_data->initiationTime; 
  $responsedata->transactionReference=$resp_data->transactionReference;
  $responsedata->transactionStatus=$resp_data->transactionStatus;
  $responsedata->updateTime=$resp_data->updateTime;  
  var_dump($responsedata);
  if($resp_data->transactionStatus=='Completed'){
     $responsedata->statuscode="200";
     $responsedata->statusmsg=$resp_data->transactionStatus;
     $amount=(float)$responsedata->amount/100;     
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

 curl_close($url);
echo json_encode($responsedata);  
?>
