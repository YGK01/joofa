<?php
session_start();
session_unset();
session_destroy();
header('location:c_logout.php');

if (!isset($_SESSION["id"])) {
header('location:login.php');
}
 ?>