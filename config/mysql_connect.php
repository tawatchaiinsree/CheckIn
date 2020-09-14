<?php
$servername = "34.126.84.199";
$username = "root";
$password = "02CorpInc";
$dbname = "checkin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
