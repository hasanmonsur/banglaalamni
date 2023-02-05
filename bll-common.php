<?php
//include("dbconn.php");
Class log {

  function fun_return_conv111($convid) {

    //$myBag = new bag($memberid,$guestid,$guestname, $gender, $dresssize);

    return true;
  }
//const USER_ERROR_DIR = 'logs/log_errors_'.$date.'.log';
  public function user($msg,$username)
    {
      date_default_timezone_set("Asia/Dhaka");
      $gmdate= date("Y-m-d h:i:sa");
      
      $date11 = date('d-m-Y');
      $USER_ERROR_DIR = 'logs/log_errors_'.$date11.'.log';

      //$date = date('d.m.Y h:i:s');
    $log ="Date:  ".$gmdate." : ".$msg."\n";
    error_log($log, 3, $USER_ERROR_DIR);
    }


  public function general($msg)
    {
      date_default_timezone_set("Asia/Dhaka");
      $date11 = date('d-m-Y');
      $GENERAL_ERROR_DIR = 'logs/log_operation_'.$date11.'.log';
     
      $gmdate= date("Y-m-d h:i:sa");

    $log ="Date:  ".$gmdate." : ".$msg."\n";
    error_log($log, 3, $GENERAL_ERROR_DIR);
    }

  }

  ?>