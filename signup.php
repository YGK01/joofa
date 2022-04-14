<?php

include('assets/config.php');
if(isset($_POST['register'])){
    
    
    $rname = $_POST['r_name'];
    $remail = $_POST['r_email'];
    $rcontact = $_POST['r_contact'];
    $rpassword = $_POST['r_password'];
    if( strlen($rpassword)<8){
        echo "<script>alert('Password must more than 8 character')</script>";
    }else{
        $encrypted = md5($rpassword);
    
        $register = "SELECT COUNT(*) as num FROM client WHERE clientEmail = '$remail'";
        $result = mysqli_query($con,$register);
        $row = mysqli_fetch_assoc($result);
        if($row['num']>=1){
            echo "<script>alert('Email Already Exists')</script>";
        }
        else{

            $get1 = "SELECT COUNT(*) as num FROM client";
            $result1 = mysqli_query($con,$get1);

            $newcount = sprintf("C%05d", $row['num'] + 1);
        
            $register1 = mysqli_query($con,"INSERT INTO client (clientID, clientName, clientContact, clientEmail, clientPassword, coin, status) VALUES ('$newcount', '$rname', '$rcontact', '$remail', '$encrypted', '0', '1')");
            //header('location:login.php');
        }
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
        background-image: url("./assets/images/coffeeB.jpg");

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
            background-image: url("./assets/images/coffeeB.jpg");
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
                            <h3> Sign Up</h3>
                            <hr><br>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example18">Full Name</label>
                                <input type="text" name="r_name" class="form-control form-control-lg" required/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example18">Contact</label>
                                <input type="text" name="r_contact" class="form-control form-control-lg" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example18">Email address</label>
                                <input type="email" name="r_email" class="form-control form-control-lg" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example28">Password</label>
                                <input type="password" name="r_password" class="form-control form-control-lg" required/>
                            </div>

                            <div class="pt-1 mb-4">
                                <input type="submit" class="btn btn-success btn-sm" value="Register" name="register" >
                                <input type="button" value="Cancel" class="btn btn-success btn-sm btn-block"
                                    onclick="alert('Action Cancel.'); window.location='login.php'" />
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