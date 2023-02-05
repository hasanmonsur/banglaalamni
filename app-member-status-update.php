<?php
include("dbconn.php");
include("dao-common.php");
//session_start();

if(isset($_GET) && !empty($_GET)) { 
$memtype=$_GET['memtype']; 
$updatemtype=$_GET['updatemtype']; 
$memberid=$_GET['memberid'];
$mregistat=$_GET['mregistat'];
$newmemberid="";

$myBag="Member Status Update Failed...!! ";


function fun_last_memberid($membertype) {
  $maxid=0; 
  $mylink=fundb_connect();
  $query ="";
  if($membertype=="S")
    $query = "SELECT max(CAST(substring(mem_id,2) AS INTEGER)) AS maxCount FROM tbl_member where substring(mem_id,1,1) in ('S')";
  else if($membertype=="G")
    $query = "SELECT max(CAST(substring(mem_id,2) AS INTEGER)) AS maxCount FROM tbl_member where substring(mem_id,1,1) in ('G')";
  else 
    $query = "SELECT max(CAST(mem_id AS INTEGER)) AS maxCount FROM tbl_member where substring(mem_id,1,1) not in ('S','G')";
  
    mysqli_set_charset($mylink, 'utf8'); 
  $result = mysqli_query($mylink,$query);
  while ($row = mysqli_fetch_assoc($result)) {
      $maxid=(int)$row['maxCount'];        
  }
  $maxid=$maxid+1;

  return $maxid;
 }

function fun_data_mem_update($memberid,$mregistat,$newmemberid) {
    $mylink=fundb_connect(); 
    
    if($newmemberid!="")
     $query1 = "update tbl_member set payment_status='".$mregistat."',mem_id='".$newmemberid."'  where mem_id='".$memberid."'";
    else
     $query1 = "update tbl_member set payment_status='".$mregistat."' where mem_id='".$memberid."'";

    mysqli_set_charset($mylink, 'utf8'); 
    $result1 = mysqli_query($mylink,$query1);
        
    $myBag="Member Status Update Failed...!! ";
    
    if($result1>0){
       $myBag = "Member Status Update Successfull...!! ";
    }
    else{
        $myBag="Member Status Update Failed...!! ";
    }	
    
    return $myBag;
  }

if($memberid!=""){ 
  $newmemberid="";
  var_dump(substr($memberid,0,1));
  if(substr($memberid,0,1)=="T"){
    $nid=fun_last_memberid($updatemtype);
    $newmemberid=$updatemtype.$nid;
  }
  $myBag=fun_data_mem_update($memberid,$mregistat,$newmemberid); 

 echo json_encode($myBag);
}
else{
  echo json_encode($myBag);
}


}
?>