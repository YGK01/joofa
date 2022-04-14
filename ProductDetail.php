<?php
session_start();

error_reporting(0);
include('assets/config.php');

$quantity = $_POST['product-quanity'];
$c_id = $_SESSION["id"];
$product_id=$_GET["id"];
$query = "SELECT * FROM product WHERE ProductID = '$product_id'"; 
$result = mysqli_query($con, $query);
$row = $result->fetch_assoc();
?>

<?php
if (isset($_POST['addtocart'])) 
{
    if (!isset($_SESSION["id"])) 
    {
        header("location:Login.php");
    }
    else{
        $get = "SELECT * FROM shopping_cart WHERE ProductID = '$product_id' AND clientID = '$c_id' AND Status = 'Added'" ;
        $login = mysqli_query($con,$get);
        $data =  $login->fetch_assoc();
        $count = mysqli_num_rows($login);
        if($count==1){
        $r = $data['Quantity'] + $quantity;
        $update = "UPDATE shopping_cart SET Quantity = $r WHERE ProductID = '$product_id' AND clientID = '$c_id' AND Status = 'Added'";
        mysqli_query($con,$update);
        }
        else{
        $insert = "INSERT INTO shopping_cart VALUES (null, '$c_id','$product_id',$quantity,'Added', null)";
        mysqli_query($con,$insert);
        }
    }
}

if(isset($_POST['submit']))
{
    foreach($_POST["files"] as $file)
    {
        echo $file."||";
        
    }
    $commaSeparated = implode(',' ,     $_POST["files"]);
    echo $commaSeparated;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo FaShop - Product Detail Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="http://example.com/image-uploader.min.css">
    <style>
    .tip {
        width: 0px;
        height: 0px;
        position: absolute;
        background: transparent;
        border: 10px solid #ccc;
    }

    .tip-left {
        top: 10px;
        left: -20px;
        border-top-color: transparent;
        border-left-color: transparent;
        border-bottom-color: transparent;
    }

    .dialogbox .body {
        position: relative;
        max-width: 100%;
        height: auto;
        margin: 20px 10px;
        padding: 5px;
        background-color: #DADADA;
        border-radius: 3px;
        border: 3px solid #ccc;
    }

    .dialogbox .body1 {
        position: relative;
        max-width: 100%;
        height: auto;
        margin: 2px 10px;
        padding: 5px;
        background-color: #DADADA;
        border-radius: 3px;
        border: 3px solid #ccc;
    }

    .body .message {
        min-height: 20px;
        border-radius: 3px;
        font-family: Arial;
        font-size: 14px;
        line-height: 1.0;
        color: #797979;
    }

    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    .remove:hover {
        background: white;
        color: black;
    }
    </style>
</head>
<form method="post" enctype="multipart/form-data">

    <body>
        <section class="bg-light">
            <?php include('assets/C_header.php'); ?>

            <!-- Modal -->
            <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="w-100 pt-1 mb-5 text-right">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="get" class="modal-content modal-body border-0 p-0">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="inzputModalSearch" name="q"
                                placeholder="Search ...">
                            <button type="submit" class="input-group-text bg-success text-light">
                                <i class="fa fa-fw fa-search text-white"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <form action="" method="post">

                <!-- Open Content -->

                <div class="container pb-5">
                    <div class="row">
                        <div class="col-lg-5 mt-5">
                            <div class="card mb-3">
                                <img class="card-img img-fluid" src="<?php echo $row["ProductPic"] ?>"
                                    alt="Card image cap" id="product-detail">
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-lg-7 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="h2"></h1>
                                    <li class="list-inline-item">
                                        <h2><?php echo $row["ProductName"]?></h2>
                                    </li>
                                    <p class="h3 py-2">RM<?php echo $row["ProductPrice"] ?></p>
                                    <ul class="list-inline">

                                    </ul>

                                    <h6>Description:</h6>
                                    <p><?php echo $row["ProductDescription"] ?></p>

                                    <?php $quan = 1; ?>
                                    <div class="row">
                                        <div class="col-auto">
                                            <ul class="list-inline pb-3">
                                                <li class="list-inline-item text-right">
                                                    Quantity
                                                    <input type="number" name="product-quanity" id="product-quanity"
                                                        value="1">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col d-grid">
                                            <input type="submit" value="Add To Cart" class="btn btn-success btn-lg"
                                                name="addtocart">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- New Comment //-->

                    </div>
                    <!--Display previouos comment-->
                    <?php $get = "SELECT *, COUNT(c.rating) as rate FROM comment c INNER JOIN client cl ON (cl.clientID = c.clientID) WHERE productID = '$product_id' ";
                    $result1 = mysqli_query($con,$get);
                    while ($row=mysqli_fetch_array($result1)) 
                    {?>
                    <div class="container">
                        <div class="dialogbox">
                            <div class="body1">
                                <span class="tip tip-left"></span>
                                <div class="message">
                                    <div class="flex-grow-1 ms-3">

                                        <div class="mb-1">
                                            <span
                                                class="fw-bold link-dark me-1"><?php echo $row['clientName']; ?></span>
                                            <span
                                                class="text-muted text-nowrap"><?php echo $row['date_added']; ?></span>
                                            <br>
                                            <?php 
                                                $k = $row['rating'];
                                                for($i=0; $i<$k; $i++)
                                                {?>
                                            <img src="assets/img/start.png" width=1% alt="">
                                            <?php    
                                                }

                                                ?>
                                        </div>
                                        <div class="mb-2"><?php echo $row['commentDescription']; ?></div>
                                        <?php 
                                        $string1 = $row['images']; 
                                        $str_arr1 = preg_split ("/\,/", $string1);
                                        $i = count($str_arr1);
                                        for($k = 0; $k<$i; $k++){?>
                                        <img src="assets/img/<?php echo $str_arr1[$k] ?>" class="rounded" width=25%
                                            alt="">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>


                </div>
                </div>


                </div>
            </form>
            <!-- Close Content -->



            <?php include('assets/footer.html'); ?>

            <!-- Start Script -->
            <script src="assets/js/jquery-1.11.0.min.js"></script>
            <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/custom.js"></script>
            <script src="assets/js/chat.js"></script>
            <script src="assets/js/comment-img.js"></script>
            <script type="text/javascript" src="http://example.com/jquery.min.js"></script>
            <script type="text/javascript" src="http://example.com/image-uploader.min.js"></script>
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
            <!-- End Script 
            -->
        </section>


    </body>
</form>

</html>