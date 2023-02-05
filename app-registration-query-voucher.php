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
    " from  tbl_transaction where mem_id='".$memberid."' and con_id='".$convid."' and tran_status='Y' ";//AND (tran_id='".$dbtranid."' OR tran_id =(select b.tran_id from  tbl_payinfo b where chl_trxid='".$bktranid."'))
    mysqli_set_charset($mylink, 'utf8'); 
    //var_dump($query1);
    $tran_amt=0;
    $result1 = mysqli_query($mylink,$query1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $mem_id=$row['mem_id'];
        $con_id=$row['con_id'];
        $tran_status=$row['tran_status'];
        $tran_amt=$tran_amt+$row['tran_amt'];
        $tran_date=$row['tran_date'];
        //$dbtranid=$row['tran_id'];
        $payment_time=$row['payment_time'];        
    }

   
    if($con_id=='') $con_id=$con_id;
    if($memberid=='')$memberid=$mem_id;
    //if($mem_id!='') $memberid=$mem_id;

    $query2 = "select reg_id,mem_id,con_id,p_type, reg_name,reg_gender,reg_dress,reg_dress_type,reg_amount,tran_id,reg_status,entry_date ".
              " from tbl_registration where mem_id='".$memberid."' and con_id='".$convid."' and reg_status='Y' order by reg_id asc"; //and ('".$dbtranid."'='' OR tran_id='".$dbtranid."')
    //var_dump($query2);
    $result2 = mysqli_query($mylink,$query2);
    $rcount=0;  $regi_list=array();
    while ($row1 = mysqli_fetch_assoc($result2)) {        
        $reg_name=$row1['reg_name'];
        $mem_id=$row1['mem_id'];
        $p_type=$row1['p_type'];
        $mem_id=$p_type.'|'.$mem_id;

        $reg_gender=ucwords($row1['reg_gender']);
        $reg_dress=(int)$row1['reg_dress'];
        if($reg_dress==0)$reg_dress='';
        $reg_dress_type=ucwords($row1['reg_dress_type']);       
        
        $reg_amount=number_format((int)$row1['reg_amount'],2);        

        $regi=new guest($mem_id,$rcount+1,$reg_name, $reg_gender, $reg_dress,$reg_dress_type,$reg_amount);
        
        $regi_list[$rcount]=$regi;
        
        $rcount=$rcount+1;
    }    
    //var_dump($payment_time);
    if($mem_id!='')
       $traninfo=new tran("",$mem_id, $con_id, $payment_time,$tran_amt,$tran_status,null,$regi_list);
    else 
       $traninfo=new tran("","","","","","",null,null);    
    return $traninfo;
  }

?>