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
<?php
if(isset($_POST['upload'])){

    $pname = $_POST['P_Name'];
    $pdesc = $_POST['P_Desc'];
    $pprice = $_POST['P_Price'];
    $pcategory = $_POST['category'];
    $pweight = $_POST['P_Weight'];
    $pstatus = $_POST['P_Status'];

    
    $get = "SELECT * FROM product ";
    $login = mysqli_query($con,$get);
    $count = mysqli_num_rows($login);

    $newproduct = sprintf("P%05d", $count + 1);
    
    $upload_dir = 'assets/img/'.DIRECTORY_SEPARATOR;
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
     
    // Define maxsize for files i.e 2MB
    $maxsize = 2 * 1024 * 1024;
 
    // Checks if user sent an empty form
    if(!empty($_FILES['P_Img']['name'])) {
        $file_tmpname = $_FILES['P_Img']['tmp_name'];
        $file_name = $_FILES['P_Img']['name'];
        $file_size = $_FILES['P_Img']['size'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // Set upload file path
        $filepath = $upload_dir.$file_name;
        
        // Check file type is allowed or not
        if(in_array(strtolower($file_ext), $allowed_types)) {

            // Verify file size - 2MB max
            if ($file_size > $maxsize)        
                echo "Error: File size is larger than the allowed limit.";

            // If file with name already exist then append time in
            // front of name of the file to avoid overwriting of file
            if(file_exists($filepath)) {
                $filepath = $upload_dir.$file_name;
                if( move_uploaded_file($file_tmpname, $filepath)) {
                    echo "{$file_name} successfully uploaded <br />";
                    $insert = "INSERT INTO product VALUES ('". $newproduct ."', '". $pname ."', '". $pprice ."', '". $pdesc ."', '". $pcategory ."', '". $pweight ."', '". $pstatus ."', '" . $filepath . "')";
                    mysqli_query($con,$insert);
                    
                }
                else {                    
                    echo "Error uploading {$file_name} <br />";

                }
            }
            else {
                
                if( move_uploaded_file($file_tmpname, $filepath)) {
                    echo "{$file_name} successfully uploaded <br />";
                    $insert = "INSERT INTO product VALUES ('". $newproduct ."', '". $pname ."', '". $pprice ."', '". $pdesc ."', '". $pcategory ."', '". $pweight ."', '". $pstatus ."', '" . $filepath . "')";
                    mysqli_query($con,$insert);
                }
                else {                    
                    echo "Error uploading {$file_name} <br />";
                }
            }
        }
        else {
                
            // If file extension not valid
            echo "Error uploading {$file_name} ";
            echo "({$file_ext} file type is not allowed)<br / >";
        }
            
    }
    else {
         
        // If no files selected
        echo "No files selected.";
    }
    header('Location: AdminHome.php');
    
    $select = "SELECT * FROM client Where status = '1'";
    $query2 = mysqli_query($con, $select);
    while ($row=mysqli_fetch_array($query2))
    {
        $email = $row['clientEmail'];

        $token = md5($email).rand(10,9999);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$email."\r\n".
            'Reply-To: '.$email."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
        $message = '<html><body>';
        $message = 'New Product Arrival<br>';
        $message .= "<br>Product Name = ".$pname;
        $message .= "<br>Product Description = ".$pdesc;
        $message .= "<br>Product Price = ".$pprice;
        $message .= "<br>Please Visit Our website to get more deals ";
        $message .= "<a href='http://localhost/FYP-2/homepage.php'>Click For More Deals</a>";
        $message .= '</body></html>';

        $to = $email;

        $subject = "New Product Notification";
        
        $retval = mail ($to,$subject,$message, $headers);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Add Product Page</title>
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
        width: 45%;
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
        width: 150px;
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

    <form method="post" enctype="multipart/form-data">
        <!-- Open Content -->
        <main style="margin-top: 58px">

            <div class=row>
                <section class="bg-light">
                    <div class="container pb-5">
                        <div class="left">
                            <label>Product Name</label>
                            <input type="text" name="P_Name" placeholder="Product Name" />
                        </div>
                        <div class="left">
                            <label>Description</label><br>
                            <label></label>
                            <textarea name="P_Desc" rows="4" cols="50"></textarea>
                        </div>

                        <div class="left">
                            <label>Category</label>
                            <select name="category" id="category">
                                <?php $get = "SELECT * FROM category where categorystatus = 1";
                            $result = mysqli_query($con, $get);

                            while ($row=mysqli_fetch_array($result)) 
                            { ?>
                                <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="left">
                            <label>Price</label>
                            <input type="text" name="P_Price" placeholder="Product Price" />
                        </div>

                        <div class="left">
                            <label>Weight</label>
                            <input type="text" name="P_Weight" placeholder="Product Weight (gram)" />
                        </div>

                        <div class="left">
                            <label for="file-ip-1">Upload Image</label>
                            <input type="file" name="P_Img" onchange="showPreview(event);">
                        </div>

                        <div class="left">
                            <label for="file-ip-1">Status</label>
                            <select name="P_Status">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                        <div class="preview">
                            <img id="file-ip-1-preview" style="margin-left:60%; width:300px">
                        </div>

                        <input type="submit" value="Upload" name="upload">

                    </div>
                </section>
            </div>
        </main>
    </form>
    <!-- Close Content -->

    <script>
    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }
    </script>
</body>



</html>