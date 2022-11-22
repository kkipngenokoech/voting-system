<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../dbconnect.php";

//picking data from stored session
$firstname = $_SESSION['firstname'];
$othernames = $_SESSION['othernames'];
?>

<?php require("header.php") ?>


<?php require("footer.php") ?>


