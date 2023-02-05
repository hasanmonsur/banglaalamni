<?php
include("dbconn.php");
include("dao-common.php");
//session_start();

if(isset($_GET) && !empty($_GET)) { 
$memtype=$_GET['memtype']; 
$memberid=$_GET['memberid'];
$convid=$_GET['convid'];
$_SESSION["memberdata"]=null;

session_destroy();
session_start();

if($memberid!=""){ 
 $member=fun_data_search($memberid,$convid,$memtype);  
 $_SESSION["memberdata"]=json_encode($member);
 echo json_encode($member);
}
else{
    $member=new member("","","","","","","");
    $_SESSION["guestdata"]=null;
    echo json_encode($member);
}  
}
else{    
    $member=new member("","","Post Data emty","","","","");
    $_SESSION["guestdata"]=null;
    echo json_encode($member);
}
//var_dump($guest_list);

function fun_data_search($memberid,$convid,$memtype) {

    $mylink=fundb_connect();
        
        $membername='';
        $gender='';
        $dresssize="0";        
        $totalguest="0";  
        $feeamount=0;        
        $totalamount=0;
        $mregistat="0";

    $query1 = "select auto_id,mem_id,mem_name,mem_fname,mem_mname,mem_gender,mem_contact,mem_preaddress,mem_peraddress,own_pass_year,ms_pass_year".
              ",(SELECT COUNT(*)  FROM tbl_registration r WHERE reg_status='Y' AND r.mem_id=m.mem_id AND r.p_type='M') AS mregi_status ".
              "  from tbl_member m where mem_id='".$memberid."' AND  payment_status='Y' ";
    
    mysqli_set_charset($mylink, 'utf8'); 
    //var_dump($query1);
    $result1 = mysqli_query($mylink,$query1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $memberid=$row['mem_id'];
        $membername=$row['mem_name'];
        $memcontact=$row['mem_contact'];
        $membername=$membername."|".$memcontact;
        $gender=$row['mem_gender'];
        $mregistat=$row['mregi_status'];
        $dresssize="0";        
        $totalguest="0";       
    }
    //var_dump($membername);
    $query2 = "select con_id,con_name,con_sdate,con_edate,con_mfee,con_sfee,con_gfee1,con_gfee2 ".
              " from tbl_convinfo where con_id='".$convid."'";
 
    $result2 = mysqli_query($mylink,$query2);

    while ($row1 = mysqli_fetch_assoc($result2)) {   
        if($memtype=="" || $memtype=="G"){     
          $feeamount=(int)$row1['con_mfee'];        
          $totalamount=(int)$row1['con_mfee'];
        }
        else{    
          $feeamount=(int)$row1['con_sfee'];        
          $totalamount=(int)$row1['con_sfee'];
        }
    }   

    if($feeamount>0){
       $myBag = new member($memberid,$convid,$membername, $gender, $dresssize,$feeamount,$totalguest,$totalamount,$mregistat);
    }
    else{
        $myBag=new member("","","","","","","","","");
    }
	
    
    return $myBag;
  }

?>