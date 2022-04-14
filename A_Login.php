<?php
session_start();
error_reporting(0);
include('assets/config.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $Password = $_POST['Password'];
    $enc_Pass = md5($Password);
    $get = "SELECT * FROM admin WHERE adminEmail = '$email' AND adminPassword = '$enc_Pass'" ;
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);
    if($count==1){
      session_start();
      $_SESSION["email"] = $email;
      header("Location: AdminHome.php");
    }
  
    else{
      ?>
      <div class="secError">
        <?php
        echo "<script>alert('Invalid email or password');</script>";
         ?>
      </div>
      <?php
          }
        }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Tradin Sign Up</title>
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
      body {
        /* Add image */
        background-image: url("./assets/images/coffee-beans.jpg");

        /* Make image center */
        background-position: center center;

        /* Make image fixed */
        background-attachment: fixed;

        /* Not repeat images */
        background-repeat: no-repeat;

        /* Set background size auto */
        background-size: 100%;
        opacity: 75%;
        font-family: 'Oswald', sans-serif !important;
    }

    /* Media query for mobile devices  */
    @media only screen and (max-width: 767px) {
        body {
            background-image: url("./assets/images/coffee-beans.jpg");
        }

        .img-fluid {
            max-width: 100%;

        }

    }

    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;

    }

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
    </style>
</head>

<body>

    <form method="post" enctype="multipart/form-data">

        <div class="container py-5 h-50">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3> Admin Sign In</h3>
                            <hr><br>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeEmailX-2">Email</label>
                                <input type="email" id="typeEmailX-2" name="email"
                                    class="form-control form-control-lg" />

                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2">Password</label>
                                <input type="password" id="typePasswordX-2" name="Password"
                                    class="form-control form-control-lg" />

                            </div>
                            <input type="submit" value="Login" name="login" class="btn btn-success btn-lg btn-block">
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>

    </form>

    <!-- create a new account -->
</body>

</html>