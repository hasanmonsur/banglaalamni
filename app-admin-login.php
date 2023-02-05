<?php
include("dbconn.php");
include("dao-common.php");

if(isset($_GET) && !empty($_GET)) {  
$useremail=$_GET['useremail'];
$userpass=$_GET['userpass'];
$login_status="fail";
if($useremail!="" && $userpass!=""){ 
     $login_data=fun_login_validation($useremail,$userpass);

     $_SESSION["logindata"]= json_encode($login_data);
     //var_dump("hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh".json_decode($_SESSION["logindata"]));
     $login_status=$login_data->status_msg;   
    echo $login_status;
}
else{
    $login_status="fail";
    echo $login_status;
}
  
}
else{    
    $login_status="fail";
    echo $login_status;
}

function fun_login_validation($useremail,$userpass) {

    $mylink=fundb_connect();  
    $query3 = "SELECT user_name,user_role,email_id  FROM tbl_login WHERE email_id='".$useremail."' AND user_pass='".$userpass."'";
    //echo( $query3);
    $user_name="";
    $user_role="";
    $email_id="";

    $result3 = mysqli_query($mylink,$query3);
    $excminite=99;
    while ($row3 = mysqli_fetch_assoc($result3)) {  
        $user_name=$row3['user_name'];
        $user_role=$row3['user_role'];
        $email_id=$row3['email_id'];    
    }  
    
    $userinfo=new userinfo ("", "","","fail");
    if($email_id!=""){
          $status_msg="Hi ! ".$user_name;
          $userinfo=new userinfo ( $user_name,$user_role,$email_id,$status_msg);
    }    
    
    //echo( $excminite);
    return $userinfo;
  }

?>