<?php
include("dbconn.php");
include("dao-common.php");

//session_start();
//session_destroy();

//-----------------------------

if(isset($_GET) && !empty($_GET)) {  
$memberid=$_GET['memberid'];
$guestname=$_GET['guestname'];
$gender=$_GET['gender'];
$dresssize=$_GET['dresssize'];
$convid=$_GET['convid'];
$dresstype=$_GET['dresstype'];


$eventinfo=fun_guest_fee($convid);
if($dresstype=="")
   $amount=$eventinfo->con_gfee1;
else 
   $amount=$eventinfo->con_gfee2;
//$guest_list=null;

//var_dump(json_decode($_SESSION["guestdata"]));

if(isset($_SESSION["guestdata"])){ 
 $guest_list=(array)json_decode($_SESSION["guestdata"]); 
 $rcount=sizeof($guest_list);
 //var_dump($guest_list,$rcount);
 $guest=fun_data_add($memberid,$guestname,$gender,$dresssize,$dresstype,$rcount+1,$amount); 
 $guest_list[$rcount]=$guest;
 $_SESSION["guestdata"]=json_encode($guest_list);
 echo json_encode($guest_list);
}
else{
    $guest=fun_data_add($memberid,$guestname,$gender,$dresssize,$dresstype,"1",$amount);
    $guest_list=array($guest);
    $_SESSION["guestdata"]=json_encode($guest_list);
    echo json_encode($guest_list);
}
  
}
else{
    $guest=new guest("","","","","","","0");
    $guest_list=array($guest);
    echo json_encode($guest_list);
}
//var_dump($guest_list);

  function fun_data_add($memberid,$guestname,$gender,$dresssize,$dresstype,$guestid,$amount) {

    $myBag = new guest($memberid,$guestid,$guestname, $gender, $dresssize,$dresstype,$amount);

    return $myBag;
  }



  function fun_guest_fee($convid){
   
    $mylink=fundb_connect();     
    $query2 = "select con_id,con_name,con_sdate,con_edate,con_mfee,con_sfee,con_gfee1,con_gfee2 ".
              " from tbl_convinfo where con_id='".$convid."'";
     
      $con_id=$convid;
      $con_name="";
      $con_sdate="";
      $con_edate="";
      $con_mfee=0;
      $con_sfee=0;
      $con_gfee1=0;
      $con_gfee2=0;    

    mysqli_set_charset($mylink, 'utf8'); 
    $result2 = mysqli_query($mylink,$query2);

    while ($row1 = mysqli_fetch_assoc($result2)) {
      
      $con_id=$row1['con_id'];
      $con_name=$row1['con_name'];
      $con_sdate=$row1['con_sdate'];
      $con_edate=$row1['con_edate'];
      $con_mfee=(int)$row1['con_mfee'];
      $con_sfee=(int)$row1['con_sfee'];
      $con_gfee1=(int)$row1['con_gfee1'];        
      $con_gfee2=(int)$row1['con_gfee2'];
    } 

    $eventinfo=new eventinfo($con_id,$con_name,$con_sdate,$con_edate,$con_mfee,$con_sfee, $con_gfee1,$con_gfee2);
    //var_dump($eventinfo);
    
    return $eventinfo;
  }  

?>