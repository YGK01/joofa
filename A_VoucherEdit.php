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


$Voucher_ID=$_GET["id"];
$result = mysqli_query($con,"SELECT * FROM voucher WHERE VoucherID = '$Voucher_ID'");
$row = $result->fetch_assoc();
?>
<?php


if(isset($_POST['update'])){
    
    $Vprice = $_POST['V_Price'];
    $date = $_POST['exdate'];
    $Vstatus = $_POST['V_Status'];

    $update = "    UPDATE `voucher` SET`VoucherPrice`='$Vprice',`VoucherStatus`='$Vstatus',`VoucherExpiredDate`='$date' WHERE `VoucherID`='$Voucher_ID'";
    mysqli_query($con,$update);
    header("location:Admin_Voucher.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Edit Voucher Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">


    <style>
    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;

    }
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

    p {
        display: inline-block;
        width: 200px;
        text-align: left;
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
                    <a href="AdminHome.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Customer Order</span>
                    </a>
                    <a href="Admin_Voucher.php" class="list-group-item list-group-item-action py-2 ripple active"><i
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


    <form method="post" enctype="multipart/form-data">
        
    <main style="margin-top: 58px">
        <!-- Open Content -->
        <div class=row>
            <section class="bg-light">
                <div class="container pb-5">
                    <div class="left">
                        <label>Voucher Code</label>
                        <p><?php echo $row['VoucherCode'] ?></p>

                    </div>

                    <div class="left">
                        <label>Voucher Price</label>
                        <input type="text" name="V_Price" value="<?php echo $row['VoucherPrice']?>" />
                    </div>

                    <div class="left">
                        <label>Voucher Expired Date</label>
                        <input type="date" name="exdate" value="<?php echo $row['VoucherExpiredDate']?>" />
                    </div>

                    <div class="left">
                        <label>Voucher Status</label>

                        <select name="V_Status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <input type="submit" value="Update" name="update">


                    <?php
            
                    $query = mysqli_query($con,"SELECT COUNT(VoucherID) FROM voucher");
                    $row_db = mysqli_fetch_row($query);  
                    $total_records = $row_db[0];  
                    $pages =  ceil($total_records / $limit);
                    $pagLink = "<ul class='pagination' style='margin-left:95%'>"; 
                    for ($i=1; $i<=$pages; $i++) {
                        $pagLink .= "<li class='page-item'><a class='page-link' href='Admin_Voucher.php?page=".$i."'>".$i."</a></li>";	
                    }
                    echo $pagLink . "</ul>"; 
                    ?>
                </div>
            </section>
        </div>
    </main>
    </form>
    <!-- Close Content -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
    <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("exdate")[0].setAttribute('min', today);
    </script>
</body>



</html>