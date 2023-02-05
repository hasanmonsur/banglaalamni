<?php
class bkashpayment {
      public function __construct( $tran_id,$chl_id,$chl_trxid,$chl_session1, $chl_session2, $pay_amt,$pay_com, $pay_status){
         $this->tran_id = $tran_id;
         $this->chl_id = $chl_id;
         $this->chl_trxid = $chl_trxid;
         $this->chl_session1 = $chl_session1;
         $this->chl_session2 =$chl_session2;
         $this->pay_amt = $pay_amt;
         $this->pay_com = $pay_com;
         $this->pay_status = $pay_status;
      }
   }

   class execresponse{
      public function __construct( $amount,$createTime, $currency, $intent,$merchantInvoiceNumber,$paymentID,$transactionStatus,$trxID,$updateTime,$statuscode,$statusmsg){
         $this->amount = $amount;
         $this->createTime = $createTime;
         $this->currency =$currency;
         $this->intent = $intent;
         $this->merchantInvoiceNumber = $merchantInvoiceNumber;
         $this->paymentID = $paymentID;
         $this->transactionStatus = $transactionStatus;
         $this->trxID = $trxID; 
         $this->updateTime = $updateTime;  
         $this->statuscode = $statuscode;  
         $this->statusmsg = $statusmsg;   

      }
   }

   class createresponse{
      public function __construct( $paymentID,$createTime, $amount, $currency,$transactionStatus,$merchantInvoiceNumber,$statuscode,$statusmsg){        
         $this->paymentID = $paymentID;
         $this->createTime = $createTime;
         $this->amount =$amount;
         $this->currency = $currency;
         $this->transactionStatus = $transactionStatus;
         $this->merchantInvoiceNumber = $merchantInvoiceNumber;
         $this->statuscode = $statuscode;  
         $this->statusmsg = $statusmsg;   
      }
      
    }
   class searchresponse{
      public function __construct( $trxID,$completedTime, $amount, $currency,$customerMsisdn,$initiationTime,$transactionReference,$transactionStatus,$statuscode,$statusmsg){        
         $this->trxID = $trxID;
         $this->completedTime = $completedTime;
         $this->amount =$amount;
         $this->currency = $currency;
         $this->customerMsisdn = $customerMsisdn;
         $this->initiationTime = $initiationTime;
         $this->transactionReference = $transactionReference;  
         $this->transactionStatus = $transactionStatus; 
         $this->statuscode = $statuscode; 
         $this->statusmsg = $statusmsg;   
      }
      
    }

?>