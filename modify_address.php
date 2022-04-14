<?php
session_start();

error_reporting(0);
include('assets/config.php');
$c_id = $_SESSION["id"];
$aid = $_GET['id'];
if(isset($_POST['update'])){
    $name = $_POST['addname'];
    $address=  $_POST['add'];
    $contact=  $_POST['contact'];
    $zipcode=  $_POST['zipcode'];
    $update = "UPDATE `address` SET`AddressName`='$name ',`Address`='$address',`AddressZipCode`='$zipcode',`contact`='$contact' WHERE `AddressID` = '$aid'";
    mysqli_query($con, $update);
    header("location:setting.php");
}

if(isset($_POST['new'])){

    $total = mysqli_query($con,"SELECT COUNT(*) as total FROM address");
    $row = mysqli_fetch_assoc($total);
    $newcount = sprintf("A%05d", $row['total'] + 1);
    $name = $_POST['addname'];
    $address=  $_POST['address'];
    $contact=  $_POST['contact'];
    $zipcode=  $_POST['zipcode'];
    $insert = "INSERT INTO `address`(`AddressID`, `ClientID`, `AddressName`, `Address`, `AddressZipCode`, `contact`) VALUES ('$newcount', '$c_id', '$name','$address','$zipcode','$contact')";
    mysqli_query($con, $insert);
    header("location:setting.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo FaShop - Edit Address Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">


    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <style>
    .btn-group-sm>.btn,
    .btn-sm {
        margin-right: 25px;
    }

    .form-input input {
        display: none;
    }

    .form-input label {
        display: inline-block;
        width: 50%;
        height: 45px;
        margin-left: 25%;
        line-height: 50px;
        text-align: left;
        background: #1172c2;
        color: #fff;
        font-size: 15px;
        font-family: "Open Sans", sans-serif;
        text-transform: Uppercase;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }



    label {
        margin-right: 150px;
        display: inline-block;
        width: 200px;
        text-align: right;
    }


    textarea {

        display: inline-block;
        width: 300px;
        padding: 5px;
        background: #fff;

    }

    .center {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    input {
        width: 300px;
        padding: 5px;
        background: #fff;
        border: 1px solid black;

    }

    .container {
        text-align: center;
    }
    </style>
</head>

<body>
    <?php include('assets/C_header.php'); ?>
    <?php if($_GET["type"] == "edit"){
        $aid = $_GET['id'];
        $select = "SELECT * FROM address WHERE AddressID = '$aid'";
        $result = mysqli_query($con,$select);
        $row = mysqli_fetch_assoc($result);?>

    <form action="" method="post">
        <div class="container">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Address Name:</label>
                <div class="col-sm-5">
                    <input type="text" name="addname" value="<?php echo $row["AddressName"]; ?>" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="Address" class="col-sm-2 col-form-label">Address:</label>
                <div class="col-sm-5">
                    <textarea name="add" id="" cols="30" rows="10"><?php echo $row["Address"]; ?></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="Contact" class="col-sm-2 col-form-label">Contact:</label>
                <div class="col-sm-5">
                    <input type="text" name="contact" value="<?php echo $row["contact"]; ?>" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="Post" class="col-sm-2 col-form-label">PostCode:</label>
                <div class="col-sm-5">
                    <input type="text" name="zipcode" value="<?php echo $row["AddressZipCode"]; ?>" />
                </div>
            </div>

            <div class="text-center">
                <input type="submit" name=" update" style="center" value="Update"
                    class="btn btn-success btn-sm btn-block">
            </div>
        </div>
    </form>

    <?php
    } 
    else if($_GET["type"] == "new"){?>

    <form action="" method="post">
        <div class="container">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Address Name:</label>
                <div class="col-sm-5">
                    <input type="text" name="addname" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="Address" class="col-sm-2 col-form-label">Address:</label>
                <div class="col-sm-5">
                    <textarea name="address" id="" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="Contact" class="col-sm-2 col-form-label">Contact:</label>
                <div class="col-sm-5">
                    <input type="text" name="contact" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="Post" class="col-sm-2 col-form-label">PostCode:</label>
                <div class="col-sm-5">
                    <input type="text" name="zipcode" />
                </div>
            </div>
            <div class="text-center">
                <input type="submit" name="new" style="center" value="Create New"
                    class="btn btn-success btn-sm btn-block">
            </div>


        </div>
    </form>


    <?php
    }?>


    <!-- Close Content -->

    <?php include('assets/footer.html'); ?>

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