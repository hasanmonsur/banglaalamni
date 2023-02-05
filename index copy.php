<!DOCTYPE html>
<html lang="en">
<?php 
   session_start();
   $login_status="";
   $login_role="";
   //var_dump(json_decode($_SESSION["logindata"]));
   if(isset($_SESSION["logindata"])){ 
     //var_dump("HASAN MONSUR");
    $login_data=json_decode($_SESSION['logindata']);
    $login_status=$login_data->status_msg;
    $login_role=$login_data->user_role;
    //var_dump($login_role);
   }
   else{
     $_SESSION["logindata"]=null;
     $login_status="";
     $login_role="";

   }
   //var_dump("HASAN");
?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BDA Online Registration</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  

  <!-- Google Fonts 
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
-->
  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.css" rel="stylesheet">
 
  <style>
   #div-notice {
     float: left;
   }
</style>

</head>

<body id="page-top">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <img src="img/logo-ru.gif" alt="BDA(RU)"  width="180"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#application">Event Registration</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#registration">Member Registration</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#search">Search Regi.(Event)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <?php if($login_role!="" && $login_role!=null) { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#admin">Admin</a>
          </li>
          <?php }?>
          <li class="nav-item">
            <?php if($login_role=="") { ?>
            <a class="nav-link js-scroll-trigger" data-toggle="modal" data-target="#loginModal" >Login</a> 
            <?php 
            }
            if($login_role!="" && $login_role!=null){ ?>
             <a class="nav-link js-scroll-trigger" id="btnapp-logout" >Logout !  <label id="loginStat"><?php echo $login_status; ?></label></a>            
            <?php }?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead" id="about">       
    <div class="container h-100">      
      <div class="row h-100 align-items-center justify-content-center text-center">
        
      <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">বাংলা বিভাগ অ্যালামনাই</h1>
          
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light "><h4>রাজশাহী বিশ্ববিদ্যালয়, রাজশাহী</h4></p><br>
          <a class="btn btn-primary btn-xl js-scroll-trigger" style="width:300px;" href="#application">Event Registration</a>
          <a class="btn btn-info btn-xl js-scroll-trigger" style="width:300px;" href="#registration">New Member Registration</a>
        </div><br>
       
      </div>
    </div>
  </header>

  <!-- Event Application -->
  <section class="page-section bg-success" id="application">
    <div class="container p-1 mb-2 bg-info text-white">
      <div class="row justify-content-center">
        <h2>Event Registration</h2>
      </div>
    </div>
    <div class="container  border"><br>
      <div class="row justify-content-center">
        <form action="#">      
        <div class="form-inline p-1 mb-2 bg-warning text-dark">
          <label for="text">Select Event: </label> 
          <select id="drconvid" name="drconvid" class="form-control">
              <option value="202001">তৃতীয় সম্মিলন উৎসব ২০২০</option>
          </select> 
          <label for="text">&nbsp;&nbsp; Member ID: &nbsp;</label> 
           <select id="drmtype" name="drmtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
           </select> &nbsp;
          <input type="text" class="form-control" id="txtmemberid" placeholder="Enter Member ID" name="txtmemberid" required>&nbsp;&nbsp;
        
          <button type="submit" class="btn btn-primary" style="width:200px;" id="btnapp-search">Search</button>
        </div>
        <div> 
          <div class="text-danger"><b><label id="txtmessage" name="txtmessage"></b></div>
        </div>
        <div class="form-inline justify-content-lefts">
          <label for="uname">Member Name:&nbsp;&nbsp;</label>
          <input type="text" class="form-control" style="width:40%" id="txtmembername" placeholder="Enter member name" name="txtmembername" required>
          
          <div class="invalid-feedback">Please fill out this field.</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label for="uname">Member Mobile # :&nbsp;&nbsp;</label>
          <input type="text" class="form-control" id="txtmemmobile" placeholder="Enter mobile number" name="txtmemmobile" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div><br>
        <div class="form-inline justify-content-left">
          <input type="checkbox" style="display: none;" id="mset" name="mset" checked><!--<span class="text-danger">isActive?  </span> &nbsp;&nbsp; | &nbsp;&nbsp;-->
          <label class="text-danger">Member Gender:</label>
          <input type="radio" id="mgender1" name="mgender" value="male"> Male   
          <input type="radio" id="mgender2" name="mgender" value="female"> Female          
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          <div id="div-dress" class="form-inline">
           <label class="text-danger"> | &nbsp;&nbsp;  Member Panjabi Size :</label>
           <!--<input type="text" class="form-control" id="txtmdresssize" placeholder="Enter size" name="txtmdresssize" norequired>-->
           <select id="txtmdresssize" name="txtmdresssize" class="form-control">
              <option value="">---select --</option>
              <option value="34">34</option>
               <option value="36">36</option>
               <option value="38">38</option>
               <option value="40">40</option>
               <option value="42">42</option>
               <option value="44">44</option>
               <option value="46">46</option>
               <option value="48">48</option>
           </select>
           <input type="hidden" class="form-control" id="txtcastamount" placeholder="Enter size" name="txtcastamount" norequired>
           <div class="valid-feedback">Valid.</div>
           <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>
        <div> 
          <div class="text-danger"><b>Please Entry Guest Information in English</b></div>
        </div>
        <div id="div-guest" >
        <div class="form-inline justify-content-left p-3 mb-2 bg-gray text-dark" >          
          <label for="text" class="text-danger">Guest Name &nbsp;</label> 
          <input type="text" class="form-control" id="txtguestname" placeholder="Enter guest name" name="txtguestname" required>
          <span class="text-default font-weight-bold">&nbsp;Relation&nbsp;</span>
          <select id="grel" name="grel" class="form-control">
              <option value="Husband">Husband</option>
              <option value="Wife">Wife</option>
              <option value="Son">Son</option>
              <option value="Daughter">Daughter</option>
          </select>
          
          <label class="text-danger">&nbsp;Gender&nbsp;</label>
          <input type="radio" id="ggender1" name="ggender" value="male"> Male  
          <input type="radio" id="ggender2" name="ggender" value="female"> Female          
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>&nbsp;&nbsp;
          <span class="text-default font-weight-bold">&nbsp;Dress&nbsp;</span>
          <!--<span class="text-default font-weight-bold">With Dress?&nbsp;</span><input type="checkbox" id="gset" name="gset">-->
          <select id="gset" name="gset" class="form-control">
              <option value="">---select --</option>
              <option value="sharee">Sharee</option>
               <option value="panjabi">Panjabi</option>
          </select>
          <div id="div-guest-dress" class="form-inline">
          <label class="text-danger"> &nbsp; Panjabi Size :</label>
          <!--<input type="text" class="form-control" id="txtgdresssize" placeholder="Enter size" name="txtgdresssize" norequired>-->
          <select id="txtgdresssize" name="txtgdresssize" class="form-control">
              <option value="">---select --</option>
              <option value="34">34</option>
               <option value="36">36</option>
               <option value="38">38</option>
               <option value="40">40</option>
               <option value="42">42</option>
               <option value="44">44</option>
               <option value="46">46</option>
               <option value="48">48</option>
           </select>
          </div>
          <button type="submit" class="btn btn-primary btn-x" id="btnapp-add">Add</button>
        </div>
        <div>
        <table class="table table-crossover">
         <thead class="p-3 mb-2 bg-info text-white">
          <tr>
            <th>Name</th>
            <th>Gender</th>            
            <th>Dress</th>   
            <th>Size</th>         
            <th></th>
          </tr>
          </thead>
          <tbody id="tbody-guest" class="p-3 mb-2 bg-secondary text-white">
          
          </tbody>
         </table>     
        </div>
        </div>
        <div class="form-inline p-2 mb-2 bg-warning text-dark">
          <label class="text-danger">Member Fee Amount :</label>
           <input type="text" class="form-control" id="txtamount" style="text-align:right;" placeholder="" name="txtamount" required>          
           
           <label class="text-danger">&nbsp;&nbsp;  Total Fee Amount :</label>
           <input type="text" class="form-control" style="text-align:right;" id="txttotalamount" placeholder="" name="txttotalamount" required>          
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div> 
         <?php if($login_role=="1"){?>        
         <button type="submit" class="btn btn-primary btn-x" id="btnapp-registration">Submit Registration</button>
         <?php } ?> 
        <button type="submit" class="btn btn-danger btn-x" id="btnapp-clear">Clear</button> <!--invisible-->
        <button type="button" class="btn btn-primary invisible" id="btnapp-voucher" data-toggle="modal" data-target="#voucherModal">Open Voucher</button>
      </form>
      </div><br>    
    </div>

    <input type="hidden" style="border:0px;" id="tranid" placeholder=".." name="tranid">
    <input type="hidden" style="border:0px;" id="totalamt" placeholder="0" name="totalamt">
  </section>

<!-- login model-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login ...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
         </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleDropdownFormEmail2">Email address</label>
                <input type="email" class="form-control" id="useremail" name="useremail" placeholder="email address">
              </div>
              <div class="form-group">
                <label for="exampleDropdownFormPassword2">Password</label>
                <input type="password" class="form-control" id="userpass" name="userpass" placeholder="Password">
              </div>              
              <button type="submit" class="btn btn-primary" id="btnapp-login" data-dismiss="modal" >Sign in</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
         <div class="modal-footer">
         
      </div>
    </div>
  </div>
</div>

<!-- new member registrationn -->
  <section class="page-section bg-dark text-white" id="registration">
    <div class="container p-1 mb-2 bg-info text-white">
      <div class="row justify-content-center">
        <h2>Member Information</h2>
      </div>
    </div>
    <div class="container  border"><br>
    <?php if($login_role=="1"){?>
     <div class="container p-1 mb-2 bg-primary text-white">
      <div class="row justify-content-center">
        <h4>Member Status Update</h4>
      </div>
     </div><br>
     <div class="row justify-content-center">     
      <div class="form-inline">
       <label for="uname">Entry Member ID:</label>
       <select id="serchdrmtype" name="serchdrmtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
       </select> &nbsp;&nbsp;&nbsp;
       <input type="text" class="form-control" id="serchmemid" name="serchmemid" placeholder="Enter member id"> &nbsp;&nbsp;&nbsp;
       <label  id="lbmemName" name="lbmemName"></label> &nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="ckStatus" name="ckStatus"> is Active ?&nbsp;&nbsp;&nbsp;
       
       </div><br>
       <div class="form-inline">       
       <button type="submit" class="btn btn-info btn-x" id="btnapp-up-search">Search</button>&nbsp;&nbsp;
      <!-- <button type="submit" class="btn btn-primary btn-x" id="btnapp-mem-list-search">Preview</button>&nbsp;&nbsp;
      <button type="submit" class="btn btn-success btn-x" id="btnapp-mem-list-print">print</button> &nbsp;&nbsp;-->
       <button type="submit" class="btn btn-success btn-x" id="btnapp-up-update">Update</button>
       </div>
       <!--<div class="PrintAreaMem">
        <div class="text-center d-print-none" style="text-align:center;">
        <h4>বাংলা বিভাগ অ্যালামনাই<br>
        <h6>রাজশাহী বিশ্ববিদ্যালয়, রাজশাহী<br>
        <h4> <label id="rpt-name" name="rpt-name"> </label> </h4>
        </div>
        <div class="text-center"><h6><?php
          //$today = date("Y-m-d H:i:s");
          //echo "Print  Date: ". $today;
          ?></h6></div>
        <div id="rpt-memberlist">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>
              <th style="border-bottom: 1px solid;">Mem. Phone </th>
              <th style="border-bottom: 1px solid;">Mem. Type</th>  
              <th style="border-bottom: 1px solid;">Mem. Payment</th>  
          </tr>
          </thead>
          <tbody id="tbody-regi-report-sum-data" style="border: 1px solid;">
          
          </tbody>
          <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>
              <th style="border-bottom: 1px solid;">Mem. Phone </th>
              <th style="border-bottom: 1px solid;">Mem. Type</th>  
          </tr>
          </thead>
         </table>  
        </div> 
     -->
        </div> 
      <br>

    </div><br>
    <?php }?>
<br>
    <div class="container p-1 mb-2 bg-info text-white">
      <div class="row justify-content-center">
        <h4>New Member Registration</h4>
      </div>
    </div>
    <div class="container  border"><br>
      <div class="row justify-content-center">
       <div class="col-lg-5">        
        <div class="form-group">
          <label for="text">Select Member Type:</label> 
          <select id="rmember_type" name="rmember_type" class="form-control">
              <option value="N">--select--</option>   
              <?php if($login_role=="1"){?>                 
              <option value="">Life Member</option> 
              <option value="G">General Member</option>  
              <?php }?>     
              <option value="S" selected="selected">Student</option>
          </select>           
        </div>        
        <div class="form-group">
          <label for="uname">Member Name:</label>
          <input type="text" class="form-control" id="rmem_name" placeholder="Enter member name" name="rmem_name" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>        
        <div class="form-group">
          <label for="uname">Father's Name:</label>
          <input type="text" class="form-control" id="rfather_name" placeholder="Enter father name" name="rfather_name" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div> 
        <div class="form-group">
          <label for="uname">Mother's Name:</label>
          <input type="text" class="form-control" id="rmother_name" placeholder="Enter mother name" name="rmother_name" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
          <label for="text">Select Gender:</label> 
          <select id="gender_type" name="gender_type" class="form-control">
              <option value="male">Male</option>
              <option value="female">Female</option>
          </select>           
        </div>        
       </div>
       <div class="col-lg-7">
        <div class="form-group">
          <label for="uname">Present Address:</label>
          <input type="text" class="form-control" id="rpre_address" placeholder="Enter present address" name="rpre_address" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>        
        <div class="form-group">
          <label for="uname">Permament Address:</label>
          <input type="text" class="form-control" id="rper_address" placeholder="Enter permament address" name="rper_address" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>  
        <div class="form-group">
          <label for="uname">Mobile/Phone #:</label>
          <input type="text" class="form-control" id="rphone_no" placeholder="Enter phone number" name="rphone_no" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        <div class="form-group">
          <label for="uname">E-mail Address:</label>
          <input type="text" class="form-control" id="remail_add" placeholder="Enter email address" name="remail_add" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        <div id="div-session-year">
         <div class="form-group">
          <label >Hon's session year:</label>
          <input type="text" class="form-control" id="rhonor_session" placeholder="yyyy-yyyy" name="rhonor_session">          
          </div>   
        </div>    
        <div id="div-pass-year">
          <div class="form-group">
          &nbsp;&nbsp;<label >Hon's pass year:</label>
          &nbsp;&nbsp;<input type="text" class="form-control" id="rhonor_pass" placeholder="yyyy" name="rhonor_pass">          
          </div>
          <div class="form-group">          
          &nbsp;&nbsp;<label >Mast's pass year:</label>
          &nbsp;&nbsp;<input type="text" class="form-control" id="rmaster_pass" placeholder="yyyy" name="rmaster_pass">
          </div> 
         </div> 
         <button type="submit" class="btn btn-primary btn-x" id="btnapp-mem-registration">New Registration</button>&nbsp;&nbsp;
         <?php if($login_role=="1"){?> 
         <button type="submit" class="btn btn-info btn-x" id="btnapp-mem-regi-update">Update</button>&nbsp;&nbsp;
         <?php }?>
         <button type="submit" class="btn btn-danger btn-x" id="btnapp-reg-clear">Clear</button> <br> <br>    
      </div><br>    
    </div>
  </section>

  <!-- event payment admin report -->
  <?php if($login_role=="1"){?>
  <section class="page-section bg-primary text-white" id="admin">
    <div class="container p-1 mb-2 bg-info text-white">
      <div class="form-inline bg-success border">
        &nbsp;&nbsp;
        <select id="sradrconvid" name="sradrconvid" class="form-control">
              <option value="202001">তৃতীয় সম্মিলন উৎসব ২০২০</option>  
              <option value="99000">সদস্য নিবন্ধন ফি</option>              
        </select> &nbsp;&nbsp;
        <select id="sradmtype" name="sradmtype" class="form-control">
              <option value="">---Applicent Type --</option>
              <option value="M">Member</option>
               <option value="G">Guest</option>
        </select>&nbsp;&nbsp;
        <select id="sradgset" name="sradgset" class="form-control">
              <option value="">---Drass Type --</option>
              <option value="sharee">Sharee</option>
               <option value="panjabi">Panjabi</option>
        </select>&nbsp;&nbsp;
         <select id="sradresssize" name="sradresssize" class="form-control">
              <option value="">---Size --</option>
              <option value="34">34</option>
               <option value="36">36</option>
               <option value="38">38</option>
               <option value="40">40</option>
               <option value="42">42</option>
               <option value="44">44</option>
               <option value="46">46</option>
               <option value="48">48</option>
               <option value="0">sharee-12</option>
           </select>&nbsp;&nbsp;
          <input type="radio" id="rptype" name="rptype" value="D" checked> Details  &nbsp;&nbsp;
          <input type="radio" id="rptype" name="rptype" value="S"> Summary  &nbsp;&nbsp;

        <button type="submit" class="btn btn-primary" id="btnapp-regi-report">Preview</button>&nbsp;&nbsp;
        <button type="submit" class="btn btn-primary btn-x" id="btnapp-print">print</button>        
        <br><br>
    </div>
    <div>

    </div>
      <div>      
      </div>
      <div class="PrintArea">
        <div class="text-center d-print-none" style="text-align:center;">
        <h4>বাংলা বিভাগ অ্যালামনাই<br>
        <h6>রাজশাহী বিশ্ববিদ্যালয়, রাজশাহী<br>
        <h4> <label id="rpt-name" name="rpt-name"> </label> </h4>
        </div>
        <div class="text-center"><h6><?php
          $today = date("Y-m-d H:i:s");
          echo "Print  Date: ". $today;
          ?></h6></div>
      <div id="rpt-details">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Applicent</th>
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Applicent Name</th>
              <th style="border-bottom: 1px solid;">Gender</th>
              <th style="border-bottom: 1px solid;">Dress Type</th>  
              <th style="border-bottom: 1px solid;">Size</th>             
              <th style="border-bottom: 1px solid;">Event Regi. ID</th>
              <th style="border-bottom: 1px solid;">Tran. ID</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-report-data" style="border: 1px solid;">
          
          </tbody>
           <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;">Total</th>
              <th style="border-bottom: 1px solid;">Person: </th>  
              <th style="border-bottom: 1px solid;"> <label id="dtCount" ></label></th>             
              <th style="border-bottom: 1px solid;">Amount:</th>
              <th style="border-bottom: 1px solid;"> <label id="dtAmt" ></label></th>
          </tr>
          </thead>
        </table>  
      </div>
      <div id="rpt-summary">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>
              <th style="border-bottom: 1px solid;">T. Guest</th>
              <th style="border-bottom: 1px solid;">T. Male</th>  
              <th style="border-bottom: 1px solid;">T. Fmale</th>             
              <th style="border-bottom: 1px solid;">T. Panjabi</th>
              <th style="border-bottom: 1px solid;">T. Sharee</th>
              <th style="border-bottom: 1px solid;">Total Person</th>
              <th style="border-bottom: 1px solid;">Total Amount</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-report-sum-data" style="border: 1px solid;">
          
          </tbody>
          <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;"</th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>
              <th style="border-bottom: 1px solid;"></th>  
              <th style="border-bottom: 1px solid;">Total</th>             
              <th style="border-bottom: 1px solid;">Member: </th>
              <th style="border-bottom: 1px solid;"><label id="smCount" ></label></th>
              <th style="border-bottom: 1px solid;">Amount: </th>
              <th style="border-bottom: 1px solid;"><label id="smAmt" ></label></th>
          </tr>
          </thead>
        </table>  
      </div> 
      
      <div id="rpt-mem-payment">  
        <table class="table table-crossover border" style="border: 1px solid black;">
         <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Member ID</th>
              <th style="border-bottom: 1px solid;">Member Name</th>              
              <th style="border-bottom: 1px solid;">Regi. Date</th>
              <th style="border-bottom: 1px solid;">Fee Amount</th>
              <th style="border-bottom: 1px solid;">Tran. ID</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-report-mem-data" style="border: 1px solid;">
          
          </tbody>
          <thead class="bg-danger" style="border-top: 1px solid;">
          <tr style="border: 1px solid; border-bottom: 1px solid;">
              <th style="border-bottom: 1px solid;">Total</th>             
              <th style="border-bottom: 1px solid;">Member: </th>
              <th style="border-bottom: 1px solid;"><label id="mCount" ></label></th>
              <th style="border-bottom: 1px solid;">Amount: </th>
              <th style="border-bottom: 1px solid;"><label id="mAmt" ></label></th>
          </tr>
          </thead>
        </table>  
      </div> 

      </div>    
    </div>
  </section>

  <?php }?>
  <!-- search payment status -->
  <section class="page-section bg-info text-white" id="search">
     <div class="container">
      <div class="form-inline">       
        <label for="text">Select Event:</label> 
        <select id="srdrconvid" name="srdrconvid" class="form-control">
              <option value="202001">তৃতীয় সম্মিলন উৎসব ২০২০</option>
        </select> 
        <label for="text">Enter Member ID: </label> 
        <select id="srdrmtype" name="srdrmtype" class="form-control">
              <option value="">Life</option>
              <option value="G">General</option>
              <option value="S">Student</option>
        </select> &nbsp;
        <input type="text" class="form-control" id="srtxtmember" placeholder="Enter member id" name="srtxtmember">
        <label for="text">TRAN ID: </label> 
        <input type="text" class="form-control" id="sertranid" placeholder="Enter transaction no" name="sertranid">
        <button type="submit" class="btn btn-primary" id="btnapp-regisearch">Search</button>
      </div><br>

      <div>
        <table class="table table-crossover border">
         <thead class="bg-info">
          <tr>
            <th>Reg-Type</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Dress Type</th>
              <th>Size</th>
              <th>Amount</th>
          </tr>
          </thead>
          <tbody id="tbody-regi-data">
          
          </tbody>
         </table>     
        </div>    
    </div>
  </section>
  <!-- Contact Section -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Let's Get In Touch!</h2>
          <hr class="divider my-4">
          <p class="text-muted mb-5">Address: কক্ষ-১৪৬, শহীদুল্লাহ কলাভবন, বাংলা বিভাগ, রাজশাহী বিশ্ববিদ্যালয়!</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div>01718-001817, 02-9514437</div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in anchor text AND the link below! -->
          <a class="d-block" href="mailto:aapelabdullah@gmail.com">aapelabdullah@gmail.com</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright © 2019 Bangla Department Alumni !!  Developed by <a class="d-block" target="_blank" href="https://www.neitsbd.com">NEITS</a></div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  
  <!-- Custom scripts for this template -- <script src="js/jquery-1.8.3.min.js"></script> -->
  <script src="js/creative.min.js"></script>
  <script src="js/jquery.PrintArea.js"></script>
  
  <script src="js/main.js"></script>
  <script>
  /*var windowName = 'userConsole';
  var popUp = window.open('loder-info.php', windowName, 'width=80, height=80, left=0, top=0, scrollbars, resizable');
  if (popUp == null || typeof(popUp)=='undefined') {
     alert('Please disable your pop-up blocker and click the "Open" link again.');
  }
  else {
    popUp.focus();
    popUp.close();
  }  */
  </script>
</body>

</html>
