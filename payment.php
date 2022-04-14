<?php
session_start();


  if (!isset($_SESSION["id"])) {
    header("location:A_Login.php");
  }
error_reporting(0);
include('assets/config.php');?>

<?php
$pid = $_GET["pid"];
$quantity = $_GET["quantity"];
$price = $_GET["price"];
$cid = $_SESSION["id"];

$str_arr1 = explode (",", $pid); 
$courierID = $_GET["courierID"];
$addressID = $_GET["addressID"];
$cart = $_GET["cartID"];

$totalQuan = $_GET['totalQuan'];
$now = date("Y-m-d");

$get_courier_info = "SELECT * FROM courier WHERE CourierID = '$courierID'";
$row_courier = mysqli_query($con, $get_courier_info);
$rows_courier = mysqli_fetch_assoc($row_courier);

$kg = $totalQuan/1000;
if($kg<=0.5){
    $deliveryFees = $rows_courier['CourierPrice'];
}else{
    $deliveryFees = (($kg - 0.5)*$rows_courier['CourierPrice2'])+$rows_courier['CourierPrice'];
}
  

$voucher = $_POST['voucher'];
?>

<?php

if(isset($_POST['Apply'])){

    
    $now = date("Y-m-d");
    $get_voucher_info = "SELECT * FROM voucher WHERE VoucherCode = '$voucher' AND VoucherStatus = 'Active' AND VoucherExpiredDate > '$now' AND VoucherAmount > 0";
    $row_voucher = mysqli_query($con, $get_voucher_info);
    $data =  $row_voucher->fetch_assoc();
    $count = mysqli_num_rows($row_voucher);

    if($count==1)
    { 
        $num = $data['VoucherAmount'];
        $one = 1;
        $new = $num - $one;
        $update_voucher_info = "UPDATE voucher SET VoucherAmount='$new' WHERE VoucherCode = '$voucher'";
        mysqli_query($con, $update_voucher_info);
        $voucherprice = $data["VoucherPrice"];
    }
    else{
        $voucherprice = 0;
        echo "<script>alert('Voucher Code is invalid');</script>";
    }
}

if(isset($_POST['paynow'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K7YXXC7PCB562','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['cimb'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://www.cimbclicks.com.my/clicks/#/','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['alliance'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://www.allianceonline.com.my/personal/login/login.do','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['rhb'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://logon.rhb.com.my/?_ga=2.185140073.1923772556.1649877961-130396466.1649877961','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['standard'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://retail.sc.com/my/nfs/login.htm?intcid=p-s-online-banking-login&_ga=2.128301964.147821802.1649877999-2073744222.1649877999','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['maybank'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://www.maybank2u.com.my/home/m2u/common/login.do','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['muamalat'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://www.i-muamalat.com.my/rib/index.do','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['bsn'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://www.mybsn.com.my/mybsn/login/login.do','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['pbe'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://www2.pbebank.com/myIBK/apppbb/servlet/BxxxServlet?RDOName=BxxxAuth&MethodName=login','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}

if(isset($_POST['am'])){
    $get = "SELECT * FROM orderdetail ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $neworder = sprintf("O%05d", $count + 1);
    

    $insert = "INSERT INTO orderdetail VALUES ('$neworder','$pid','$cid','$cart','$quantity','Ordered','$price','$courierID','$now','$addressID',null)";
    mysqli_query($con, $insert);
    
    $str_arr1 = preg_split ("/\,/", $pid);
    $str_arr2 = preg_split ("/\,/", $quantity);
    $str_arr3 = preg_split ("/\,/", $cart);
    $i = sizeof($str_arr1);
    
    for($k = 0; $k<$i; $k++)
    {
        $CC1[$k]=$str_arr1[$k];//ProductID
        $CC2[$k]=$str_arr2[$k];//ProductID
        $CC3[$k]=$str_arr3[$k];//cart

        $date = date('Y-m-d');
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='0' WHERE `clientID` = '$cid'");
        $result1 = mysqli_query($con,"UPDATE shopping_cart SET Status = 'Ordered',date = '$date' WHERE ProductID = '".$CC1[$k]."' AND cartID = '$CC3[$k]'");
        mysqli_query($con, $result1);

        
        $result1 = mysqli_query($con,"SELECT * FROM product WHERE ProductID = '".$CC1[$k]."'");
        $result = mysqli_query($con, $result1);
        $row = mysqli_fetch_assoc($result);

    } 
    echo "<script>window.open('https://ambank.amonline.com.my/web/','_blank' );</script>";

    echo "<script>window.location.href='homepage.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <title>Joo Fa Trading</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/cart.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <style>
    .yellow {
        background-color: #ecc92b;
    }

    h5 {
        text-align: left;
        font-size:15px;
        color:black;

    }

    .btn.circular {
        border-radius: 50em !important;
    }
    </style>
    <?php
    if(isset($_POST['coin']))
    {
        $discoin1 = $_POST['coindis'];
        echo "<style>.f{background-color:yellow}</style>";
    }
    ?>
</head>



<body>
    <?php include('assets/C_header.php'); ?>



    <!-- Open Content -->
    <div id="cart" style="max-width:1060px">
        <h1>Your Cart</h1>
        <?php
            $getinfo = "SELECT * FROM address WHERE AddressID = '$addressID'";
            $row_address = mysqli_query($con, $getinfo);
            $rows_address = mysqli_fetch_assoc($row_address);
            echo $rows_address['AddressName'];
            echo ":";
            echo $rows_address['Address'];
            ?>
        <input type="hidden" name="productID" id="productID" value="<?php echo $pid?>">
        <input type="hidden" name="quantity" id="quantity" value="<?php echo $quantity?>">
        <input type="hidden" name="price" id="price" value="<?php echo $price?>">
        <input type="hidden" name="courierID" id="courierID" value="<?php echo $courierID ?>">
        <input type="hidden" name="addressID" id="addressID" value="<?php echo $addressID ?>">
        <input type="hidden" name="cid" id="cid" value="<?php echo $cid?>">

        <div class="container-fluid">
            <div class="row align-items-start">
                <div class="col-12 col-sm-8 items">
                    <!--1-->
                    <?php $o=array(); 
                        
                        $productid = array();
                        $quan = array();?>

                    <?php 
                            $i = 0;
                            $id = $_SESSION['id'];
                            $result = mysqli_query($con,"SELECT sc.Quantity, sc.ProductID, p.ProductName, p.ProductPic, p.ProductPrice, sc.Status, sc.clientID FROM shopping_cart as sc INNER JOIN product as p ON p.ProductID = sc.ProductID Where sc.clientID = '$id' AND Status='Added' GROUP BY (sc.ProductID) ORDER BY sc.ProductID ASC;                            ");
                            while ($row = mysqli_fetch_array($result)) {  
                                
                            ?>
                    <div class="cartItem row align-items-start">
                        <div class="col-3 mb-2">
                            <img class="w-100" src="<?php echo $row['ProductPic']?>" alt="art image">
                        </div>
                        <div class="col-5 mb-2">
                            <h6 class=""><?php echo $row["ProductName"]; ?></h6>
                        </div>
                        <div class="col-2">
                            <p class="cartItemQuantity p-1 text-center"><?php echo $row["Quantity"]; ?></p>
                        </div>
                        <div class="col-2">
                            <p id="cartItem1Price"><?php echo $row["ProductPrice"]; ?></p>
                            <input type="hidden" name="id" value="<?php echo $row['ProductID']?>">
                        </div>
                    </div>
                    <hr>
                    <?php
                        $o[] = $row["Quantity"] * $row["ProductPrice"];
                        $productid[]=$row['ProductID'];
                        $weight[] = $row['weight'];
                        $quan[] = $row['Quantity'];
                    }
                    
                    $commaSeparated = implode(',' , $productid);
                    
                    $commaSeparatedWeight = implode(',' , $weight);
                    $commaSeparatedQuan = implode(',' , $quan);
                    
                    ?>
                </div>
                <div class="col-12 col-sm-4 p-3 proceed form">

                    <div class="row m-0">
                        <div class="col-sm-8 p-0">
                            <h5>Subtotal</h5>
                        </div>
                        <div class="col-sm-4 p-0">
                            <?php $total =  array_sum($o)?>
                            <p id="subtotal">RM<?php echo $total;?></p>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-sm-8 p-0 ">
                            <h5>Tax</h5>
                        </div>
                        <div class="col-sm-4 p-0">
                            <p id="tax">RM<?php echo sprintf('%0.2f', $total * 0.06); ?></p>
                        </div>
                    </div>

                    <form method="post" enctype="multipart/form-data">
                        <div class="row m-0">
                            <div class="col-sm-8 p-0 ">
                                <h5>Delivery Fees</h5>
                            </div>
                            <div class="col-sm-4 p-0">
                                <p id="tax">RM<?php echo $deliveryFees ?></p>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-8 p-0 ">
                                <h5>Voucher</h5>
                            </div>

                            <div class="col-sm-4 p-0">
                                <input type="text" name="voucher" style="width:100px;">
                                <input type="submit" name="Apply" value="Apply" style="width:100px;">
                            </div>

                            <div class="row m-0">
                                <div class="col-sm-8 p-0 ">
                                    <div class="form-check">
                                        <input class="form-check-input f" name="coin" type="submit" value=""
                                            id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            <?php
                                                $select = "SELECT * FROM client WHERE clientID = '$cid'";
                                                $result5 = mysqli_query($con, $select);
                                                $row3 = mysqli_fetch_assoc($result5);

                                                echo $row3['coin'];
                                                ?>
                                            <img src="assets/images/coin.png" width="30%" alt="">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4 p-0">
                                    <?php $discoin = $row3['coin']/1000 ?>
                                    <input type="hidden" name="coindis" id="coin"
                                        value="<?php echo sprintf('%0.2f',$discoin) ?>">
                                    <p id="tax">RM<?php echo sprintf('%0.2f',$discoin) ?></p>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row mx-0 mb-2">
                            <div class="col-sm-8 p-0 d-inline">
                                <h5>Total</h5>
                            </div>
                            <div class="col-sm-4 p-0">

                                <?php $all = sprintf('%0.2f', $total * 0.06) + $total + $deliveryFees - $voucherprice - $discoin1;?>
                                <p id="total">RM<?php echo $all ?></p>
                            </div>
                        </div>
                        <div id="smart-button-container">
                            <div style="text-align: center;">
                                <button type="submit" name="paynow" class="btn yellow block circular"><img
                                        src="assets/images/paypal.png" width=50%></button>
                            </div>
                            <div style="text-align: center;">
                                <button type="button" name="paynow" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" style="width:100%" class="btn btn-primary block circular">
                                    <h6>Other Payment Method</h6>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Other Bank:</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" name="cimb" class="btn  block circular"><img
                                                        src="assets/img/Asset 1.png" width=100%></button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" name="alliance" class="btn  block circular"><img
                                                        src="assets/img/Asset 2.png" width=100%></button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" name="rhb" class="btn  block circular"><img
                                                        src="assets/img/Asset 3.png" width=100%></button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" name="standard" class="btn  block circular"><img
                                                        src="assets/img/Asset 4.png" width=100%></button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" name="maybank" class="btn  block circular"><img
                                                        src="assets/img/Asset 5.png" width=100%></button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" name="muamalat" class="btn  block circular"><img
                                                        src="assets/img/Asset 6.png" width=100%></button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" name="bsn" class="btn  block circular"><img
                                                        src="assets/img/Asset 7.png" width=100%></button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" name="pbe" class="btn  block circular"><img
                                                        src="assets/img/Asset 8.png" width=100%></button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" name="am" class="btn  block circular"><img
                                                        src="assets/img/Asset 9.png" width=100%></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('assets/footer.html'); ?>
    <!-- Close Content -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/chat.js"></script>
    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = 'ad59d396cc8e8091e28989c711228a991031a8d9';
    window.smartsupp || (function(d) {
        var s, c, o = smartsupp = function() {
            o._.push(arguments)
        };
        o._ = [];
        s = d.getElementsByTagName('script')[0];
        c = d.createElement('script');
        c.type = 'text/javascript';
        c.charset = 'utf-8';
        c.async = true;
        c.src = 'https://www.smartsuppchat.com/loader.js?';
        s.parentNode.insertBefore(c, s);
    })(document);
    </script>
    <!-- End Script -->


</body>


</html>