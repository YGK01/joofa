<?php
session_start();
error_reporting(0);
include('assets/config.php');
?>


<?php
//validation of user email and password
if(isset($_POST['login'])){
  $Email = $_POST['l_email'];
  $Password1 = md5($_POST['l_password']);
  $get = "SELECT * FROM client WHERE clientEmail = '$Email' AND clientPassword = '$Password1' AND status = '1'" ;
  $login = mysqli_query($con,$get);
  $data =  $login->fetch_assoc();
  $count = mysqli_num_rows($login);
  if($count==1){
    session_start();
    $_SESSION["clientEmail"] = $Email;
    $_SESSION["id"] = $data['clientID'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    echo "<script>location.replace('homepage.php')</script>";
  }

  else{
    ?>
<div class="secError">
    <?php
      echo "<script>alert('Invalid Email Or Password')</script>";
       ?>
</div>
<?php
        }
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style2.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <style>

body {
        background-color: #c4a484;

    }

    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;
        font-size:50px;

    }

    h5 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;
        font-size:30px;

    }

    h4 {
        text-align: center;
        font-family: Arial;
    }

    img {
        vertical-align: center;
        border-style: none;
        height:100%;
        max-width: 100%
    }

    img,
    .login-wrap {
        width: 100%;
    }

    .img-fluid {
        max-width: 100%;

    }

    @media (max-width: 991.98px) {

        .img,
        .login-wrap {
            width: 100%;
        }

        .img-fluid {
            max-width: 100%;

        }
    }

    @media (max-width: 767.98px) {
        .wrap .img {
            height: 100%;
        }
    }

    .login-wrap {
        position: relative;
        background: #fff;
        text-align:center;

    }

    .ftco-section {
        padding: 7em 0;
    }

    .box {
        width: 50%;
        height: 50%;
    }

    .wrap {
        width: 100%;
        margin-top: 10%;
        overflow: hidden;
        background: #fff;
        border-radius: 5px;
        -webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
        -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
        box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
    }
    .signin-form{
        text-align:center;
        display: inline-block;
    }
    </style>
</head>

<body>
    <title> Joo Fa Trading</title>
    <section class="ftco-section">

        <div class="container">
            <div class="text-center">
                <h3>Joo Fa Trading</h3>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img-fluid ">
                            <img src="./assets/images/CoffeeL.jpg" alt="Login image" style="background-image"
                                alt="Responsive image">
                        </div>

                        <div class="login-wrap p-4">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h5 class="mb-4">Sign In</h5>
                                    <hr>
                                </div>
                                
                            </div>

                            <div id="login">
                                <div class="signin-form">

                                    <form style="width: 23rem;" method="post">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example18">Email address</label>
                                            <input type="email" name="l_email" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example28">Password</label>
                                            <input type="password" name="l_password"
                                                class="form-control form-control-lg" />
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" value="Login" name="login"
                                                class="btn btn-success btn-sm">
                                            <input type="button" value="Cancel" class="btn btn-success btn-sm btn-block"
                                                onclick="window.location='login.php'" />
                                        </div>
                                       
                                        <p class="text-center">Not a member? <a data-toggle="tab" href="signup.php">Sign
                                                Up</a></p>
                                        <p class="text-center"> <a href="forgetpassword.php">Forget Password?</a>
                                        <p class="text-center"> <a href="A_Login.php">Login as admin?</a>
                                            
                                    </form>
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

    </section>
</body>

</html>