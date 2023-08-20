<?php

$host = 'localhost';
$dbname = 'jamtangan';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Select the database
if (!mysqli_select_db($conn, $dbname)) {
  die('Could not select database');
}

?>
