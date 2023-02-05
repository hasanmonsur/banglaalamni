<?php
include("dbconn.php");
include("dao-common.php");
//session_start();
if(isset($_GET) && !empty($_GET)) {  
$convid=$_GET['convid'];
$rptype=$_GET['rptype'];

$membertype=$_GET['sradmtype'];
$dresstype=$_GET['sradgset'];
$dresssize=$_GET['sradresssize'];

if($convid!=""){ 
  if($rptype=="D")
    $data_list=fun_data_list_register($convid,$membertype,$dresstype,$dresssize);
  else if($rptype=="S")
    $data_list=fun_data_sum_list_register($convid,$membertype,$dresstype,$dresssize);
  else if($rptype=="M")
    $data_list=fun_data_member_regi($convid);
  else if($rptype=="L")
    $data_list=fun_data_member_regi_list($convid);
  else $data_list=array(); 
 
    echo json_encode($data_list);
}
else{
    $data_list=array();   
    echo json_encode($data_list);
}
  
}
else{    
    $data_list=array();   
    echo json_encode($data_list);
}

//var_dump($guest_list);

  function fun_data_sum_list_register($convid,$membertype,$dresstype,$dresssize) {

    $mylink=fundb_connect();
    $data_list=array();
    $mstr1="";$mstr2="";$mstr3="";

    if($membertype!="")    $mstr1=" AND p_type='".$membertype."' ";
    if($dresstype!="")    $mstr2=" AND reg_dress_type='".$dresstype."' ";
    if($dresssize!="")    $mstr3=" AND reg_dress=".$dresssize." ";

    //$query = "SELECT reg_id,mem_id,p_type,con_id,reg_name,reg_gender,reg_dress,reg_dress_type,reg_amount,tran_id ".
    //" FROM tbl_registration WHERE reg_status='Y' and con_id='".$convid."' ".$mstr1.$mstr2.$mstr3."  ORDER BY mem_id ASC";

    $query = "SELECT mem_id,IF(p_type='M',reg_name,'') mem_name,SUM(IF(p_type='G',1,0)) nGuest,con_id,SUM(IF(reg_gender='male',1,0)) nMale, SUM(IF(reg_gender='female',1,0)) nFemale,SUM(IF(reg_dress_type='panjabi',1,0)) nPdress,SUM(IF(reg_dress_type='sharee',1,0)) nSdress,COUNT(*) tPerson ,SUM(reg_amount) tAmount  ".
    " FROM tbl_registration WHERE reg_status='Y' and con_id='".$convid."' ".$mstr1.$mstr2.$mstr3."  GROUP BY mem_id ,con_id ORDER BY reg_id ASC";

    mysqli_set_charset($mylink, 'utf8'); 
    //var_dump($query);
    $result = mysqli_query($mylink,$query);
    
    while ($row = mysqli_fetch_array( $result ) ) {
        array_push( $data_list, $row );
    }

    return $data_list;
  }

  function fun_data_list_register($convid,$membertype,$dresstype,$dresssize) {

    $mylink=fundb_connect();
    $data_list=array();
    $mstr1="";$mstr2="";$mstr3="";

    if($membertype!="")    $mstr1=" AND p_type='".$membertype."' ";
    if($dresstype!="")    $mstr2=" AND reg_dress_type='".$dresstype."' ";
    if($dresssize!="")    $mstr3=" AND reg_dress=".$dresssize." ";

    $query = "SELECT reg_id,mem_id,p_type,con_id,reg_name,reg_gender,reg_dress,reg_dress_type,reg_amount,tran_id ".
    " FROM tbl_registration WHERE reg_status='Y' and con_id='".$convid."' ".$mstr1.$mstr2.$mstr3."  ORDER BY CAST(mem_id AS INT) ASC";
    mysqli_set_charset($mylink, 'utf8'); 
    //var_dump($query);
    $result = mysqli_query($mylink,$query);
    
    while ($row = mysqli_fetch_array( $result ) ) {
        array_push( $data_list, $row );
    }

    return $data_list;
   }


  
  function fun_data_member_regi($convid) {

    $mylink=fundb_connect();
    $data_list=array();


    $query = "SELECT  mem_id,(SELECT CONCAT_WS(', M_ID-',m.mem_name,m.mem_id) FROM tbl_member m WHERE m.temp_mem_id=t.mem_id) mem_name,tran_id,tran_date,tran_amt FROM tbl_transaction t WHERE tran_status='Y' AND con_id='".$convid."' and substring(mem_id,1,1) not in('S','G')  ORDER BY CAST(mem_id AS INT) ASC";
    mysqli_set_charset($mylink, 'utf8'); 
    //var_dump($query);
    $result = mysqli_query($mylink,$query);
    
    while ($row = mysqli_fetch_array( $result ) ) {
        array_push( $data_list, $row );
    }

    return $data_list;
  }


  function fun_data_member_regi_list($convid) {

    $mylink=fundb_connect();
    $data_list=array();


    $query = "SELECT  mem_id,mem_name,regi_date,mem_contact,CONCAT_WS('-',own_pass_year,ms_pass_year) as pass_year FROM tbl_member m WHERE substring(mem_id,1,1) not in('S','G','T')  ORDER BY CAST(mem_id AS INT) ASC";
    mysqli_set_charset($mylink, 'utf8'); 
    //var_dump($query);
    $result = mysqli_query($mylink,$query);
    
    while ($row = mysqli_fetch_array( $result ) ) {
        array_push( $data_list, $row );
    }

    return $data_list;
  }


?>