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
// define variables and set to empty values
$nameErr = $emailErr  = $fileErr = "";
$user_name = $user_email =  $file = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(empty($_POST["user_name"]) || empty($_POST["user_email"]) || empty($_POST["file"]) ){
    if (empty($_POST["user_name"])) {
        $nameErr = "Name is required";
    } else {
        $user_name = $_POST["user_name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$user_name)) {
        $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["user_email"])) {
        $emailErr = "Email is required";
    } else {
        $user_email = $_POST["user_email"];
        // check if e-mail address is well-formed
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["file"])) {
        $fileErr = "file is required";
    }
  } else{
      include_once('db.php');

        $user_name = $_POST['user_name'];

        $user_email = $_POST['user_email'];

        // $target_dir = "uploads/";
        // $target_file = $target_dir . basename($_FILES["file"]["user_name"]);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        //   $check = getimagesize($_FILES["file"]["user_name"]);
        //   if($check !== false) {
        //     echo "File is an image - " . $check["mime"] . ".";
        //     $uploadOk = 1;
        //   } else {
        //     echo "File is not an image.";
        //     $uploadOk = 0;
        //   }
        // }

        $sql = "INSERT INTO user_tbl (user_name,user_email,user_image,creation_date) VALUES ($user_name ,$user_email,'Zz','20000' )";
  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
        if ( $stmt) {
              $stmt->exec();

            header("Location: index.php");

        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }     
  }


}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text"class="form-control" name="user_name" value="<?php echo $user_name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text"class="form-control" name="user_email" value="<?php echo $user_email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
    <input name="file" class="form-control" type="file" >
  <span class="error">* <?php echo $fileErr;?></span>
    
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <button type="button" name="" id="" class="btn btn-danger">cancel</button>
</form>

</body>
</html>