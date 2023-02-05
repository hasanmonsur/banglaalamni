<?php
include("dbconn.php");
include("dao-common.php");

//-----------------------------

if(isset($_GET) && !empty($_GET)) {  
    $membertype=$_GET['membertype'];
    $memberid=$_GET['memid'];
    $rmemname=$_GET['rmemname'];
    $rfathername=$_GET['rfathername'];
    $rmothername=$_GET['rmothername'];
    $gendertype=$_GET['gendertype'];
    $rpreaddress=$_GET['rpreaddress'];
    $rperaddress=$_GET['rperaddress'];
    $rphoneno=$_GET['rphoneno'];
    $remailadd=$_GET['remailadd'];
    $rhonorpass=$_GET['rhonorpass'];
    $rmasterpass=$_GET['rmasterpass'];
 

  function fun_member_data_update($member_info) {
    $opstat=false; 
    $mylink=fundb_connect();
    begin($mylink); // transaction begins
  
     $query1 ="UPDATE tbl_member SET mem_name='".$member_info->mem_name."',mem_fname='".$member_info->mem_fname."',mem_mname='".$member_info->mem_mname."',mem_gender='".$member_info->mem_gender."',mem_contact='".$member_info->mem_contact."',mem_emailadd='".$member_info->mem_email
     ."',mem_preaddress='".$member_info->mem_preaddress."',mem_peraddress='".$member_info->mem_peraddress."',own_pass_year='".$member_info->own_pass_year."',ms_pass_year='".$member_info->ms_pass_year
     ."' WHERE mem_id='".$member_info->mem_id."'";
    
    
     //var_dump($query1);
    
    //var_dump($member_info);
    
    mysqli_set_charset($mylink, 'utf8'); 
    $result1 = mysqli_query($mylink,$query1); 
    //var_dump($result1);
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
 

    $member_info=new memberinfo($memberid,$membertype,$rmemname,$rfathername, $rmothername, $gendertype,$rphoneno,$remailadd,$rpreaddress,$rperaddress,$rhonorpass,$rmasterpass,'');
     
    //var_dump($member_info);

    $savestat=fun_member_data_update($member_info); 
    if($savestat){   
      echo "Y";     
    }
    else
      echo "N";

}
?>