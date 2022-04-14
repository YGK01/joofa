<?php
session_start();

  if (!isset($_SESSION["id"])) {
    header("location:A_Login.php");
  }
error_reporting(0);
include('assets/config.php');

if(isset($_POST['update'])){
    
    $pid1 = $_POST['productID'];
    $cartID1 = $_POST['cartID'];
    $cartID2 = $_POST['cartID'] - 1;
    $upQuan = $_POST['quantity'];
    echo $cartID;echo $upQuan;echo $pid1;
    $sql = "UPDATE `shopping_cart` SET `Quantity`='$upQuan' WHERE (`cartID` = '$cartID1' OR `cartID` = '$cartID2') AND `ProductID` = '$pid1';";
    mysqli_query($con, $sql);
}
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <title>Joo Fa Trading</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">

    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/cart.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <style>
    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;
        font-size: 40px;
    }
    </style>

</head>

<body>
    <?php include('assets/C_header.php'); ?>

    <!-- Open Content -->
    <div id="cart" style="max-width:1060px">

        <?php 
        $o=array(); 
        $productid = array();
        $quan = array();
        ?>
        <form class="" method="post" enctype="multipart/form-data">

            <h3>Your Cart</h3>
            <br>
            <div class="container-fluid">
                <div class="row align-items-start">
                    <div class="col-12 col-sm-8 items">
                        <!--1-->

                        <?php 
                            $i = 0;
                            $id = $_SESSION['id'];
                            $result = mysqli_query($con,"SELECT sc.Quantity, sc.ProductID, sc.cartID, p.ProductName, p.ProductPic, p.weight, p.ProductPrice, sc.Status, sc.clientID FROM shopping_cart as sc INNER JOIN product as p ON p.ProductID = sc.ProductID Where sc.clientID = '$id' AND Status='Added' GROUP BY (sc.ProductID) ORDER BY sc.ProductID ASC;                            ");
                            
                            $count = mysqli_num_rows($result);
                            if($count == 0 ){
                                echo '<img src="https://assets.materialup.com/uploads/66fb8bdf-29db-40a2-996b-60f3192ea7f0/preview.png"  class="rounded mx-auto d-block" alt="">';
                            }
                            else{
                            while ($row = mysqli_fetch_array($result)) 
                            {   
                            ?>
                        <div class="cartItem row align-items-start">
                            <div class="col-3 mb-2">
                                <img class="w-100" src="<?php echo $row['ProductPic']?>" alt="art image">
                            </div>
                            <div class="col-5 mb-2">
                                <h6 class=""><?php echo $row["ProductName"]; ?></h6>
                            </div>
                            <div class="col-2">
                                <form action="" method="post">
                                    <input type="hidden" name="productID" value="<?php echo $row["ProductID"]; ?>">

                                    <input type="hidden" name="cartID" value="<?php echo $row["cartID"]; ?>">
                                    <input type="number" class="cartItemQuantity p-1 text-center" style="width:100px"
                                        min="1" name="quantity" value="<?php echo $row["Quantity"]; ?>">
                                    <input type="submit" name="update" value="Update">
                                </form>
                            </div>
                            <div class="col-2">
                                <p id="cartItem1Price"><?php echo $row["ProductPrice"]; ?></p>

                                <input type="hidden" name="cartID" value="<?php echo $row['cartID']?>">
                                <a href="deleteitem.php?id=<?php echo $row['cartID'];?>">Delete</a>
                            </div>
                        </div>
                        <hr>

                        <?php
                    
                        $o[] = $row["Quantity"] * $row["ProductPrice"];
                        $productid[]=$row['ProductID'];
                        $cart[] = $row["cartID"];
                        $weight[] = $row["weight"];
                        $quan[] = $row["Quantity"];
                    }
                
                    $commaSeparatedcart = implode(',' , $cart);
                    $commaSeparated = implode(',' , $productid);
                    $commaSeparatedWeight = implode(',' , $weight);
                    $commaSeparatedQuan = implode(',' , $quan);
                    $arraysum = array_sum($quan);
                    $arrayweigth = array_sum($weight);
                    ?>
                    </div>
                    <div class="col-12 col-sm-4 p-3 proceed form">
                        <div class="row m-0">
                            <div class="col-sm-8 p-0">
                                <h6>Subtotal</h6>
                            </div>
                            <div class="col-sm-4 p-0">
                                <?php $total =  array_sum($o)?>
                                <p id="subtotal">RM<?php echo $total;?></p>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-8 p-0 ">
                                <h6>Tax</h6>
                            </div>
                            <div class="col-sm-4 p-0">
                                <p id="tax">RM<?php echo sprintf('%0.2f', $total * 0.06); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row mx-0 mb-2">
                            <div class="col-sm-8 p-0 d-inline">
                                <h5>Total</h5>
                            </div>
                            <div class="col-sm-4 p-0">
                                <?php $all = sprintf('%0.2f', $total * 0.06) + $total;?>
                                <p id="total">RM<?php echo $all ?></p>
                            </div>
                        </div>
                        <a href="chooseAddress.php?id=<?php echo $commaSeparated;?>&&quan=<?php echo $commaSeparatedQuan ?>&&price=<?php echo $all ?>&&totalquan=<?php echo $arrayweigth ?>&&cartID=<?php echo $commaSeparatedcart ?>"
                            id="btn-checkout" class="shopnow"><span>Checkout</span></a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Close Content -->
    <?php include('assets/footer.html'); ?>


    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/chat.js"></script>
    <!-- End Script -->
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


</body>

</html>