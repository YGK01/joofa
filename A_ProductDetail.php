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

$product_id=$_GET["id"];
$result = mysqli_query($con,"SELECT * FROM product WHERE  ProductID = '$product_id'");
$row = $result->fetch_assoc();
?>

<?php
if(isset($_POST['update'])){

    $pname = $_POST['P_Name'];
    $pdesc = $_POST['P_Desc'];
    $pprice = $_POST['P_Price'];
    $pstatus = $_POST['P_Status'];
    $pweight = $_POST['P_Weight'];

    $target_dir = "assets/img/"; // set target directory
    $target_filename = basename($_FILES["P_Img"]["name"]); // set target filename
    $target_file = $target_dir . $target_filename; // concatenate
    
    $uploadOk = TRUE; // variable to determine if upload was successful
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // get file type/extension
    // Only allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "HEIC" && $imageFileType != "png" ) {
    echo $imageFileType;
    $uploadOk = FALSE;
    }
    // Check if $uploadOk is set to FALSE by an error
    if (!$uploadOk) {
        echo "Failure: your file was not uploaded.";
    }else{
    if (move_uploaded_file($_FILES["P_Img"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["P_Img"]["name"])). " has been
    uploaded.";
    } else {
        echo "Error: there was an error uploading your file.";
    }
    }
    if ($uploadOk) {

        $insert = "UPDATE product SET ProductName = '$pname', ProductPrice = '$pprice',  weight='$pweight' ,ProductDescription = '$pdesc',  ProductStatus = ' $pstatus', ProductPic = '$target_file' WHERE ProductID = '$product_id'";

        mysqli_query($con,$insert);
        header('Location: AdminProduct.php');
    }else{
        $insert = "UPDATE product SET ProductName = '$pname', ProductPrice = '$pprice', weight='$pweight' ,ProductDescription = '$pdesc',  ProductStatus = ' $pstatus' WHERE ProductID = '$product_id'";

        mysqli_query($con,$insert);
        header('Location: AdminProduct.php');
    }
    //

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Product Detail Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">


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
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="AdminHome.php" class="list-group-item list-group-item-action py-2 ripple">
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
    <!-- Open Content -->
    <form method="post" enctype="multipart/form-data">
        
    <main style="margin-top: 58px">
        <section class="bg-light">
            <div class="center">
                <div class="left">
                    <label></label>
                    <img src="<?php echo $row['ProductPic']?>" alt="product Img" width=400px>
                </div>

                <div class="left">
                    <label for="file-ip-1">Upload Image</label>
                    <input type="file" name="P_Img" />
                </div>

                <div class="left">
                    <label>Product Name</label>
                    <input type="text" name="P_Name" value="<?php echo $row['ProductName'] ?>" />
                </div>
                <div class="left">
                    <label>Description</label><br>
                    <label></label>
                    <textarea name="P_Desc" rows="4" cols="50"><?php echo $row['ProductDescription'] ?></textarea>
                </div>

                <div class="left">
                    <label>Weight</label>
                    <input type="text" name="P_Weight" value="<?php echo $row['weight'] ?>" />
                </div>

                <div class="left">
                    <label>Price</label>
                    <input type="text" name="P_Price" value="<?php echo $row['ProductPrice'] ?>" />
                </div>


                <div class="left">
                    <label for="file-ip-1">Status</label>
                    <select name="P_Status">
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <input type="submit" value="Update" style="margin-left:100%" name="update">

            </div>
        </section>
</main>
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