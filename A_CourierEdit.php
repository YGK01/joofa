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

$Cate_ID=$_GET["id"];
$result = mysqli_query($con,"SELECT * FROM courier WHERE CourierID = '$Cate_ID'");
$row = $result->fetch_assoc();
?>
<?php
if(isset($_POST['update'])){
    
    $CPrice2 = $_POST['cate_price2'];
    $CPrice = $_POST['cate_price'];
    $CName = $_POST['cate_name'];
    $Cstatus = $_POST['status'];

    $update = "UPDATE `courier` SET`CourierName`='$CName',`CourierPrice`='$CPrice',`CourierPrice2`='$CPrice2',`Status`='$Cstatus' WHERE `CourierID`='$Cate_ID'";
    mysqli_query($con,$update);
    header("location:AdminCourier.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Courier Page</title>
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
        width: 50%;
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
        margin-bottom: 40px;

    }

    label {
        margin-right: 150px;
        display: inline-block;
        width: 200px;
        text-align: right;
    }

    .center {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .form-input {
        width: 350px;
        padding: 20px;
        background: #fff;
        box-shadow: -3px -3px 7px rgba(94, 104, 121, 0.377),
            3px 3px 7px rgba(94, 104, 121, 0.377);
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
                    <a href="AdminHome.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Customer Order</span>
                    </a>
                    <a href="Admin_Voucher.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-lock fa-fw me-3"></i><span>Voucher</span></a>
                    <a href="Admin_Cate.php" class="list-group-item list-group-item-action py-2 ripple "><i
                            class="fas fa-chart-line fa-fw me-3"></i><span>Category</span></a>
                    <a href="Admin_Report.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-pie fa-fw me-3"></i><span>Report</span></a>
                    <a href="AdminCourier.php" class="list-group-item list-group-item-action py-2 ripple active"><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Courier</span></a>
                    <a href="AdminProduct.php" class="list-group-item list-group-item-action py-2 ripple "><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Product</span></a>
                    <a href="logout.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-globe fa-fw me-3"></i><span>Log Out</span></a>
                   
                </div>
            </div>
        </nav>
    </header>


    <form method="post" enctype="multipart/form-data">
        <!-- Open Content -->
        
    <main style="margin-top: 58px">
        <div class=row>
            <section class="bg-light">
                <div class="container pb-5">

                    <div class="left">
                        <label>Courier Name</label>
                        <input type="text" name="cate_name" value="<?php echo $row['CourierName'] ?>" />
                    </div>

                    <div class="left">
                        <label>Courier Price (First 500g)</label>
                        <input type="text" name="cate_price" value="<?php echo $row['CourierPrice'] ?>" />
                    </div>

                    <div class="left">
                        <label>Courier Price (After 500g)</label>
                        <input type="text" name="cate_price2" value="<?php echo $row['CourierPrice2'] ?>" />
                    </div>

                    <div class="left">
                        <label>Status</label>
                        <select name="status" id="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <input type="submit" value="Update" name="update">

                    
                </div>
            </section>
        </div>
</main>
    </form>


    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>



</html>