<?php
session_start();
error_reporting(0);
include('assets/config.php');

if(isset($_POST['reset'])){
    $pass = $_POST['pass'];
    $compass = $_POST['compass'];
    $key = $_GET["key"];

    $enc_Pass = md5($pass);
    if($pass != $compass)
    {
        echo "<script>alert('Password unmatch');</script>";
    }
    else{
        $reset = "UPDATE admin SET adminPassword = '$enc_Pass' WHERE adminEmail = '$key'";
        mysqli_query($con,$reset);
        header("Location: login.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Reset Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <style>
    .card {
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
        transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
        padding: 14px 50px 14px 36px;
        cursor: pointer;

    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }

    h3 {
        font-family: 'Oswald', sans-serif !important;
    }
    </style>

</head>


<body>
    <!-- Open Content -->
    <form method="post" enctype="multipart/form-data">
        <section class="vh-100" style="background-color: #c4a484;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">Reset Password</h3>

                                <div class="form-outline mb-4">
                                    <input type="password" id="typePasswordX-2" name="pass"
                                        class="form-control form-control-lg" placeholder="Enter New Password" />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="typePasswordX-2" name="compass"
                                        class="form-control form-control-lg" placeholder="Enter Confirm Password" />

                                </div>
                                <input type="submit" value="Reset" name="reset"
                                    class="btn btn-success btn-sm btn-block">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->


</body>

</html>