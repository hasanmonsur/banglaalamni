<?php
include("dao-common.php");
//session_start();

//-----------------------------

if(isset($_GET) && !empty($_GET)) {  
$btnval=$_GET['btnval'];
$stval=explode('-',$btnval);
$key=(int)$stval[1];

if(isset($_SESSION["guestdata"])){ 
 $guest_list=(array)json_decode($_SESSION["guestdata"]);
 $guest_list_new=array();
 //unset($guest_list[$key]);
 //var_dump($guest_list,$key);
 $guestid=1;
 $intCount=0;
 foreach ($guest_list as $item) {
  if($key!= (int)$item->guestid){
  $item->guestid=$guestid;  
  $guest_list_new[$intCount] = $item;
  $intCount=$intCount+1;
  $guestid=$guestid+1;
  }
 }
 //$rcount=sizeof($guest_list_new);
 //var_dump($guest_list_new,$rcount);

 $_SESSION["guestdata"]=json_encode($guest_list_new);
 echo json_encode($guest_list_new);
}
  
}
else{
    $guest_list_new=array();
    echo json_encode($guest_list_new);
}


?>