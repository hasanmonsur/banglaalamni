<?php
include("dbconn.php");
include("dao-common.php");
//session_start();

if(isset($_GET) && !empty($_GET)) { 
$memtype=$_GET['memtype']; 
$memberid=$_GET['memberid'];

if($memberid!=""){ 
 $member=fun_data_mem_search($memberid,"",$memtype);  
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

function fun_data_mem_search($memberid,$convid,$memtype) {

    $mylink=fundb_connect();
        
        $membername='';
        $gender='';
        $dresssize="0";        
        $totalguest="0";  
        $feeamount=0;        
        $totalamount=0;
        $mregistat="0";

    $query1 = "select auto_id,mem_id,mem_name,mem_fname,mem_mname,mem_gender,mem_contact,mem_emailadd,mem_preaddress,mem_peraddress,own_pass_year,ms_pass_year".
              ", payment_status AS mregi_status from tbl_member m where mem_id='".$memberid."'";

    mysqli_set_charset($mylink, 'utf8'); 
    //var_dump($query1);
    $result1 = mysqli_query($mylink,$query1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $memberid=$row['mem_id'];
        $membername=$row['mem_name'];
        $memfname=$row['mem_fname'];
        $memmname=$row['mem_mname'];
        $mempreaddress=$row['mem_preaddress'];
        $memperaddress=$row['mem_peraddress'];
        $ownpassyear=$row['own_pass_year'];
        $mspassyear=$row['ms_pass_year'];
        $memcontact=$row['mem_contact'];
        $mememail=$row['mem_emailadd'];
        $gender=$row['mem_gender'];
        $mregistat=$row['mregi_status'];
        if(strpos($memberid,'S') !== false)
          $memType='S';
        else if(strpos($memberid,'G') !== false)
          $memType='G';
          else $memType='';
    
    }
    
    if($membername!=''){
       $myBag = new memberinfo($memberid,$memType,$membername,$memfname, $memmname, $gender,$memcontact,$mememail,$mempreaddress,$memperaddress,$ownpassyear,$mspassyear,$mregistat);
    }
    else{
        $myBag=new memberinfo("","","","","","","","","","","","","");
    }
	
    
    return $myBag;
  }

?>