<?php
session_start();

class eventinfo {
      public function __construct( $con_id,$con_name,$con_sdate,$con_edate,$con_mfee,$con_sfee, $con_gfee1,$con_gfee2){
         $this->con_id = $con_id;
         $this->con_name = $con_name;
         $this->con_sdate = $con_sdate;
         $this->con_edate = $con_edate;
         $this->con_mfee = $con_mfee;
         $this->con_sfee = $con_sfee;
         $this->con_gfee1 = $con_gfee1;
         $this->con_gfee2 = $con_gfee2;
      }
   }

class userinfo {
      public function __construct( $user_name,$user_role,$email_id,$status_msg){
         $this->user_name = $user_name;
         $this->user_role = $user_role;
         $this->email_id = $email_id;
         $this->status_msg = $status_msg;
      }
   }

class guest {
      public function __construct( $memberid,$guestid,$guestname, $gender, $dresssize,$dresstype,$amount){
         $this->memberid = $memberid;
         $this->guestid = $guestid;
         $this->guestname = $guestname;
         $this->gender =$gender;
         $this->dresssize = $dresssize;
         $this->dresstype = $dresstype;
         $this->amount = $amount;
      }
   }
   
   class memberinfo {
      public function __construct($mem_id,$member_type,$mem_name,$mem_fname, $mem_mname, $mem_gender,$mem_contact,$mem_email,$mem_preaddress,$mem_peraddress,$own_pass_year,$ms_pass_year,$payment_status){
         $this->mem_id = $mem_id;
         $this->member_type =$member_type;
         $this->mem_name =$mem_name;
         $this->mem_fname =$mem_fname;
         $this->mem_mname = $mem_mname;
         $this->mem_gender =$mem_gender;
         $this->mem_contact = $mem_contact;
         $this->mem_email = $mem_email;
         $this->mem_preaddress = $mem_preaddress;
         $this->mem_peraddress = $mem_peraddress;
         $this->own_pass_year = $own_pass_year;
         $this->ms_pass_year = $ms_pass_year;
         $this->payment_status = $payment_status;
      }
   }
   
   class member {
      public function __construct( $memberid,$convid,$membername, $gender, $dresssize,$feeamount,$totalguest,$totalamount,$mregistat){
         $this->memberid = $memberid;
         $this->convid =$convid;
         $this->membername = $membername;
         $this->gender =$gender;
         $this->dresssize = $dresssize;
         $this->feeamount = $feeamount;
         $this->totalguest = $totalguest;
         $this->totalamount = $totalamount;
         $this->mregistat = $mregistat;
      }
   }

   class registration {
      public function __construct($reg_id,$mem_id, $con_id, $p_type,$reg_name,$reg_gender,$reg_dress, $reg_status){
         $this->reg_id = $reg_id;
         $this->mem_id = $mem_id;
         $this->con_id =$con_id;
         $this->p_type = $p_type;
         $this->reg_name = $reg_name;
         $this->reg_gender = $reg_gender;
         $this->reg_dress = $reg_dress;
         $this->reg_status = $reg_status;
      }
    }
   

   class tran {
      public function __construct( $tran_id,$mem_id, $con_id, $tran_date,$tran_amt,$tran_status,$member_info,$regi_info){
         $this->tran_id = $tran_id;
         $this->mem_id = $mem_id;
         $this->con_id =$con_id;
         $this->tran_date = $tran_date;
         $this->tran_amt = $tran_amt;
         $this->tran_status = $tran_status;
         $this->member_info = $member_info;
         $this->regi_info = $regi_info;         
      }
    }

    

   ?>