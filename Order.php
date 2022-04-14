<?php
session_start();
error_reporting(0);

include('assets/config.php');

$c_id = $_SESSION["id"];
$limit = 5;
if (isset($_GET["page"])) {
	$page  = $_GET["page"];
	}
	else{
        $page=1;
	};
    $start_from = ($page-1) * $limit;
$query = "SELECT * FROM orderdetail WHERE clientID = '$c_id' ORDER BY OrderID ASC LIMIT $start_from, $limit";
$result1 = $con->query($query);

?>

<?php

if(isset($_POST['submit'])){
    // File upload configuration
    $pid = $_POST['pid'];
    $rate = $_POST['star'];
    // Configure upload directory and allowed file types
    $upload_dir = 'assets/img/'.DIRECTORY_SEPARATOR;
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');

    // Define maxsize for files i.e 2MB
    $maxsize = 2 * 1024 * 1024;

    // Checks if user sent an empty form
    if(!empty(array_filter($_FILES['files']['name']))) {

        // Loop through each file in files[] array
        foreach ($_FILES['files']['tmp_name'] as $key => $value) {

            $file_tmpname = $_FILES['files']['tmp_name'][$key];
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
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


                    }
                    else {
                        echo "Error uploading {$file_name} <br />";

                    }
                }
                else {

                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        echo "{$file_name} successfully uploaded <br />";
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
    }
    else {

        // If no files selected
        echo "No files selected.";
    }
    foreach ($_FILES['files']['name'] as $key => $name) {
        $items[] = $name;
    }

    $imgfile = implode(',' , $items);

    $desc = $_POST['desc'];
    $pid = $_POST['pid'];
    $rate = $_POST['star'];
    $cur = date("Y-m-d h:i:sa");

    $insert = "INSERT INTO `comment`(`commentID`, `commentDescription`, `rating`, `productID`, `clientID`, `date_added`, `images`) VALUES (null,'$desc','$rate','$pid','$c_id','$cur','$imgfile')";
    mysqli_query($con,$insert);
}

if(isset($_POST['delete']))
{
    $order = $_POST['orderid'];
    $insert = "UPDATE `orderdetail` SET `OrderStatus`='Delete' WHERE `OrderID` = '$order'";
    mysqli_query($con,$insert);
    header('location:homepage.php');
}


if(isset($_POST['complete']))
{
    $order = $_POST['orderid'];
    $update = "UPDATE `orderdetail` SET `OrderStatus`='Complete' WHERE `OrderID` = '$order'";
    mysqli_query($con,$update);
    header('location:homepage.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joo Fa Trading - Order History</title>
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
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="http://example.com/image-uploader.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .col-bg-9 {
        background-color: #ffffff;
    }

    .tip {
        width: 0px;
        height: 0px;
        position: absolute;
        background: transparent;
        border: 10px solid #ccc;
    }

    .tip-left {
        top: 10px;
        left: -20px;
        border-top-color: transparent;
        border-left-color: transparent;
        border-bottom-color: transparent;
    }

    .dialogbox .body {
        position: relative;
        max-width: 100%;
        height: auto;
        margin: 20px 10px;
        padding: 5px;
        background-color: #DADADA;
        border-radius: 3px;
        border: 3px solid #ccc;
    }

    .dialogbox .body1 {
        position: relative;
        max-width: 100%;
        height: auto;
        margin: 2px 10px;
        padding: 5px;
        background-color: #DADADA;
        border-radius: 3px;
        border: 3px solid #ccc;
    }

    .body .message {
        min-height: 20px;
        border-radius: 3px;
        font-family: Arial;
        font-size: 14px;
        line-height: 1.0;
        color: #797979;
    }

    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    .remove:hover {
        background: white;
        color: black;
    }

    div.stars {
        width: 270px;
        display: inline-block
    }

    .mt-200 {
        margin-top: 200px
    }


    input.star {
        display: none
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #4A148C;
        transition: all .2s
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #4A148C;
        transition: all .25s
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952
    }

    input.star-1:checked~label.star:before {
        color: #F62
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3)
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome
    }

    form.label {
        width: 24%;
        text-align: right;
        margin-left: 90%;
    }

    .test {
        margin-left: 90%;
    }

    @media only screen and (max-width: 900px) {
        .test {
            margin: auto;
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <section class="bg-light">
        <?php include('assets/C_header.php'); ?>
        <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="w-100 pt-1 mb-5 text-right">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="get" class="modal-content modal-body border-0 p-0">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="inzputModalSearch" name="q"
                            placeholder="Search ...">
                        <button type="submit" class="input-group-text bg-success text-light">
                            <i class="fa fa-fw fa-search text-white"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Open Content -->

        <div class="container pb-5">
            <div class="col-bg-9 p-3 border">

                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                    while ($row=mysqli_fetch_array($result1))
                    {
                        echo "<label for='' style='margin-left:80%'>" .$row['OrderStatus']."</label>";
                        $string1 = $row['ProductID'];
                        $string2 = $row['OrderNum'];
                        $str_arr1 = preg_split ("/\,/", $string1);
                        $str_arr2 = preg_split ("/\,/", $string2);
                        $i = count($str_arr1);
                        for($k = 0; $k<$i; $k++){
                            $CC1[$k]=$str_arr1[$k];//ProductID
                            $CC2[$k]=$str_arr2[$k];//Quantity

                            $result2 = mysqli_query($con,"SELECT * FROM  product WHERE ProductID = '".$CC1[$k]."'");
                            $row1 = $result2->fetch_assoc();
                            ?>


                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?php echo $row1['ProductPic']; ?>" width=100% alt="">
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-8 col-sm-6">
                                        <h1><?php echo $row1['ProductName']; ?></h1>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-8 col-sm-6">
                                        <label for="">Quantity :<?php echo $CC2[$k]; ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-sm-6">
                                        <label for="">Product Price: RM<?php echo  $row1['ProductPrice']; ?> /per
                                            unit</label>
                                    </div>
                                </div>
                                <?php $subtotal = $CC2[$k] * $row1['ProductPrice']; ?>
                                <label for="price">Amount: RM<?php echo $subtotal; ?></label>

                                <?php
                                    if($row['OrderStatus'] == "Complete")
                                    {?>

                                <input type="hidden" name="productid" value="<?php echo $CC1[$k] ?>">
                                <button type="button" class="open-homeEvents btn btn-success test"
                                    data-bs-toggle="modal" data-id="<?php echo $CC1[$k] ?>"
                                    data-bs-target="#exampleModal">
                                    Review </button>
                                <?php
                                    }
                                    ?>


                            </div>
                        </div>
                    </div>
                </form>



                <?php
                    }?>
                <hr>
                <?php
                    echo "<label for='' style='margin-left:85%'> <strong>Total Amount: RM".$row['OrderTotalPrice']."</strong></label>";
                    ?>
                <?php
                    if($row['OrderStatus'] == "Delivering")
                    {?>
                <button type="button" class="btn btn-success test "
                    onclick="linkTrack('<?php echo $row['TrackingNo'] ?>')">TRACK</button>
                    <form action="" method="post" >
                    <input type="hidden" name="orderid" value="<?php echo $row['OrderID']?>">

                    <input type="submit" class="btn btn-success test" name="complete" value="Complete">
                    </form>
                    <?php
                    }
                    ?>
                    <form action="" method="post" >
                    <?php
                    if($row['OrderStatus'] == "Ordered")
                    {?>
                    <input type="hidden" name="orderid" value="<?php echo $row['OrderID']?>">
                    <input type="submit" class="btn btn-success test" name="delete" value="delete">

                    <?php
                    }
                    ?>
                </form>
            </div>
            <br>
            <div class="col-bg-9">


                <?php } ?>
            </div>
            <br>
            <?php

                    $query = mysqli_query($con,"SELECT COUNT(OrderID) FROM orderdetail");
                    $row_db = mysqli_fetch_row($query);
                    $total_records = $row_db[0];
                    $pages =  ceil($total_records / $limit);
                    $pagLink = "<ul class='pagination'>";
                    for ($i=1; $i<=$pages; $i++) {
                        $pagLink .= "<li class='page-item'><a class='page-link' href='Order.php?page=".$i."'>".$i."</a></li>";
                    }
                    echo $pagLink . "</ul>";
                    ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Leave your comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="dialogbox">
                                        <div class="body">
                                            <div class="message">

                                                <input type="hidden" name="pid" id="textObject" />

                                                <div class="stars">
                                                    <input class="star star-5" id="star-5" value="5" type="radio"
                                                        name="star" />
                                                    <label class="star star-5" for="star-5"></label>

                                                    <input class="star star-4" id="star-4" value="4" type="radio"
                                                        name="star" />
                                                    <label class="star star-4" for="star-4"></label>

                                                    <input class="star star-3" id="star-3" value="3" type="radio"
                                                        vname="star" />
                                                    <label class="star star-3" for="star-3"></label>

                                                    <input class="star star-2" id="star-2" value="2" type="radio"
                                                        name="star" />
                                                    <label class="star star-2" for="star-2"></label>

                                                    <input class="star star-1" id="star-1" value="1" type="radio"
                                                        name="star" />
                                                    <label class="star star-1" for="star-1"></label>

                                                </div>

                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control w-100"
                                                        placeholder="Leave a comment here" name="desc" id="my-comment"
                                                        style="height:7rem;"></textarea>
                                                    <label for="my-comment">Leave a comment here</label>
                                                </div>
                                                <script
                                                    src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
                                                </script>
                                                <div class="field" text-align="left">
                                                    <h3>Upload your images</h3>
                                                    <input type="file" id="files" name="files[]" multiple />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
                                </div>
                            </div>
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
        <script src="assets/js/comment-img.js"></script>
        <script type="text/javascript" src="http://example.com/jquery.min.js"></script>
        <script type="text/javascript" src="http://example.com/image-uploader.min.js"></script>
        <script src="//www.tracking.my/track-button.js"></script>

        <script>
        $(document).on("click", ".open-homeEvents", function() {
            var eventId = $(this).data('id');
            textObject.value = eventId;
        });

        function linkTrack(num) {
            TrackButton.track({
                tracking_no: num
            });
        }
        </script>
        <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                                class: "imageThumb",
                                src: e.target.result,
                                title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
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
    </section>


</body>

</html>