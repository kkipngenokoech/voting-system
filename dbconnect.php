<?php
// Start the session

if (!isset($_SESSION)) {
    session_start();
};

//connect to database
$servername = "http://sql8.freemysqlhosting.net/";
$username = "sql8604030";
$dbpassword = "birwj3A3yM";
$databasename = "sql8604030";

$dbconnect = mysqli_connect($servername, $username, $dbpassword, $databasename);
// $conn = new mysqli($servername,$username,$dbpassword);

// check whether database connection is successful
if (!$dbconnect) {
    echo "Database failed to Connect" . mysqli_connect_error();
} else {
    //create variable to pick up session variable
    // $firstname = $_SESSION['firstname'];
    // $othernames = $_SESSION['othernames'];
}

//check whether the user is logged in
if (!isset($_SESSION['firstname'])) {
    //redirect user to login page
    // header('Location:login.php');
}

// if ($conn->connect_error) {
//     die("Connection failed: "
//         . $conn->connect_error);
//   }
//   echo "Connected successfully";