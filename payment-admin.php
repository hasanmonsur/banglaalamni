<?php
//session_start();
include("dbconn.php");
include("dao-common.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Payment Voucher</title>
    <meta name="viewport" content="width=device-width" ,="" initial-scale="1.0/">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrom=1">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.css" rel="stylesheet">
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery.PrintArea.js"></script>
</head>

<body>
<?php
 //session_start();
 $amount="";
 $tranid="";
 $memberid="";
 $convid="";

if(isset($_GET) && !empty($_GET)) {  
   $amount=(float)$_GET['amount'];
   $amount1=number_format((int)$_GET['amount'],2);
   //$amount1=number_format((int)$_SESSION["totalamt"],2);
   if((int)$_GET['amount']-(int)$_SESSION["totalamt"]!=0) {
     $amount1= number_format((int)$_SESSION["totalamt"],2);
     $amount= (float)$_SESSION["totalamt"];
   }

   $tranid=$_GET['tranid'];
   $memberid=$_GET['memberid'];
   $convid=$_GET['convid'];


    $mylink=fundb_connect();
    begin($mylink); // transaction begins
    $dbtranid=(int)substr($tranid,8,5);

    //echo $dbtranid;
        
    $query2 = "UPDATE tbl_transaction	SET tran_status='Y',payment_time=NOW() WHERE mem_id ='".$memberid."' and con_id='".$convid."' and tran_id='".$dbtranid."'";
    $result2 = mysqli_query($mylink,$query2);   
    
    if($convid=="99000"){
      $max_mem_id=fun_last_memberid('');
      $mem_id=$max_mem_id;
       if($mem_id!='1')
         $query3 = "UPDATE tbl_member	SET payment_status='Y', mem_id='".$mem_id."' WHERE mem_id ='".$memberid."'";
       else 
         $query3 = "UPDATE tbl_member	SET payment_status='Y' WHERE mem_id ='".$memberid."'";

      $result3 = mysqli_query($mylink,$query3);   
    //$log->general("Database Status01:". json_encode($mylink)."----".$result1." >>> ".$query1);
    }
    else{
      $query3 = "UPDATE tbl_registration	SET reg_status='Y' WHERE mem_id ='".$memberid."' and con_id='".$convid."' and tran_id='".$dbtranid."'";
      $result3 = mysqli_query($mylink,$query3);
    }

    if(!$query2){    
        rollback($mylink); // transaction rolls back
        //echo "transaction rolled back";
        exit;
    }else{
        commit($mylink); // transaction is committed
        //echo "Database transaction was successful";
        $opstat=true;
    }  

}

?>
<div class="container border" >
  <div class="col-lg-12 border">
    
    <div class="PrintArea"><br><br><br>
      <div style="border:1px solid; text-align: center;" class="border text-center">
      <table>
       <tr>
         <td width="20%">
          <div class="col-lg-12"><br>
           <img src="img/rual_n.jpg" alt="BDA(RU)"  width="100">
           </div>
          </td>
         <td width="70%">
          <div class="col-lg-12">
          <img src="img/logo-ru.gif" alt="BDA(RU)"  width="100%"><br><br>
          <!-- <h3>তৃতীয় সম্মিলন উৎসব ২০২০<h3>  -->
          <h3>চতুর্থ সম্মিলন উৎসব ২০২২<h3>
          </div>
         </td>
         <td width="30%">
           <div class="col-lg-12"><br>
          <img src="img/202201-logo.jpg" alt=""  width="80">
          </div>
         </td>
       </tr>
      </table>      
      </div>
      <div style="border:1px solid; text-align: center;"  class="border text-center">        
        <h4 class="modal-title" id="exampleModalLabel">Payment Voucher</h4>       
        <input type="hidden" style="border:0px;" id="memberid" value="<?php echo $memberid; ?>" name="memberid">
        <input type="hidden" style="border:0px;" id="convid" value="<?php echo $convid; ?>" name="convid">
        
      </div>
      <div style="border:1px solid; text-align: justify;"  class="border text-justify">
        <h6>Invoice #: <input type="text" style="border:0px; width: 16% " id="tranid" value="<?php echo $tranid; ?>" name="tranid"> || 
        &nbsp;STATUS: <input type="text" style="border:0px; width: 9%; color:RED;" id="tran_status" placeholder="UNPAID" name="tran_status">  ||
          &nbsp; MEMBER ID : <input type="text" style="border:0px; width: 8% ;color:GREEN;" id="txtmem_id" name="txtmem_id" value="<?php echo $memberid; ?>"> 
         &nbsp; Time: <input type="text" style="border:0px;" id="paymenttime" name="paymenttime"><h6>
      </div>
      <div style="border:1px solid;" class="modal-body">
        <table class="table table-crossover border">
          <thead class="bg-info">
          <tr>
            <th>Reg-Type</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Dress </th>
              <th>Size</th>
              <th>Amount</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-data">
          
          </tbody>
        </table>
      </div>
      <div class="border text-right">
        <p>Total Amount: 
          <input type="hidden" style="border:0px;" id="totalamt" value="<?php echo $amount; ?>" name="totalamt"> 
          <input type="text" style="border:0px;" id="totalamt1" value="<?php echo $amount1; ?>" name="totalamt1"> 
        </p> 
      </div>
    </div>
      <div class="modal-footer border">   
        <span class="text-success left">NB: please save TRAN # <?php echo $tranid; ?> for next query. Thank's</span>     
        <button class="btn btn-info" id="bKash_button"><img src="img/bKash-Payment-logo.png" width="100" height="40" alt="submit" /></button>
        <button type="submit" class="btn btn-danger btn-xl" id="btnapp-print">print</button>        
      </div>
    </div>
  </div>
<script src="js/bkvc-voucher.js"></script>

</body>
</html>
