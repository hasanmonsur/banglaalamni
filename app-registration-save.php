<?php
include("dbconn.php");
include("bll-common.php");
include("dao-common.php");
$log = new log();
//-----------------------------

if(isset($_GET) && !empty($_GET)) {  
$convid=$_GET['convid'];
$memberid=$_GET['memberid'];
$membername=$_GET['membername'];
$memmobileno=$_GET['memmobileno'];
$gender=$_GET['gender'];
$dresssize=$_GET['dresssize'];
$amount=$_GET['amount'];
$totalamount=$_GET['totalamount'];
//var_dump($_GET['ismember']);
$ismember=false;
if($_GET['ismember']=='true')
$ismember=true;
else 
$ismember=false;

$meminfo=null;

if($ismember)
{
	$meminfo=json_decode($_SESSION["memberdata"]);
	$amount=$meminfo->feeamount;
}
else{
	$amount=0;
}
$log->general("raw result:".$_SESSION["memberdata"]);
$log->general("save result:".json_encode($meminfo, JSON_PRETTY_PRINT)."--".$ismember.">>",$amount);

if(isset($_SESSION["guestdata"]) && !empty($_SESSION["guestdata"])){ 
 $guest_list=json_decode($_SESSION["guestdata"]);
 $rcount=sizeof($guest_list);
 $log->general("save result01:".$amount.">>".$totalamount);
 
 if($rcount>0){
    $sumamt = 0;
    foreach($guest_list as $key=>$value){
    if(isset($value->amount))
        $sumamt += $value->amount;
    }    
    if(($sumamt+(int)$amount)>=(int)$totalamount){
    $member_info=new member($memberid,$convid,$membername, $gender, $dresssize,$amount,$rcount,$totalamount,"0");
    $traninfo=fun_data_save($member_info,$guest_list,$ismember,$memmobileno); 
    $_SESSION["totalamt"]=$totalamount;
    $_SESSION["invoiceno"]=$traninfo->tran_id;
    } 
 }
 //session_destroy();
 echo json_encode($traninfo);
}
else{
    $guest_list=array();
    if($ismember){
      $member_info=new member($memberid,$convid,$membername, $gender, $dresssize,$amount,"0",$totalamount,"0");
      $traninfo=fun_data_save($member_info,$guest_list,$ismember,$memmobileno); 
      $_SESSION["totalamt"]=$amount;
      $_SESSION["invoiceno"]=$traninfo->tran_id;
      $log->general("save result03:".$amount.">>".$totalamount);
    }
    else {
        $traninfo=new tran("","","","","","",null,null);
    }
    //echo "hi";
    //session_destroy();
    
    echo json_encode($traninfo);
}
  
}
else{
    $traninfo=new tran("","","","","","",null,null);
    session_destroy();
    echo json_encode($traninfo);
}
//var_dump($guest_list);
function func_update_mobile($mem_id,$memmobileno){
     $opstat=false; //$traninfo,$member_info,$guest_list

    $mylink=fundb_connect();
    begin($mylink); // transaction begins

    $query1 = "UPDATE tbl_member SET mem_contact='".$memmobileno."' WHERE mem_id='".$mem_id."'";
    mysqli_set_charset($mylink, 'utf8'); 
    $result1 = mysqli_query($mylink,$query1);

   if(!$result1){    
        rollback($mylink); // transaction rolls back
        //echo "transaction rolled back";
        exit;
    }else{
        commit($mylink); // transaction is committed
        //echo "Database transaction was successful";
        $opstat=true;
    }

    return $opstat;
}

function func_tran_save($traninfo) {
    $opstat=false; //$traninfo,$member_info,$guest_list

    $mylink=fundb_connect();
    begin($mylink); // transaction begins

    $query1 = "INSERT INTO tbl_transaction (mem_id,con_id,tran_date,tran_amt,tran_status) ".
              " values ('".$traninfo->mem_id."','".$traninfo->con_id."','".$traninfo->tran_date."',".$traninfo->tran_amt.",'".$traninfo->tran_status."')";
    mysqli_set_charset($mylink, 'utf8'); 
    $result1 = mysqli_query($mylink,$query1);
    //var_dump($result1);
    $last_inserted =mysqli_insert_id($mylink);
    $traninfo->tran_id=(string)date("Ymd").str_pad($last_inserted, 5, '0', STR_PAD_LEFT);
    
    // check member info
    if($traninfo->member_info!=null){

    if($traninfo->member_info->gender=="male")$mdresstype="panjabi";
    else $mdresstype="sharee";

    $query2 = "INSERT INTO tbl_registration (mem_id,con_id,p_type, reg_name,reg_gender,reg_dress,reg_dress_type,reg_amount,tran_id) values ".
              "('".$traninfo->mem_id."','".$traninfo->con_id."','M','".$traninfo->member_info->membername."','".$traninfo->member_info->gender."','".$traninfo->member_info->dresssize."','".$mdresstype."',".$traninfo->member_info->feeamount.",".$last_inserted.")";
    if(sizeof($traninfo->regi_info)>0){
      foreach ($traninfo->regi_info as $guest) {
       $query2=$query2.",". "('".$traninfo->mem_id."','".$traninfo->con_id."','G','".$guest->guestname."','".$guest->gender."','".$guest->dresssize."','".$guest->dresstype."',".$guest->amount.",".$last_inserted.")";
      }
     }
     mysqli_set_charset($mylink, 'utf8'); 
     $result2 = mysqli_query($mylink,$query2);
    }
    else{
    $query2 = "INSERT INTO tbl_registration (mem_id,con_id,p_type, reg_name,reg_gender,reg_dress,reg_dress_type,reg_amount,tran_id) values ";
              //"('".$traninfo->mem_id."','".$traninfo->con_id."','M','".$traninfo->member_info->membername."','".$traninfo->member_info->gender."','".$traninfo->member_info->dresssize."',".$traninfo->member_info->feeamount.",".$last_inserted.")";
    $rcount=0;
    if(sizeof($traninfo->regi_info)>0){
      foreach ($traninfo->regi_info as $guest) {
       if($rcount<=0)
         $query2=$query2. "('".$traninfo->mem_id."','".$traninfo->con_id."','G','".$guest->guestname."','".$guest->gender."','".$guest->dresssize."','".$guest->dresstype."',".$guest->amount.",".$last_inserted.")";
       else   
        $query2=$query2. ",('".$traninfo->mem_id."','".$traninfo->con_id."','G','".$guest->guestname."','".$guest->gender."','".$guest->dresssize."','".$guest->dresstype."',".$guest->amount.",".$last_inserted.")";
    
       $rcount=$rcount+1;
    }
     }
     //var_dump($query2);
     mysqli_set_charset($mylink, 'utf8'); 
     $result2 = mysqli_query($mylink,$query2);
    }    
    //var_dump($result1.'--'.$result2);
    if(!$result1 || !$result2){    
        rollback($mylink); // transaction rolls back
        //echo "transaction rolled back";
        exit;
    }else{
        commit($mylink); // transaction is committed
        //echo "Database transaction was successful";
        $opstat=true;
    }

    return $traninfo;
}

function fun_data_save($member_info,$guest_list,$ismember,$memmobileno) {

    $mem_id=$member_info->memberid;
    $con_id=$member_info->convid;
    $tran_date=date("Y-m-d");
    $tran_amt=$member_info->totalamount;
    $tran_status="N";  
    if($ismember)
    {        
        $traninfo=new tran("",$mem_id, $con_id, $tran_date,$tran_amt,$tran_status,$member_info,$guest_list);
        $traninfo_result=func_tran_save($traninfo); 
        $mopstatus=func_update_mobile($mem_id,$memmobileno);
    }
    else
    {
        $traninfo=new tran("",$mem_id, $con_id, $tran_date,$tran_amt,$tran_status,null,$guest_list);        
        $traninfo_result=func_tran_save($traninfo); 
        $traninfo_result->member_info=$member_info;
        $mopstatus=func_update_mobile($mem_id,$memmobileno);
    }      

    return $traninfo_result;
}



?>