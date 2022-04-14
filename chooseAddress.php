<?php
session_start();
  if (!isset($_SESSION["id"])) {
    header("location:A_Login.php");
  }
error_reporting(0);
include('assets/config.php');
$id = $_SESSION['id'];

$pid = $_GET['id'];
$quantity = $_GET['quan'];
$price = $_GET['price'];
$totalQuan = $_GET['totalquan'];
$cart = $_GET['cartID'];

if(isset($_POST['next']))
{
    $courierID = $_POST['courier'];
    $addressID = $_POST['address'];
    header("location:payment.php?pid=$pid&&quantity=$quantity&&price=$price&&courierID=$courierID&&addressID=$addressID&&totalQuan=$totalQuan&&cartID=$cart");
}

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <title>Joo Fa Trading</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">

    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/cart.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">


    <style>
    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;
    }

    .form-input input {
        display: none;
    }

    .form-input label {
        display: block;
        width: 45%;
        height: 45px;
        margin-left: 25%;
        line-height: 50px;
        text-align: center;
        background: #1172c2;
        color: #fff;
        font-size: 15px;
        font-family: "Open Sans", sans-serif;
        text-transform: Uppercase;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-input img {
        width: 100%;
        display: none;
        margin-bottom: 30px;
    }

    .left {
        margin-bottom: 20px;

    }

    label {
        margin-right: 100px;
        display: inline-block;
        width: 150px;
        text-align: right;
    }

    .center {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .form-input {
        width: 350px;
        padding: 20px;
        background: #fff;
        box-shadow: -3px -3px 7px rgba(94, 104, 121, 0.377),
            3px 3px 7px rgba(94, 104, 121, 0.377);
    }

    select {

        /* styling */
        width: 70%;
        background-color: white;
        border: thin solid grey;
        border-radius: 4px;
        display: inline-block;
        font: inherit;
        line-height: 1.5em;
        padding: 0.5em 3.5em 0.5em 1em;

        /* reset */

        margin-bottom: 2%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    </style>
</head>

<form class="" method="post" enctype="multipart/form-data">

    <body>
        <?php include('assets/C_header.php'); ?>

        <form method="post" enctype="multipart/form-data">
            <section class="vh-100" style="background-color: #ffff;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-16 col-md-8 col-lg-6 col-xl-10">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3> Choose the Address</h3>
                                    <br></br>
                                    <div class="form-outline mb-8">

                                        <label class="form-label">Address</label>
                                        <select name="address">
                                            <?php $seladdress = "SELECT * FROM address WHERE clientID = '$id'";
                                                $get = mysqli_query($con,$seladdress);
                                                $count = mysqli_num_rows($get);
                                                if($count != 0)
                                                {
                                                    while($row = mysqli_fetch_array($get))
                                                    {
                                                        ?>
                                                    <option value="<?php echo $row['AddressID'] ?>" style="width:100%">
                                                        <?php echo $row['AddressName'] ?> : <?php echo $row['Address'] ?>
                                                    </option>
                                                    <?php
                                                    } 
                                                }else{
                                                    echo "<script>location.replace('setting.php')</script>";
                                                    echo "";
                                                } ?>
                                                
                                            <br><br>
                                        </select>

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="typePasswordX-2">Courier</label>
                                        <select name="courier">
                                            <?php $selcour = "SELECT * FROM courier ";
                                                $get = mysqli_query($con,$selcour);
                                                while($row = mysqli_fetch_array($get))
                                                {?>
                                            <option value="<?php echo $row['CourierID'] ?>" style="width:100%">
                                                <?php echo $row['CourierName'] ?></option>
                                            <?php 
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    <input type="submit" value="Next" name="next"
                                        class="btn btn-success btn-sm btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </form>
        <!-- Close Content -->
        <?php include('assets/footer.html'); ?>


        <!-- Start Script -->
        <script src="assets/js/jquery-1.11.0.min.js"></script>
        <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/fetchandDisplay.js"></script>
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
</form>

</html>