<?php
session_start();
error_reporting(0);
include('assets/config.php');
 $select = "SELECT DATEDIFF(NOW(), OrderDate) as date, OrderID FROM orderdetail WHERE OrderStatus = 'Delivering'";
$result = mysqli_query($con, $select);
while ($row = mysqli_fetch_array($result)){
$date = $row["date"];
$id = $row["OrderID"];
    if($date>=10)
    {
        $update = "UPDATE orderdetail SET OrderStatus = 'Complete' WHERE OrderId = '$id'";
        mysqli_query($con, $update);
    }

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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <style>
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0.125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: right;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 0.25rem;
        margin-left: 60%;
    }

    .card_p {
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
        border: none;
    }

    .form-control {
        height: 50px;
        background: #ffffff;
        color: #000000 !important;
        font-size: 15px;
        border-radius: 5px;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid grey;
        padding-left: 20px;
        padding-right: 20px;

    }

    .form-control:hover {
        background: #ffffff;
        color: #000000
    }

    .card {
        max-height: 90%;
        min-height: 90%;
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
        background-color: #ffffff;
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 3s;
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

    .text {
        text-align: right;
    }

    .button {
        color: #c4a484;
    }
    h6{
            text-align: center;
        font-family: 'Oswald', sans-serif !important;
        font-size: 30px;

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light d-none d-lg-block" style="background-color:#964b00"
        id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                        href="mailto:info@company.com">joofatrading@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:03-3197 4862">03-3197 4862</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                            class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                            class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://api.whatsapp.com/send?phone=60176860969" target="_blank"><i
                            class="fab fa-whatsapp fa-sm fa-fw me-2"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow" style="background-color:#ffffff">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-info logo h1 align-self-center" href="homepage.php">
                Joo Fa Trading
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="About Us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ContactUs.php">Contact Us</a>
                        </li>
                        <?php if(isset($_SESSION['id'])){?>
                        <li class="nav-item">
                            <a class="nav-link" href="Order.php">Order</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">

                    <div class="flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <form action="searchResult.php" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputMobileSearch" name="search"
                                    placeholder="Search ...">
                                <button type="submit" class="input-group-text bg-success text-light">
                                    <i class="fa fa-fw fa-search text-white"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <?php if(isset($_SESSION['id'])){?>
                    <a class="nav-icon position-relative text-decoration-none" href="shopping_cart.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <?php 
                        $session = $_SESSION['id'];
                            $sql = "SELECT COUNT(*) as total FROM shopping_cart WHERE clientID = '$session' AND Status = 'Added'"; 
                            $result = $con->query($sql);
                            $data =  $result->fetch_assoc();
                            ?>
                        <span
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?php echo $data['total']; ?></span>
                    </a>

                    <a class="nav-item dropdown">
                        <a class="fa fa-fw fa-user" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <div class="card_p">
                                    <?php
                                    $cid = $_SESSION['id'];
                                    $select1 = "SELECT * FROM `client` WHERE clientID = '$cid'";
                                    $result5 = mysqli_query($con, $select1);
                                    $row3 = mysqli_fetch_assoc($result5);

                                    
                                    ?>
                                    <p>HI,
                                    <h6><?php echo $row3['clientName']; ?></h6>
                                    </p>
                                    <p>This is your current point:</p>
                                    <?php if($row3['coin'] == 0){
                                        $coin = 0;
                                    }else{
                                        $coin = $row3['coin'];
                                    } ?>
                                    <p><?php echo $coin;  ?><img src="assets/images/coin.png" width="20%" alt=""></p>


                                </div>
                            </li>
                            <hr>
                            <li><a href="setting.php" class="dropdown-item">Setting</a></li>
                            <li><a href="c_logout.php" class="dropdown-item">Logout</a></li>
                        </ul>
                    </a>
                    <?php } else {
                        ?>
                            <a class="nav-link" href="login.php">Login</a>
                        <?php
                        } ?>
                </div>
            </div>

        </div>
    </nav>


    <!-- Carousel wrapper -->

    <section class="slideshow-container">
        <div class="row">
            <div class="col-md-12">
                <div class="block">

                    <div class="mySlides fade">
                        <img src="assets/images/coffee-beans.jpg" style="width:100%" class="responsive" width="600"
                            height="400">
                    </div>

                    <div class="mySlides fade">
                        <img src="assets/images/coffeeL.jpg" style="width:100%" class="responsive" width="600"
                            height="400">
                    </div>

                    <div class="mySlides fade">
                        <img src="assets/images/coffeeB.jpg" style="width:100%" class="responsive" width="600"
                            height="400">
                    </div>

                    <div style="text-align:center">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Hero -->

    <div class="container py-5">
        <div class="row">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all"
                        type="button" role="tab" aria-controls="nav-all" aria-selected="true">All</button>

                    <?php 
                        $select = mysqli_query($con, "SELECT * FROM category WHERE categoryStatus = '1'"); 
                        $tab_menu = '';
                        $tab_content = '';
                        $i = 0;
                        while($fetch = mysqli_fetch_array($select)){
                        ?>
                    <button class="nav-link" id="nav-<?php echo $fetch['categoryID'];?>-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-<?php echo $fetch['categoryID'];?>" type="button" role="tab"
                        aria-controls="nav-<?php echo $fetch['categoryID'];?>"
                        aria-selected="true"><?php echo $fetch['category'];?></button>

                    <?php
                 } ?>

            </nav>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <div class="col-lg-14">
                        <div class="row">

                            <?php 
                            $query = "SELECT * FROM product "; 
                            $result = $con->query($query);
                            while ($row=mysqli_fetch_array($result)) 
                            {
                            ?>
                            <!--Product Card-->
                            <div class="col-lg-4">
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
                                            <div href="ProductDetail.php?id=<?php echo $row['ProductID'];?>"
                                                class="h3 text-decoration-none"><?php echo $row["ProductName"] ?></div>

                                            <div class="text">RM <?php echo $row["ProductPrice"] ?></div>
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

                <?php $select1 = mysqli_query($con, "SELECT * FROM category WHERE categoryStatus = '1'"); 
                while($fetch1 = mysqli_fetch_array($select1)){ ?>
                <div class="tab-pane fade" id="nav-<?php echo $fetch1['categoryID']; ?>" role="tabpanel"
                    aria-labelledby="nav-<?php echo $fetch1['categoryID']; ?>-tab">
                    <div class="col-lg-14">
                        <div class="row">

                            <?php 
                            $cate = $fetch1['category'];
                            $query = "SELECT * FROM product WHERE category = '$cate'"; 
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

                                        <div class="text">RM <?php echo $row["ProductPrice"] ?></div>
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
                <?php } ?>
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