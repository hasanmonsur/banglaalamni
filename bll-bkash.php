<?php
include("dbconn.php");
include("dao-bkash.php");


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

function fun_save_paymentinfo($tran_id,$chl_id,$chl_trxid,$chl_session1, $chl_session2, $pay_amt,$pay_com, $pay_status,$createTime,$vrconvid,$vrmemid) {
    $opstat=false; //$traninfo,$member_info,$guest_list
    $log = new log();


    $mylink=fundb_connect();
    begin($mylink); // transaction begins
    $dbtranid=(int)substr($tran_id,8,5);
    $query1 = "INSERT INTO tbl_payinfo (tran_id,chl_id,chl_trxid,chl_session1,chl_session2,pay_amt,pay_com,pay_status,payment_time) ".
                " values ('".$dbtranid."','".$chl_id."','".$chl_trxid."','".$chl_session1."','"."--"."','".$pay_amt."','".$pay_com."','Y','".$createTime."')";
    
    $result1 = mysqli_query($mylink,$query1);
    
    $query2 = "UPDATE tbl_transaction	SET tran_status='Y',payment_time='".$createTime."' WHERE tran_id ='".$dbtranid."'";
    $result2 = mysqli_query($mylink,$query2);   
    
    if($vrconvid=="99000"){
      $max_mem_id=fun_last_memberid('');
      $mem_id=$max_mem_id;
       if($mem_id!='1')
         $query3 = "UPDATE tbl_member	SET payment_status='Y', mem_id='".$mem_id."' WHERE mem_id ='".$vrmemid."'";
       else 
         $query3 = "UPDATE tbl_member	SET payment_status='Y' WHERE mem_id ='".$vrmemid."'";

      $result3 = mysqli_query($mylink,$query3);   
    //$log->general("Database Status01:". json_encode($mylink)."----".$result1." >>> ".$query1);
    }
    else{
      $query3 = "UPDATE tbl_registration	SET reg_status='Y' WHERE tran_id ='".$dbtranid."'";
      $result3 = mysqli_query($mylink,$query3);
    }

    if(!$result1){    
        rollback($mylink); // transaction rolls back
        //echo "transaction rolled back";
        exit;
    }else{
        commit($mylink); // transaction is committed
        //echo "Database transaction was successful";
        $opstat=true;
    }  
    //var_dump($opstat);
    return $opstat;
}

?>