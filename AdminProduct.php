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
$limit = 10;
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
$result = mysqli_query($con,"SELECT * FROM product ORDER BY ProductID ASC LIMIT $start_from, $limit");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Admin Product Detail Page</title>
    <meta charset="UTF-8" name="viewport" content="width=device-widht, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <!-- Slick -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>

h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;

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
    <!-- Wrapper -->
    <!--Main Navigation-->
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
                    <a href="Admin_Cate.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-line fa-fw me-3"></i><span>Category</span></a>
                    <a href="Admin_Report.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-pie fa-fw me-3"></i><span>Report</span></a>
                    <a href="AdminCourier.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Courier</span></a>
                    <a href="AdminProduct.php" class="list-group-item list-group-item-action py-2 ripple active"><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Product</span></a>
                    <a href="logout.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-globe fa-fw me-3"></i><span>Log Out</span></a>
                   
                </div>
            </div>
        </nav>
    </header>
<form class=""  method="post" enctype="multipart/form-data">

    <body>

        <!-- Open Content -->


        <main style="margin-top: 58px">
        <section class="bg-light">
            <div class="container pb-5">
                <input type=button onClick="location.href='AdminAddProduct.php'" value='Add New Product'>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                        <thead>
                        <tbody>
                            <?php  
                        while ($row = mysqli_fetch_array($result)) {  
                        ?>
                            <tr style="vertical-align:middle">
                                <td width=20%><img src="<?php echo $row['ProductPic']?>" alt="product Img" width=100%>
                                </td>
                                <td><?php echo $row["ProductName"]; ?></td>
                                <td>RM<?php echo $row["ProductPrice"]; ?></td>
                                <td><?php echo $row["ProductStatus"]; ?></td>
                                <td width=10% style="text-align:center"><a
                                        href="A_ProductDetail.php?id=<?php echo $row['ProductID'];?>"><input
                                            type="button" style="border:none; background: none;" name="view"
                                            value="View More"></a>
                                </td>
                            </tr>
                            <?php  
                        };  
                        ?>
                        </tbody>
                </table>
                <?php
            
            $query = mysqli_query($con,"SELECT COUNT(ProductID) FROM product");
            $row_db = mysqli_fetch_row($query);  
            $total_records = $row_db[0];  
            $pages =  ceil($total_records / $limit);
            $pagLink = "<ul class='pagination' style='margin-left:95%'>"; 
            for ($i=1; $i<=$pages; $i++) {
                $pagLink .= "<li class='page-item'><a class='page-link' href='AdminProduct.php?page=".$i."'>".$i."</a></li>";	
            }
            echo $pagLink . "</ul>"; 
            ?>
            </div>
        </section>
        </main>


        <!-- Start Script -->
        <script src="assets/js/jquery-1.11.0.min.js"></script>
        <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <!-- End Script -->


    </body>
</form>

</html>