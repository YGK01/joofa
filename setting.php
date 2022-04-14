<?php
session_start();
error_reporting(0);
include('assets/config.php');

$c_id = $_SESSION["id"];
if(isset($_POST['update']))
{
    $curpass= $_POST['cur_pass'];
    $newpass= $_POST['new_pass'];
    $conpass= $_POST['con_pass'];
    $enc_curpass = md5($curpass);
    $enc_conpass = md5($conpass);

    $validate = "SELECT * FROM client WHERE clientID = '$c_id' AND clientPassword = '$enc_curpass'";
    $check = mysqli_query($con,$validate);
    $data =  $check->fetch_assoc();
    $count = mysqli_num_rows($check);
    
    if($count==1){
           $result = "UPDATE client SET clientPassword= '$enc_conpass' WHERE clientID = '$c_id'";
           mysqli_query($con,$result);
           header("location:homepage.php");
    }else{
        echo "<script>alert('Current Password does not match');</script>";
    }
}

if(isset($_POST['update_profile']))
{
    $name= $_POST['name'];
    $contact= $_POST['contact'];
    $email= $_POST['email'];
    $result = "UPDATE client SET clientName= '$name', clientEmail= '$email', clientContact= '$contact' WHERE clientID = '$c_id'";
    mysqli_query($con,$result);
    header("location:homepage.php");
    
}

if(isset($_POST['delete']))
{
    $result = "UPDATE client SET status='0' WHERE clientID = '$c_id'";
    mysqli_query($con,$result);
    header("location:login.php");
    
}

if(isset($_POST["new"]))
{
    header("location:modify_address.php?type=new");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Setting Page</title>
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
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">

    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial;
    }

    h2 {
        color: #000000;
        font-size: 20px;
        font-style: italic;
        font-family: sans-serif;
        padding-top: 5px;
        padding-left: 10%;

    }

    /* Style tab links */
    .tablink {
        background-color: #964b00;
        opacity: 0.5;
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        font-size: 20px;
        width: 25%;

    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: white;
        display: none;
        padding: 90px 50px;
        height: 100%;
    }

    #ChangePass {
        background-color: #C4A484;

    }

    #Add_Address {
        background-color: #C4A484;

    }

    #Profile {
        background-color: #C4A484;

    }

    .form-center {
        width: 400px;
        margin: 0 auto;
    }
    </style>
</head>

<body>
    <?php include('assets/C_header.php'); ?>

    <div class="container-md">
        <button class="tablink" onclick="openPage('Add_Address', this, '#C4A484 ')"id="defaultOpen">Address</button>
        <button class="tablink" onclick="openPage('ChangePass', this, '#C4A484 ')" >Change Password</button>
        <button class="tablink" onclick="openPage('Profile', this, '#C4A484 ')">Profile</button>

        <!-- change password -->
        <div id="ChangePass" class="tabcontent">
            <form method="post">
                <div class="row d-flex justify-content-center align-items-center h-50">
                    <div class="col-12 col-md-8 col-xl-5">
                        <div class="card-body p-1 text-center">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeEmailX-2">Current Password</label>
                                <input type="password" name="cur_pass" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2">New Password</label>
                                <input type="password" name="new_pass" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2">Confirm New Password</label>
                                <input type="password" name="con_pass" class="form-control form-control-lg" />
                            </div>

                            <input type="submit" value="Update" name="update" class="btn btn-success btn-lg btn-block">
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <!-- add address -->
        <div id="Add_Address" class="tabcontent">
            <form method="post">
                <div class="text-center">
                    <input type="submit" name=" new" style="center" value="Add Address"
                        class="btn btn-success btn-sm btn-block">
                    <hr>
                </div>

                <?php
                
                $query = "SELECT * FROM address WHERE ClientID = '$c_id' "; 
                $result = $con->query($query);
                while ($row=mysqli_fetch_array($result)) 
                {
                ?>

                <div class="form-outline mb-4">
                    <label>Address Name:</label>
                    <h2><?php echo $row['AddressName']; ?></h2>
                </div>

                <div class="form-outline mb-4">
                    <label>Contact Number:</label>
                    <h2><?php echo $row['contact']; ?></h2>
                </div>
                <div class="form-outline mb-4">
                    <label>Address:</label>
                    <h2><?php echo $row['Address']; ?></h2>
                </div>

                <input type="button"
                    onclick="window.location.href='modify_address.php?id=<?php echo $row['AddressID']; ?>&&type=edit';"
                    style="margin-left:90%;" value="Edit" class="btn btn-success btn-sm btn-block">
                <hr>
                <?php
                    }
                    ?>

            </form>
        </div>

        <!-- change password -->
        <div id="Profile" class="tabcontent">
            <form method="post">
                <div class="row d-flex justify-content-center align-items-center h-50">
                    <div class="col-12 col-md-8 col-xl-5">
                        <div class="card-body p-1 text-center">
                            <div class="form-outline mb-4">
                                <?php 
                                $query = "SELECT * FROM client WHERE clientID = '$c_id' "; 
                                $result = $con->query($query);
                                $row=mysqli_fetch_assoc($result);
                                ?>
                                <label class="form-label" for="typeEmailX-2">Full Name</label>
                                <input type="text" name="name" value="<?php echo $row['clientName'] ?>" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2">Contact</label>
                                <input type="text" name="contact" value="<?php echo $row['clientContact'] ?>" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2">Email</label>
                                <input type="text" name="email" value="<?php echo $row['clientEmail'] ?>" class="form-control form-control-lg" />
                            </div>

                            <input type="submit" value="Update" name="update_profile" class="btn btn-success btn-lg btn-block">
                            <input type="submit" value="Delete" name="delete" class="btn btn-success btn-lg btn-block">
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
    </div>

    <!-- Close Content -->



    <?php include('assets/footer.html'); ?>

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/chat.js"></script>
    <script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>
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
    <!-- End Script -->

</body>

</html>