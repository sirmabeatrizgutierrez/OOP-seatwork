<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_bank1";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>
<!-- Edison Eslabra -->