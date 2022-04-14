<?php
session_start();
session_destroy();
header('location:Logout.php');

if (!isset($_SESSION["email"])) {
header('location:A_Login.php');
}
 ?>