<?php
include_once('db.php');

$id = $_GET['id'];

$sql = "DELETE FROM user_tbl WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
  header("Location: index.php");

} else {
  echo "Error deleting record: " . $conn->error;
}

?>