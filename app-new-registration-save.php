<?php
include("dbconn.php");
include("dao-common.php");

//-----------------------------

if(isset($_GET) && !empty($_GET)) {  
    $membertype=$_GET['membertype'];
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
    $rmpaystatus="N";


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

  function fun_member_save($member_info) {
    $opstat=false; 
    $mylink=fundb_connect();
    begin($mylink); // transaction begins
  
     $query1 ="INSERT INTO tbl_member(mem_id,mem_name,mem_fname,mem_mname,mem_gender,mem_contact,mem_emailadd,mem_preaddress,mem_peraddress,own_pass_year,ms_pass_year,payment_status,temp_mem_id)";
     $str= "values("."'".$member_info->mem_id."','".$member_info->mem_name."','";
     $str1=$member_info->mem_fname."','".$member_info->mem_mname."','";
     $str2=$member_info->mem_gender."','";
     $str3=$member_info->mem_contact."','".$member_info->mem_email."','".$member_info->mem_preaddress."','".$member_info->mem_peraddress."','".$member_info->own_pass_year."','".$member_info->ms_pass_year."','".$member_info->payment_status."','".$member_info->mem_id."')";
    
      $query1= $query1.$str.$str1.$str2.$str3;
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
       // echo "Database transaction was successful";
        $opstat=true;
    }

    return $opstat;
   }  
    
    $max_mem_id=fun_last_memberid($membertype);

   if($membertype!='') {       
       $memberid=$membertype.$max_mem_id;   // here change 2022/11/15
       $rmpaystatus='Y';
    }
    else {
       $memberid=$max_mem_id; 
       $rmpaystatus='N';    
    }

    $member_info=new memberinfo($memberid,$membertype,$rmemname,$rfathername, $rmothername, $gendertype,$rphoneno,$remailadd,$rpreaddress,$rperaddress,$rhonorpass,$rmasterpass,$rmpaystatus);
     
    //var_dump($member_info);

    $savestat=fun_member_save($member_info); 
    if($savestat){
      echo "Dear member your registration success..Member ID: ".$memberid;
      // $_SESSION["totalamt"]=4000;
       
      //echo $memberid;     
    }
    else
      echo "";
      //echo json_encode("Dear member your registration fail, plz retry with valid data..");
    
}
?>