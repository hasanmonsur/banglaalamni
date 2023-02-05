<?php
include("dbconn.php");
include("bll-common.php");
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
 $amount=0;
 $tranid="";
 $mem_id="";

 function func_tran_save11($traninfo) {

    $mylink=fundb_connect();

    begin($mylink); // transaction begins

    $query1 = "INSERT INTO tbl_transaction (mem_id,con_id,tran_date,tran_amt,tran_status) ".
              " values ('".$traninfo->mem_id."','".$traninfo->con_id."','".$traninfo->tran_date."',".$traninfo->tran_amt.",'".$traninfo->tran_status."')";
    mysqli_set_charset($mylink, 'utf8'); 
    $result1 = mysqli_query($mylink,$query1);
    //var_dump($query1);
    $last_inserted =mysqli_insert_id($mylink);
    $traninfo->tran_id=(string)date("Ymd").str_pad($last_inserted, 5, '0', STR_PAD_LEFT);
    if(!$result1){    
        rollback($mylink); // transaction rolls back
        //echo "transaction rolled back";
        exit;
    }else{
        commit($mylink); // transaction is committed
        //echo "Database transaction was successful";
        $opstat=true;
    }  

    return $traninfo->tran_id;
 }

if(isset($_GET) && !empty($_GET)) {  
   $amount=4000;
   $amount1=number_format(4000,2);
   $mem_id=$_GET['memberid'];
   $memname=$_GET['rmemname'];
   //var_dump($mem_id);
   $paymenttime=date("h:i:s", strtotime("now"));
   $tran_date=date("Y-m-d");   
   $tran_status="N"; 
   $convid='99000';
   $traninfo=new tran('',$mem_id,$convid , $tran_date,$amount,$tran_status,null,null); 
   //var_dump($traninfo);   
   $tranid=func_tran_save11($traninfo);

   $_SESSION["invoiceno"]=$tranid;

   //var_dump($tranid);
}

?>
<div class="container border" >
  <div class="col-lg-12 border">
    <div class="PrintArea"><br><br><br>
      <div style="border:1px solid; text-align: center;" class="border text-center">
      <table>
       <tr>
         <td width="40%">
          <div class="col-lg-12"><br>
           <img src="img/rual_n.jpg" alt="BDA(RU)"  width="100">
           </div>
          </td>
         <td width="60%">
          <div class="col-lg-12">
          <img src="img/logo-ru.gif" alt="BDA(RU)"  width="100%"><br><br>
          <h3>মেম্বার রেজিশট্রেশন<h3> 
          </div>
         </td>
         
       </tr>
      </table>      
      </div>
      <div style="border:1px solid; text-align: center;"  class="border text-center">        
        <h4 class="modal-title" id="exampleModalLabel">Payment Voucher</h4>       
        <input type="hidden" style="border:0px;" id="memberid" value="<?php echo $mem_id; ?>" name="memberid">
        <input type="hidden" style="border:0px;" id="convid" value="<?php echo $convid; ?>" name="convid">
        
      </div>
      <div style="border:1px solid; text-align: justify;"  class="border text-justify">
        <h6>Invoice #: <input type="text" style="border:0px; width: 20% " id="tranid" name="tranid" value="<?php echo $tranid; ?>"> || 
        &nbsp;STATUS: <input type="text" style="border:0px; width: 9%; color:RED;" id="tran_status" placeholder="UNPAID" name="tran_status">  ||
          &nbsp; MEMBER ID : <input type="text" style="border:0px; width: 20% ;color:GREEN;" id="txtmem_id" name="txtmem_id" value="<?php echo $mem_id; ?>"> 
         &nbsp; Time: <input type="text" style="border:0px;" id="paymenttime" name="paymenttime" value="<?php echo $paymenttime; ?>"><h6>
      </div>
      <div style="border:1px solid;" class="modal-body">
        <div class="row">
         <div class="col-sm-4">Member Name:</div>
         <div class="col-sm-8"><input type="text" style="border:0px;" id="txtmembername" name="txtmembername" value="<?php echo $memname; ?>"></div>
        </div>
        <div class="row">
         <div class="col-sm-4">Payment Amount:</div>
         <div class="col-sm-8"><input type="text" style="border:0px;" id="txtregiamt" name="txtregiamt" value="<?php echo $amount; ?>"></div>
        </div>
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
<script src="js/bkvcregi.js"></script>

<script type="text/javascript">
    //var scriptLink="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js";
    var scriptLink="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js";  
    //console.log(JSON.stringify(scriptLink));
    //var accessToken='';
        
    $(document).ready(function(){
        var paymentConfig={
            createCheckoutURL:"createpayment.php",
            executeCheckoutURL:"executepayment.php",
            queryCheckoutURL:"querypayment.php",
            searchCheckoutURL:"searchpayment.php"
        };  
        //console.log(JSON.stringify(accessToken));
        var paymentRequest;
        var paymentID='';
        var trStat=$("#tran_status").val();
        var vrconvid=$("#convid").val();
        var vrmemid=$("#txtmem_id").val();

		     if(trStat=='PAID')
		   	 {
           $("#bKash_button").hide();
         }
         else{
           $("#bKash_button").show();
         }
            //var strdata=$("#totalamt").val();
            //strdata=strdata.replace(/[$,]+/g,"");
            //alert(strdata);

            var totalamt=parseInt(($("#totalamt").val()));
            
            var tranid=$("#tranid").val();   
            //var merchantAssociationInfo=''; 
            //alert(tranid);               
            paymentRequest = { amount:totalamt,intent:'sale',currency:'BDT',merchantInvoiceNumber: tranid};
            //console.log(JSON.stringify(paymentRequest));
       

      $.getScript(scriptLink).done(function(script){
        //console.log('scriptLink :: link success');    
        //alert('Hi.......'+accessToken);
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function(request){
                //console.log('=> createRequest (request) :: ');
                //console.log(request);            
                $.ajax({
                    url: paymentConfig.createCheckoutURL+"?amount="+paymentRequest.amount+"&invoice="+paymentRequest.merchantInvoiceNumber,
                    type:'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        //console.log('got data from create  ..');
                        //console.log('data ::=>');
                        //console.log(JSON.stringify(data)); 
                        //alert(data);
                        var obj = JSON.parse(data);  
                        //alert(data);                      
                        if(data && obj.paymentID != null){
                            paymentID = obj.paymentID;
                            //alert(paymentID);
                            bKash.create().onSuccess(obj);
                        }
                        else {
							              alert('Tran. Status : '+data.statusmsg);
                            bKash.create().onError();
                        }
                    },
                    error: function(){
                        //console.log('error');
                        alert('Bkash Connection Failed, Please try after some time..!!');
                        bKash.create().onError();
                    }
                });
            },            
            executeRequestOnAuthorization: function(){
                //console.log('=> executeRequestOnAuthorization');
                $.ajax({
                    url: paymentConfig.executeCheckoutURL+"?paymentID="+paymentID+"&amount="+paymentRequest.amount+"&tranid="+paymentRequest.merchantInvoiceNumber+"&vrconvid="+vrconvid+"&vrmemid="+vrmemid,
                    type: 'GET',
                    contentType:'application/json',
                    success: function(data){
                        //console.log('got data from execute  ..');
                        //console.log('data ::=>');
                        //console.log(JSON.stringify(data));
                        //alert('[SUCCESS] data1 : ' + JSON.stringify(data));
                        data = JSON.parse(data);
                        if(data && data.statuscode=='200'){
                           /*
                           $.ajax({
                                  url: paymentConfig.searchCheckoutURL+"?trxID="+data.trxID,
                                  type: 'GET',
                                  contentType:'application/json',
                                  success: function(sdata){
                                     sdata = JSON.parse(sdata);
                                    if(sdata && sdata.statuscode=='200'){
                                       // location.reload();
                                    }
                              }
                           });  */

                           location.reload();                         
                        }
                        else if(data && data.statuscode=='201'){
                                $.ajax({
                                  url: paymentConfig.queryCheckoutURL+"?paymentID="+paymentID,
                                  type: 'GET',
                                  contentType:'application/json',
                                  success: function(qdata){
                                     qdata = JSON.parse(qdata);
                                    if(qdata && qdata.statuscode=='200'){
                                      alert('TR error..!!'); 
                                      location.reload();
                                    }
                                    else if(qdata && qdata.statuscode=='203'){
                                      alert('Tran. Failed: Transaction not completed');
                                      bKash.execute().onError();
                                    }
                                    else {
                                      alert('Tran. Failed : System error..!!'); 
                                      bKash.execute().onError();
                                    }
                                  }
                           });  
                        }
                        else {
                            alert('Tran. Failed : '+data.statusmsg);                        

                            bKash.execute().onError();
                        }
                    },
                    error: function(){
                        bKash.execute().onError();
                    }
                });
            },
            onClose : function () {
                    //define what happens if the user closes the pop up window
                  location.reload();
                //your code goes here
            }
        });        

       });

      console.log("Right after init ");
    });
	
	  function callReconfigure(val){
        bKash.reconfigure(val);
    }

    function clickPayButton(){
        $("#bKash_button").trigger('click');
    }      

  </script>
    
</body>
</html>
