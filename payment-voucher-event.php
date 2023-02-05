<?php
//session_start();
include("dbconn.php");
include("dao-common.php");
include("bll-common.php");

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
$tranid='';
$paymenttime="";//date("h:i:s", strtotime("now"));
$tran_date="";//"";             
$memname="";  
$amount=""; 
$tranid1="";     


 if(isset($_GET) && !empty($_GET)) { 
  $mem_id=$_GET['memberid'];
  $convid=$_GET['convid'];//99000';'202201';  

    $mylink=fundb_connect();

    $query1 = "select t.tran_id,t.tran_amt,t.entry_date, t.tran_date,m.mem_id,m.mem_name,m.temp_mem_id,(select chl_trxid from tbl_payinfo p where p.tran_id=t.tran_id) as chl_trxid from tbl_member m,tbl_transaction t where ".
              " (m.mem_id='".$mem_id."' OR m.temp_mem_id='".$mem_id."') AND  t.tran_status='Y' and (m.mem_id=t.mem_id OR m.temp_mem_id=t.mem_id) and t.con_id like'".$convid."%';";
             
    //var_dump($query1);
    //var_dump($mylink);

    mysqli_set_charset($mylink, 'utf8'); 
    $amount=0;
    $result1 = mysqli_query($mylink,$query1);
    while ($row = mysqli_fetch_assoc($result1)) {

      $memberid=$row['mem_id'];
      if($row['temp_mem_id']!="")
      $memname=$row['mem_name']." (".$row['temp_mem_id'].")";
      else 
      $memname=$row['mem_name'];
      $amount=$amount+$row['tran_amt'];
      $tranid=$row['tran_id'];
      $tranid1=$row['tran_id']." bKash ID: ".$row['chl_trxid'];
      $paymenttime=$row['entry_date'];
      $tran_date=$row['tran_date'];

    }


   if($memname!=""){
    $amount=number_format($amount,2);
    $tran_status="PAID"; 
   }

  //var_dump($mem_id);

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
        <input type="hidden" style="border:0px;" id="memberid" value="<?php echo $mem_id; ?>" name="memberid">
        <input type="hidden" style="border:0px;" id="convid" value="<?php echo $convid; ?>" name="convid">
        <input type="hidden" style="border:0px;" id="tranid" value="<?php echo $tranid; ?>" name="tranid">
        
      </div>
      <div style="border:1px solid; text-align: justify;"  class="border text-justify">
        <h6>Invoice #: <input type="text" style="border:0px; width: 16% " id="tranid1" value="<?php echo $tranid1; ?>" name="tranid1"> || 
        &nbsp;STATUS: <input type="text" style="border:0px; width: 9%; color:RED;" id="tran_status" placeholder="UNPAID" name="tran_status">  ||
          &nbsp; MEMBER ID : <input type="text" style="border:0px; width: 8% ;color:GREEN;" id="txtmem_id" name="txtmem_id" value="<?php echo $mem_id; ?>"> 
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
          <input type="text" style="border:0px;" id="totalamt" value="<?php echo $amount; ?>" name="totalamt"> 
        </p> 
      </div>
    </div>
      <div class="modal-footer border">
        <button type="submit" class="btn btn-danger btn-xl" id="btnapp-print-02">print</button>        
      </div>
    </div>
  </div>   

  <script src="js/bkvc-voucher.js"></script>
 


</body>
</html>
