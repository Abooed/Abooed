<?php
// $conn = new mysqli("localhost","root","","shamil_db");

// // Check connection
// if ($conn -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $conn -> connect_error;
//   exit();
// }
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=shamil_db", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>