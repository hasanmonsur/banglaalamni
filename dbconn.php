<?php

// trans.php
function begin($mylink){
    mysqli_query($mylink,"BEGIN");
}

function commit($mylink){
    mysqli_query($mylink,"COMMIT");
}

function rollback($mylink){
    mysqli_query($mylink,"ROLLBACK");
}



function fundb_connect(){
    $mylink=null;
    $mysql_hostname="localhost";

    $mysql_username="root";
    $mysql_password="";
    $mysql_database="db_onlinepay";

    /*$mysql_username="b2d0a1ru6_b2bSmicr";
    $mysql_password="Smicr@2015#";
    $mysql_database="b2d0a1ru6_onlinepayment";*/

    try{    
     $mylink=mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);

     }catch(Exception $e){
     //echo "Message: " . $e->getMessage();
     }

    return $mylink;
}



?>