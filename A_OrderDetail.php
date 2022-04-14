<?php
session_start();
if (isset($_POST["logout"])) {
    session_destroy();
    header("location:AdminHome.php");
  }
  if (!isset($_SESSION["email"])) {
    header("location:A_Login.php");
  }
error_reporting(0);
include('assets/config.php');

$Client_ID=$_GET["id"];
$result = mysqli_query($con,"SELECT * FROM orderdetail as o INNER JOIN client as c ON c.clientID = o.clientID INNER JOIN address As a ON o.DeliveryAddress = a.AddressID WHERE o.OrderID = '$Client_ID'");
$row = $result->fetch_assoc();
?>

<?php
if(isset($_POST['update'])){
    $O_ID = $row['OrderID'];
    $status = $_POST['status'];
    $trackingno = $_POST['trackingno'];
    $cid = $row['clientID'];
    $price = $row['OrderTotalPrice'];
    $coin = $row['coin'];
    $cart = $row['cartID'];

    

    $result = mysqli_query($con,"UPDATE `orderdetail` SET `OrderStatus`='$status', `TrackingNo`='$trackingno' WHERE `OrderID` = '$O_ID'");

    if($status == "Complete"){
        
        $now = date("Y-m-d");
        $cart_arr = preg_split ("/\,/", $cart);
        $i = count($cart_arr);
        $newcoin = $coin + round($price);
        $result = mysqli_query($con,"UPDATE `client` SET `coin`='$newcoin' WHERE `clientID` = '$cid' ");
        for($k = 0; $k<$i; $k++)
        {
            $cartID[$k]=$cart_arr[$k];//ProductID
            $result = mysqli_query($con,"UPDATE `shopping_cart` SET date='$now', Status='Complete'  WHERE `cartID` = '".$cartID[$k]."' ");
        }
    }
    header("location:AdminHome.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Order Detail Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
    .form-input input {
        display: none;
    }

    .form-input label {
        display: block;
        width: 65%;
        height: 45px;
        margin-left: 25%;
        line-height: 50px;
        text-align: center;
        background: #1172c2;
        color: #fff;
        font-size: 15px;
        font-family: "Open Sans", sans-serif;
        text-transform: Uppercase;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-input img {
        width: 100%;
        display: none;
        margin-bottom: 30px;
    }

    .left {
        margin-bottom: 20px;

    }

    label {
        margin-right: 100px;
        display: inline-block;
        width: 30%;
        text-align: right;
    }

    .center {
        margin: auto;
        width: 60%;
        padding: 10px;

    }

    .form-input {
        width: 350px;
        padding: 20px;
        background: #fff;
        box-shadow: -3px -3px 7px rgba(94, 104, 121, 0.377),
            3px 3px 7px rgba(94, 104, 121, 0.377);
    }

    .cont {
        margin-top: 20px;
    }

    body {
        background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
        }
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        padding: 58px 0 0;
        /* Height of navbar */
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        width: 240px;
        z-index: 600;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            width: 100%;
        }
    }

    .sidebar .active {
        border-radius: 5px;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 0.5rem;
        overflow-x: hidden;
        overflow-y: auto;
        /* Scrollable contents if viewport is shorter than content. */
    }
    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;

    }
    </style>

</head>


<body>
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <h3>Main dashboard</h3>
                    </a>
                    <a href="AdminHome.php" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Customer Order</span>
                    </a>
                    <a href="Admin_Voucher.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-lock fa-fw me-3"></i><span>Voucher</span></a>
                    <a href="Admin_Cate.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-line fa-fw me-3"></i><span>Category</span></a>
                    <a href="Admin_Report.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-pie fa-fw me-3"></i><span>Report</span></a>
                    <a href="AdminCourier.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Courier</span></a>
                    <a href="AdminProduct.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Product</span></a>
                    <a href="logout.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-globe fa-fw me-3"></i><span>Log Out</span></a>

                </div>
            </div>
        </nav>
    </header>
    <!-- Open Content -->


    <main style="margin-top: 58px">
        <section class="bg-light">
            <div class="center">

                <form method="post" enctype="multipart/form-data">
                    <h3>Customer Detail</h3>
                    <hr>

                    <div class="cont">
                        <label for="clientid">Client ID</label>
                        <label for="clientid"><?php echo $row['clientID'] ?></label>
                    </div>


                    <div class="cont">
                        <label for="clientName">Client Name</label>
                        <label for="clientName"><?php echo $row['clientName'] ?></label>
                    </div>


                    <div class="cont">
                        <label for="clientContact">Client Contact</label>
                        <label for="clientContact"><?php echo $row['clientContact'] ?></label>
                    </div>


                    <div class="cont">
                        <label for="clientEmail">Client Email</label>
                        <label for="clientEmail"><?php echo $row['clientEmail'] ?></label>
                    </div>


                    <div class="cont">
                        <label for="clientAddress">Delivery Address</label>
                        <label for="clientAddress"><?php echo $row['Address'] ?></label>
                    </div>


                    <div class="cont">
                        <label for="Zipcode">Delivery Address Zip Code</label>
                        <label for="Zipcode"><?php echo $row['AddressZipCode'] ?></label>
                    </div>
                    <br><br>
                    <h3>Order Detail</h3>
                    <hr>

                    <div class="cont">
                        <label for="clientEmail">Order ID</label>
                        <label for="clientEmail"><?php echo $row['OrderID'] ?></label>
                    </div>


                    <div class="cont">
                        <label for="clientAddress">Order Status</label>
                        <select name="status" style="margin-left:20%;">
                            <option value="Ordered">Ordered</option>
                            <option value="Delivering">Delivering</option>
                        </select>
                    </div>

                    <div class="cont">
                        <label for="trackingno">Tracking No</label>
                        <input type="text" style="margin-left:20%;" name="trackingno"
                            value="<?php echo $row['TrackingNo'] ?>" placeholder="Tracking No">
                    </div>

                    <div class="cont">
                        <label for="Zipcode">Order Date</label>
                        <label for="Zipcode"><?php echo $row['OrderDate'] ?></label>
                    </div>


                    <table class="table table-bordered">
                        <thead class="alert-success">
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:#fff;">
                            <?php
                        
                        $string1 = $row['ProductID'];
                        $string2 = $row['OrderNum'];
                        $str_arr1 = preg_split ("/\,/", $string1);
                        
                        $str_arr2 = preg_split ("/\,/", $string2);
                        $i = count($str_arr2);
                        for($k = 0; $k<$i; $k++){
                            $CC1[$k]=$str_arr1[$k];//ProductID
                            $CC2[$k]=$str_arr2[$k];//Quantity

                            $result1 = mysqli_query($con,"SELECT * FROM  product WHERE ProductID = '".$CC1[$k]."'");
                            $row1 = $result1->fetch_assoc();

                           
                        ?>
                            <tr>
                                <td><?php echo $row1['ProductID'] ?></td>
                                <td><?php echo $row1['ProductName'] ?></td>
                                <td><?php echo $row1['ProductPrice'] ?></td>
                                <td><?php echo $CC2[$k] ?></td>
                                <?php $a += $row1['ProductPrice'];?>

                            </tr>

                            <?php
                            
                            echo $CC[$k];
                        }
                        ?>
                        </tbody>
                    </table>

                    <br><br>

                    <input type="submit" value="Update" style="margin-left:100%" name="update">

                </form>
            </div>
        </section>
    </main>
    <!-- Close Content -->


    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->


</body>

</html>