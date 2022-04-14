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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Report</title>
    <meta charset="UTF-8" name="viewport" content="width=device-widht, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
    body {
        background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
        }
    }

    h3 {
        text-align: center;
        font-family: 'Oswald', sans-serif !important;

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
                    <a href="AdminHome.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Customer Order</span>
                    </a>
                    <a href="Admin_Voucher.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-lock fa-fw me-3"></i><span>Voucher</span></a>
                    <a href="Admin_Cate.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-line fa-fw me-3"></i><span>Category</span></a>
                    <a href="Admin_Report.php" class="list-group-item list-group-item-action py-2 ripple active">
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

    <form method="POST" action="">
        <main style="margin-top: 58px">

            <select name="month">
                <option value="">---Select a month---</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select name="year">
                <option value="">---Select a year---</option>
                <?php
					for($i=date("Y"); $i >= 1965; $i--){
						echo "<option value='".$i."'>".$i."</option>";
					}
				?>
            </select>
            <button class="btn btn-success" name="filter"><span class="glyphicon glyphicon-search"></span>
                Filter</button>
                <button class="btn btn-success" onclick="window.print()">Print Report</button>
        </main>
    </form>
    <?php
	$conn = mysqli_connect('localhost', 'root', '', 'joofatrading');
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
	if(ISSET($_POST['filter'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
		$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		
	
			echo "<h3>".$months[$month - 1]." ".$year."</h3>";
		?>

    <form class="" action="ProductDetail.php?id=<?php $product_id ?> " method="post" enctype="multipart/form-data">
        <main style="margin-top: 58px">

            <div class="tab-content">
                <div id="week1" style="padding:10px;">
                    <table class="table table-bordered">
                        <thead class="alert-success">
                            <tr>
                                <th width=20%>ProductImage</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price Per Item</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:#fff;">
                            <?php
							$data = [];
							$query = mysqli_query($conn, "SELECT DISTINCT(p.ProductID), p.ProductName, p.ProductPrice, p.ProductPic, YEAR(r.date) As year, MONTH(r.date) AS month FROM `shopping_cart` as r INNER JOIN product as p ON r.ProductID = p.productID  WHERE YEAR(r.date) = '$year' && MONTH(r.date) = '$month' && r.Status='Complete' ") or die(mysqli_error());
							while($row = mysqli_fetch_array($query)){
                                $query2 = mysqli_query($conn, "SELECT *, YEAR(date) As year, MONTH(date) FROM `shopping_cart` WHERE YEAR(date) = '$year' && MONTH(date) = '$month' && ProductID = '".$row["ProductID"]."'  ") or die(mysqli_error());
                                while($row2 = mysqli_fetch_array($query2)){
                                    $totalquantity += $row2["Quantity"];
                                }
                                $totalprice = $totalquantity * $row["ProductPrice"];

						?>
                            <tr>
                                <td width=20%><img src="<?php echo $row['ProductPic']?>" alt="product Img" width=100%>
                                </td>
                                <td><?php echo $row["ProductName"] ?></td>
                                <td><?php echo $totalquantity ?></td>
                                <td>RM<?php echo $row["ProductPrice"] ?></td>
                                <td>RM<?php echo $totalprice ?></td>
                            </tr>
                            <?php
							
                            $totalprice = 0;
                            $totalquantity = 0;									
							}
						?>

                        </tbody>
                    </table>
                </div>
        </main>


        <?php
	}else{
        
        
    ?>
        <main style="margin-top: 58px">

            <table class="table table-bordered">
                <thead class="alert-success">
                    <tr>
                        <th width=20%>ProductImage</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price Per Item</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody style="background-color:#fff;">
                    <?php
                
					$conn = mysqli_connect('localhost', 'root', '', 'joofatrading');
					$query = mysqli_query($conn, "SELECT DISTINCT(p.ProductID), p.ProductName, p.ProductPrice, p.ProductPic  FROM `shopping_cart` as r INNER JOIN product as p ON r.ProductID = p.ProductID WHERE r.Status='Complete'") or die(mysqli_error());
					while($row = mysqli_fetch_array($query)){
                        $query2 = mysqli_query($conn, "SELECT * FROM `shopping_cart` WHERE ProductID = '".$row["ProductID"]."' ") or die(mysqli_error());
                        while($row2 = mysqli_fetch_array($query2)){
                            $totalquantity2 += $row2["Quantity"];
                        }
                        $totalprice = $totalquantity2 * $row["ProductPrice"];
                        ?>
                    <tr>

                        <td width=20%><img src="<?php echo $row['ProductPic']?>" alt="product Img" width=100%>
                        </td>
                        <td><?php echo $row["ProductName"] ?></td>
                        <td><?php echo $totalquantity2 ?></td>
                        <td>RM<?php echo $row["ProductPrice"] ?>/per item</td>
                        <td>RM<?php echo $totalprice ?></td>
                    </tr>
                    <?php
                    $totalprice = 0;
                    $totalquantity2 = 0;
					}
				?>
                </tbody>
            </table>
        </main>
        <?php
	}
    ?>
    </form>


</body>


</html>