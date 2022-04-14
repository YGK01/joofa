<?php
session_start();

error_reporting(0);
include('assets/config.php');
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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <style>
    .card {
        max-height: 100%;
        min-height: 100%;
        margin: 10px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: Verdana, sans-serif;
    }

    .mySlides {
        display: none;
    }

    img {
        vertical-align: middle;

    }

    /* Slideshow container */
    .slideshow-container {
        max-width: 5000px;
        position: relative;
        margin: auto;
    }

    .responsive {
        width: 100%;
        height: auto;
    }


    /* The dots/bullets/indicators */
    .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .text {
            font-size: 11px
        }
    }
    </style>
</head>

<body>
    <?php include('assets/C_header.php'); ?>
    <!-- End Banner Hero -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-14">
                <div class="row">

                    <?php 
                    $searchresult = $_POST['search'];
                            $query = "SELECT * FROM product WHERE ProductName LIKE '%$searchresult%' OR ProductDescription LIKE '%$searchresult%' OR category LIKE '%$searchresult%' "; 
                            $result = $con->query($query);
                            while ($row=mysqli_fetch_array($result)) 
                            {
                            ?>
                    <!--Product Card-->
                    <div class="col-md-3">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="img-fluid " height="auto" src="<?php echo $row["ProductPic"] ?>">
                                <div
                                    class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2"
                                                href="ProductDetail.php?id=<?php echo $row['ProductID'];?>"><i
                                                    class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2"
                                                href="addtocart.php?id=<?php echo $row['ProductID'];?>"><i
                                                    class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="ProductDetail.php?id=<?php echo $row['ProductID'];?>"
                                    class="h3 text-decoration-none"><?php echo $row["ProductName"] ?></a>

                                <p class="text-center mb-0"><?php echo $row["ProductPrice"] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                            ?>
                    <!--End of Product Card-->
                </div>

            </div>

        </div>
    </div>
    <!-- End Content -->

    <?php include('assets/footer.html'); ?>


    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/chat.js"></script>
    <script src="assets/js/slide.js"></script>
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