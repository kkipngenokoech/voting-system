<?php
//connect to database
$servername = "localhost";
$username = "admin";
$dbpassword = "voters@2002";
$databasename = "voting";

$dbconnect = mysqli_connect($servername, $username, $dbpassword, $databasename);
// $conn = new mysqli($servername,$username,$dbpassword);

// check whether database connection is successful
if (!$dbconnect) {
    echo "Database failed to Connect" . mysqli_connect_error();
}
// if ($conn->connect_error) {
//     die("Connection failed: "
//         . $conn->connect_error);
//   }
//   echo "Connected successfully";
