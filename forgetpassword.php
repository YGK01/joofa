<?php
session_start();
error_reporting(0);
include('assets/config.php');

if(isset($_POST['sent'])){
    $email = $_POST['email'];

    $get = "SELECT * FROM admin WHERE adminEmail = '$email'" ;

    $login = mysqli_query($con,$get);
    $row= mysqli_fetch_array($login);
    $count = mysqli_num_rows($login);
    if($count==1){
        
        $token = md5($email).rand(10,9999);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$email."\r\n".
            'Reply-To: '.$email."\r\n" .
            'X-Mailer: PHP/' . phpversion();
 
        $message = '<html><body>';
        $message .= "<a href='http://localhost/FYP-2/ResetPass.php?key=".$email."&token=".$token."'>Click To Reset password</a>";
        $message .= '</body></html>';

        $to = $email;
 
        $subject = "Reset Password";
        
        $retval = mail ($to,$subject,$message, $headers);
        
    }
  
    else{
      ?>
<div class="secError">
    <?php
        echo "<script>alert('Invalid email');</script>";
         ?>
</div>
<?php
          }
        }
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Forget Passwaord</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">

    <link rel="stylesheet" href="assets/css/custom.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">

    <style>
    body {
        background-color: #c4a484;
    }

    h3 {
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
    <!-- Open Content -->
    <form method="post" enctype="multipart/form-data">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">Forget Password</h3>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="typeEmailX-2">Email</label>
                                    <input type="email" id="typeEmailX-2" name="email"
                                        class="form-control form-control-lg" />
                                </div>

                                <input type="submit" value="Sent" name="sent" class="btn btn-success btn-sm btn-block">
                                <input type="button" value="Cancel" class="btn btn-success btn-sm btn-block"
                                    onclick="alert('Action Cancel.'); window.location='login.php'" />

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