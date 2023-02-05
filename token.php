<?php
//include("bll-common.php");
//session_start();

$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
$tokentimes=$array['token_time'];
date_default_timezone_set("Asia/Dhaka");
if($tokentimes=='')$token_time=date("Y-m-d H:i:s");
else{
   $token_time = strtotime($tokentimes);   
}
$cur_time=strtotime(date("Y-m-d H:i:s"));

//var_dump($cur_time);
//var_dump($token_time);

$diff_minits=round(($cur_time-$token_time) / 60);
//$minutes = $diff_minits->format('%i');
//var_dump($diff_minits);

if($diff_minits>55){
	$request_token=bkash_Get_Token();
	$idtoken=$request_token['id_token'];	
	$_SESSION['token']=$idtoken;
	$array['token']=$idtoken;
	$array['token_time']=date("Y-m-d H:i:s");
	$newJsonString = json_encode($array);
	file_put_contents('config.json',$newJsonString);
	$array['token_time']=date("Y-m-d H:i:s");
}
else{
	$_SESSION['token']=$array['token'];
}

//echo $idtoken;
	
function bkash_Get_Token(){
	$log = new log();	
	$strJsonFileContents = file_get_contents("config.json");
	$array = json_decode($strJsonFileContents, true);
	
	$post_token=array(
        'app_key'=>$array["app_key"],                                              
		'app_secret'=>$array["app_secret"]                  
	);	
    
    $url=curl_init($array["tokenURL"]);
	$proxy = $array["proxy"];
	$posttoken=json_encode($post_token);
	$header=array(
		'Content-Type:application/json',
		'password:'.$array["password"],                                                               
        'username:'.$array["username"]                                                           
	);	

	$log->general("Token url:".json_encode($array["tokenURL"], JSON_PRETTY_PRINT));	
	$log->general("Token Heder:".json_encode($header, JSON_PRETTY_PRINT));
	$log->general("Token post:".json_encode($post_token, JSON_PRETTY_PRINT));
	
    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
	curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($url,CURLOPT_POSTFIELDS, $posttoken);
	curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
	//curl_setopt($url, CURLOPT_PROXY, $proxy);
	$resultdata=curl_exec($url);
	//var_dump($resultdata);
	$log->general("Token result:".json_encode($resultdata, JSON_PRETTY_PRINT));
	curl_close($url);
	return json_decode($resultdata, true);    
}
?>
