<?php

include('assets/config.php');
    session_start();
  if (!isset($_SESSION["id"])) {
    header("location:login.php");
  }else if (isset($_SESSION["id"])){
    $Pid = $_GET["id"];
    $c_id = $_SESSION["id"];
    
    $get = "SELECT * FROM shopping_cart WHERE ProductID = '$Pid' AND clientID = '$c_id'  AND Status = 'Added'" ;
    $login = mysqli_query($con,$get);
    $data =  $login->fetch_assoc();
    $count = mysqli_num_rows($login);
    if($count==1){
      $r = $data['Quantity'] + 1;
      $update = "UPDATE shopping_cart SET Quantity = $r WHERE ProductID = '$Pid' AND clientID = '$c_id' AND Status = 'Added'";
      mysqli_query($con,$update);
    }
    else{
      $insert = "INSERT INTO shopping_cart VALUES (null, '$c_id','$Pid',1,'Added', null)";
      mysqli_query($con,$insert);
    }
    header("location: homepage.php");
  }
?>