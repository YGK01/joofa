<?php 

include('assets/config.php');
$cartID = $_GET["id"];
$delete = "DELETE from shopping_cart  WHERE cartID = '$cartID'";
mysqli_query($con, $delete);
header("location:shopping_cart.php");
?>