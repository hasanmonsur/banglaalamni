<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php 
  // session_start();
   $login_status="";
   $login_role="";
   //$_SESSION["logindata"]="Hasan Monsur";
   //var_dump(json_decode($_SESSION["logindata"]));
   if(isset($_SESSION["logindata"])){ 
     //var_dump("HASAN MONSUR");
    $login_data=json_decode($_SESSION['logindata']);
    $login_status=$login_data->status_msg;
    $login_role=$login_data->user_role;
   // var_dump($login_role);
   }
   else{
     $_SESSION["logindata"]=null;
     $login_status="";
     $login_role="";

   }
   //var_dump("HASAN         efdsjfhsdjfkhsdfjhdsfkjdhsfkj".$login_role);
?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BDA Online Registration</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  

  <!-- Google Fonts  -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

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
  <nav class="navbar navbar-expand-lg bg-primary fixed-top pt-0 text-dark" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <img src="img/logo-ru.gif" alt="BDA(RU)"  width="180px" height="60px"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="">
           <img class="border rounded" src="img/menu.png" alt="menu"  width="40px" height="40px"></a>
          </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-0 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=about">Home</a>
          </li>
          <?php if($login_role=="") { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=application">Event Regi.</a>
          </li>
          <?php 
            }?>
          <?php if($login_role=="") { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=registration">Member Regi. (new)</a>
          </li>
          <?php 
            }else {?>
             <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=registration">Member Regi.(New)</a>
          </li>
          <?php 
            }?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=search">Search (Mem/Event)</a>
          </li>
          <?php if($login_role=="") { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=contact">Contact</a>
          </li>
          <?php 
            }?>
          <?php if($login_role!="" && $login_role!=null) { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=application-admin">Event Regi.</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=admin-report">Report (Event)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?page=admin-mupdate">Member Active</a>
          </li>
          <?php }?>
          <li class="nav-item">
            <?php if($login_role=="") { ?>
            <a class="nav-link js-scroll-trigger" data-toggle="modal" data-target="#loginModal" href="?page=about" >Login</a> 
            <?php 
            }
            if($login_role!="" && $login_role!=null){ ?>            
             <a type="submit" class="btn btn-transparent btn-x nav-link" id="btnapp-logout" href="?page=logout">Logout  
             !  <label id="loginStat"><?php echo $login_status; ?></label></a>
                       
            <?php }?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
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
  
  <!-- Main  Section -->
  <div class="h-100 pt-5 overflow-auto bg-gray text-white p-2">


  <?php
          if(isset($_GET['page']) && !empty($_GET['page'])) $page=$_GET['page'];
          else $page="";

          switch($page){

              case 'about':
              if(file_exists('about.php'))
              {
                include_once('about.php');
                break;
              }
              case 'search':
              if(file_exists('search.php'))
              {
                  include_once('search.php');
                  break;
              }
              case 'contact':
              if(file_exists('contact.php'))
              {
                  include_once('contact.php');
                  break;
              }
              case 'application':
              if(file_exists('application.php'))
              {
                  include_once('application.php');
                  break;
              }
              case 'registration':
              if(file_exists('registration.php'))
              {
                    include_once('registration.php');
                    break;
              }
              case 'application-admin':
                if(file_exists('application-admin.php'))
                {
                      include_once('application-admin.php');
                      break;
                }
              case 'admin-report':
              if(file_exists('admin-report.php'))
              {
                    include_once('admin-report.php');
                    break;
              }
              case 'admin-mupdate':
              if(file_exists('admin-mupdate.php'))
              {
                    include_once('admin-mupdate.php');
                    break;
              }
              case 'logout':
              if(file_exists('about.php'))
              {
                 session_destroy();
                 include_once('about.php');
                 break;
              }
              default:
                 include_once('about.php');
                 break;
              }
    ?>
  </div>
  <!-- Footer -->
  <footer class="bg-info p-1">
  <?php
    //phpinfo();
?>

  <?php  //var_dump("HASAN         efdsjfhsdjfkhsdfjhdsfkjdhsfkj".$_SESSION["logindata"]);
  ?>
    <div class="container">
      <div class="small text-center text-dark">Copyright © 2019 Bangla Department Alumni !!  Developed by <a class="d-block" target="_blank" href="https://neitsbd.com">NEITS</a></div>
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
</body>

</html>
