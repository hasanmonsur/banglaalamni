<?php
include("dbconn.php");

if(isset($_GET) && !empty($_GET)) {  
$total_amt=$_GET['total_amt'];
$last_times=0;
if($total_amt!=""){ 
 $last_times=fun_tran_validation($total_amt);
 echo $last_times;
}
else{
    $last_times=0;
    echo $last_times;
}
  
}
else{    
    $last_times=0;
    echo $last_times;
}

function fun_tran_validation($total_amt) {

    $mylink=fundb_connect();  
    $query3 = "select TIMESTAMPDIFF(MINUTE, MAX(entry_date),now()) AS TM from  tbl_payinfo where pay_amt=".$total_amt." and chl_session1 is NOT null";
    //echo( $query3);
    $result3 = mysqli_query($mylink,$query3);
    $excminite=99;
    while ($row3 = mysqli_fetch_assoc($result3)) {    
        if($row3['TM']!=null)    
           $excminite=(int)$row3['TM'];        
    }   
    //echo( $excminite);
    return $excminite;
  }

?>