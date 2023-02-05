<?php
session_start();
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
<script src="js/bkvc.js"></script>

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
		
		     if(trStat=='PAID')
		   	 {
           $("#bKash_button").hide();
         }
            //var strdata=$("#totalamt").val();
            //strdata=strdata.replace(/[$,]+/g,"");
            //alert(strdata);

            var totalamt=parseInt(($("#totalamt").val()));

            var tranid=$("#tranid").val();   
            //var merchantAssociationInfo='';                
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
                    url: paymentConfig.executeCheckoutURL+"?paymentID="+paymentID+"&amount="+paymentRequest.amount+"&tranid="+paymentRequest.merchantInvoiceNumber+"&vrconvid=&vrmemid=",
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
