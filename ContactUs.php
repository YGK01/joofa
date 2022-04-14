<?php
session_start();
error_reporting(0);
include('assets/config.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];
    $joofaemail = 'joofatrading@gmail.com';

    $token = md5($email).rand(10,9999);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$joofaemail."\r\n".
            'Reply-To: '.$joofaemail."\r\n" .
            'X-Mailer: PHP/' . phpversion();
 
        $message = 'Contact US<br>';
        $message .= "<br>Email Address = ".$email;
        $message .= "<br>Name = ".$name;
        $message .= "<br>Message = ".$msg;

        $to = $email;
 
        $subject = "Reset Password";
        
        $retval = mail ($to,$subject,$message, $headers);
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="About Us" content="About Joo Fa">
    <meta charset="utf-8">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <title>Contact Us | Joo Fa Trading </title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">

    <!-- Mobile Specific Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Ionic Icon Css -->
    <link rel="stylesheet" href="assets/plugins/Ionicons/css/ionicons.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="assets/plugins/slick/slick.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    body {
        background-color: #F8F6F0.;
    }
    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;
        font-size: 35px;
    }
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px;
        /* Should be removed. Only for demonstration */
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    textarea.form-control {
        height: 50px;
        background: #ffffff;
        color: #000000 !important;
        font-size: 15px;
        border-radius: 5px;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid black;
        padding-bottom: 20%;
    }
    </style>
</head>
<?php include('assets/C_header.php'); ?>

<body>


    <section class="slider_CU">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h1 class="animated fadeInUp">Contact Us</h1>
                        <h2 class="animated fadeInUp">We'd love to help you.</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="about section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="col-md-5">
                                    <div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fas fa-coffee"></i></span>
                                        </div>
                                        <div class="text">
                                            <p><span>Address:</span> No. 356, Lorong 5, Jalan Besar, Selangor, 42800
                                                Tanjung Sepat</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="col-md-5">
                                    <div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-phone"></i></span>
                                        </div>
                                        <div class="text">
                                            <p><span>Phone:</span> <a href="tel://1234567920">03-3197 4862</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="col-md-5">
                                    <div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-paper-plane"></i></span>
                                        </div>
                                        <div class="text">
                                            <p><span>Email:</span> <a
                                                    href="mailto:info@yoursite.com">info@yoursite.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<br>
                    <form action="" method="post">
                        <div class="contact-wrap">
                            <h3 class="mb-4 text-center">Get in touch with us</h3>
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-md-12">
                                    <div class="mb-3">
                                        <input type="Name" class="form-control" name="name"
                                            id="exampleFormControlInput1" placeholder="Your Name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email"
                                            id="exampleFormControlInput1" placeholder="Your Email">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" name="msg" id="exampleFormControlTextarea1"
                                            placeholder="Leave Your Message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm">
                    <vl></vl>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="block">
                        <div class="section-title">
                            <div class="text">
                                <p><span>Here We Are:</span></p>
                            </div>
                            <div style="width: 100%"><iframe width="90%" height="500" frameborder="0" scrolling="no"
                                    marginheight="0" marginwidth="0"
                                    src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=No.%20356,%20Lorong%205,%20Jalan%20Besar,%20Selangor,%2042800%20Tanjung%20Sepat+(Joo%20Fa%20Trading)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
                                        href="https://www.gps.ie/sport-gps/">gps watches</a></iframe></div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="assets/js/jquery-1.11.0.min.js"></script>
            <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/templatemo.js"></script>
            <script src="assets/js/custom.js"></script>
            <script src="assets/js/chat.js"></script>
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.validate.min.js"></script>
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
    </section>
</body>

</html>