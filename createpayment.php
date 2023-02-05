<?php
session_start();
include("bll-common.php");
include("dao-bkash.php");
include("token.php");
$log = new log();

$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
$tokenid=$array['token'];

$amount = $_GET['amount'];
$invoice = $_SESSION["invoiceno"]; // must be unique
if($invoice=='')
   $invoice=$_GET['invoice'];

$intent = "sale";


$totalamount=(float)$_SESSION["totalamt"];
if($totalamount!=(float)$amount)$amount=$totalamount;

    $proxy = $array["proxy"];
    $createpaybody=array('amount'=>$amount, 'currency'=>'BDT','intent'=>$intent,'merchantInvoiceNumber'=>$invoice);   
    $url = curl_init($array["createURL"]);
    $createpaybodyx = json_encode($createpaybody);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$tokenid,
        'x-app-key:'.$array["app_key"]
    );
    
    $log->general("create url:".json_encode($array["createURL"], JSON_PRETTY_PRINT));
    $log->general("create Heder:".json_encode($header, JSON_PRETTY_PRINT));
    $log->general("create Body:".json_encode($createpaybody, JSON_PRETTY_PRINT));
    try{
    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
	curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($url,CURLOPT_TIMEOUT,30);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);
    if($totalamount==$amount)
    $resultdata = curl_exec($url);
    
    } catch (Error $e) {
    // Handle error
    //echo $e->getMessage(); // Call to a member function method() on string
    }
    $resp_data=json_decode($resultdata);
    $responsedata=new createresponse("","","","","","","","");
    $log->general("create result:".json_encode($resultdata, JSON_PRETTY_PRINT));
    curl_close($url);
	
    if (property_exists($resp_data, 'errorCode')) {
       $responsedata->statuscode=$resp_data->errorCode;
       $responsedata->statusmsg=$resp_data->errorMessage;
    }
	else if ($totalamount!=$amount) {
       $responsedata->statuscode="201";
       $responsedata->statusmsg="amount mitch match";
    }
    else if (property_exists($resp_data, 'message')) {
       $responsedata->statuscode="201";
       $responsedata->statusmsg=$resp_data->message;
    }
    else{
       $responsedata->paymentID=$resp_data->paymentID;
       $responsedata->createTime=$resp_data->createTime;
       $responsedata->currency=$resp_data->currency;
       $responsedata->amount=$resp_data->amount;
       $responsedata->merchantInvoiceNumber=$resp_data->merchantInvoiceNumber;
       $responsedata->transactionStatus=$resp_data->transactionStatus;
       $responsedata->orgName=$resp_data->orgName;
       $responsedata->orgLogo=$resp_data->orgLogo;
       $responsedata->statuscode="200";
       $responsedata->statusmsg="Success";
	   $_SESSION["totalamt"]=$resp_data->amount;
	   $_SESSION["invoiceno"]=$resp_data->merchantInvoiceNumber;
    }

    echo json_encode($responsedata);  

?>
