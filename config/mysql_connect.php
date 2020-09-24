<?php
$servername = "34.126.84.199";
$username = "checkin";
$password = "123456789";
$dbname = "checkin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
