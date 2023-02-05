<?php
include("dbconn.php");
include("dao-common.php");
//session_start();


if(isset($_GET) && !empty($_GET)) {  
$memberid=$_GET['memberid'];
$convid=$_GET['convid'];
$tranid=$_GET['tranid'];
//session_destroy();


if($memberid!=""){ 
 $traninfo=fun_data_search($memberid,$convid,$tranid); 

 echo json_encode($traninfo);
}
else{
    $traninfo=new tran("","","","","","",null,null);   
    echo json_encode($traninfo);
}
  
}
else{    
    $traninfo=new tran("","","","","","",null,null);    
    echo json_encode($traninfo);
}
//var_dump($guest_list);

function fun_data_search($memberid,$convid,$tranid) {

    $mylink=fundb_connect();   
    $mem_id="";
    $con_id="";
    $tran_status="";
    $tran_amt="";
    $tran_date="";
    $dbtranid="";
    $bktranid="";

    if(strlen($tranid)==10){
        $bktranid=$tranid;
        $dbtranid="";
    }
    else{
        if(strlen($tranid)>5)
        $dbtranid=(int)substr($tranid,8);
        else
        $dbtranid=(int)$tranid;

        $bktranid="";
    }
    $query1 = "select tran_id,mem_id,con_id,tran_date,tran_amt,tran_status,entry_date,payment_time ".
    " from  tbl_transaction where tran_id='".$dbtranid."'";
    mysqli_set_charset($mylink, 'utf8'); 
    var_dump($query1);
    $result1 = mysqli_query($mylink,$query1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $mem_id=$row['mem_id'];
        $con_id=$row['con_id'];
        $tran_status=$row['tran_status'];
        $tran_amt=$row['tran_amt'];
        $tran_date=$row['tran_date'];
        $dbtranid=$row['tran_id'];
        $payment_time=$row['payment_time'];        
    }

    if($mem_id!='')
       $traninfo=new tran("",$mem_id, $con_id, $payment_time,$tran_amt,$tran_status,null,null);
    else 
       $traninfo=new tran("","","","","","",null,null);    
    return $traninfo;
  }

?>