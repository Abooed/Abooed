

<!DOCTYPE HTML>  
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
.error {color: #FF0000;}
</style>
<body>

<?php
include_once('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {


$id = $_GET['id'];

$user_name = $_POST['user_name'];

$user_email = $_POST['user_email'];


$sql = "UPDATE user_tbl SET user_name=$user_name AND user_email=$user_email WHERE id=$id";

// Prepare statement
$stmt = $conn->prepare($sql);

// execute the query
$stmt->exec();

// echo a message to say the UPDATE succeeded
echo $stmt->rowCount() . " records UPDATED successfully";
}
?>
<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text"class="form-control" name="user_name" value="<?php echo $user_name;?>">
  <br><br>
  E-mail: <input type="text"class="form-control" name="user_email" value="<?php echo $user_email;?>">
  <br><br>
    <input name="file" class="form-control" type="file" >
    
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <button type="button" name="" id="" class="btn btn-danger">cancel</button>
</form>

</body>
</html>