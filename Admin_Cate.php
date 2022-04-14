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

    $get = "SELECT * FROM category ORDER BY categoryID ASC LIMIT $start_from, $limit";

?>
<?php


if(isset($_POST['upload'])){
    
    $cName = $_POST['cate_name'];
    $cStatus = $_POST['status'];

    
    if($cName=="" && $cStatus=="" ){
        echo '<script>alert("Please Fill up the form")</script>';
    }
    
    $get1 = "SELECT * FROM category WHERE categoryName = '$cName'" ;
    $check = mysqli_query($con,$get1);
    
    $count = mysqli_num_rows($check);


    if($count>=1){
        echo '<script>alert("Category Name is Duplicated")</script>';
    }
    else{
        $insert = "INSERT INTO category VALUES (null, '". $cName ."', '". $cStatus ."')";
        mysqli_query($con,$insert);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Admin Category</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">
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
                    <a href="Admin_Cate.php" class="list-group-item list-group-item-action py-2 ripple active"><i
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
        <!-- Open Content -->
        <main style="margin-top: 58px">

        <div class=row>
            <section class="bg-light">
                <div class="container pb-5">

                    <div class="left">
                        <label>Category Name</label>
                        <input type="text" name="cate_name" placeholder="Category Name" />
                    </div>

                    <div class="left">
                        <label>Status</label>
                        <select name="status" id="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <input type="submit" value="Create" name="upload">

                    <table class="table caption-top">
                        <thead>
                            <tr>
                                <th scope="col">Category Name</th>
                                <th scope="col">Category Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                        $result = mysqli_query($con, $get);

                        while ($row=mysqli_fetch_array($result)) 
                        {
                        ?>
                            <tr>
                                <td><?php echo $row["category"] ?></td>
                                <td><?php echo $row["categoryStatus"] ?></td>
                                <td><a href="A_CategoryEdit.php?id=<?php echo $row["categoryID"]?>"
                                        style="text-decoration:none; ">Edit</a></td>
                            </tr>

                            <?php } ?>
                        </tbody>

                    </table>
                    <?php
            
            $query = mysqli_query($con,"SELECT COUNT(categoryID) FROM category");
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
        </div>
    </form>
    <!-- Close Content -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>



</html>