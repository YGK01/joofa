<html>
    <?php
    include('assets/config.php');
         $currentTime = time();
         if($currentTime > $_SESSION['expire']) {
           session_unset();
           session_destroy();
           header('location:c_logout.php');
         }

        
    ?>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<head>
    <style>
        h6{
            text-align: center;
        font-family: 'Oswald', sans-serif !important;
        font-size: 30px;

        }

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
    .form-control:hover{
        background: #ffffff;
        color: #000000
    }
    </style>
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg navbar-light d-none d-lg-block" style="background-color:#964b00"
        id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                        href="mailto:joofatrading@gmail.com">joofatrading@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel: 03-3197 4862"> 03-3197 4862</a>
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
                                    $select1 = "SELECT * FROM client WHERE clientID = '$cid'";
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

                </div>
            </div>

        </div>
    </nav>
</body>
<script>
$(document).ready(function() {
    $(".icon-input-btn").each(function() {
        var btnFont = $(this).find(".btn").css("font-size");
        var btnColor = $(this).find(".btn").css("color");
        $(this).find(".fa").css({
            'font-size': btnFont,
            'color': btnColor
        });
    });
});
</script>

</html>
<!-- Close Header -->