
<?php 
    // session_start(); 
    include_once('db.php') ;

if (isset($_POST['login']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $login = validate($_POST['login']);

    $password = validate($_POST['password']);

    if (empty($login)) {
        header("Location: error.php?error=login is required");
        exit();
    }else if(empty($password)){
        header("Location: error.php?error=password is required");
        exit();
    }else{
        //اتصال الجدول مع الحقول والتأكد من البيانات 
        $sql = "SELECT * FROM accounts_tbl WHERE login='$login' AND password='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['login'] === $login && $row['password'] === $password) {

                $_SESSION['id'] = $row['id'];

                header("Location: index.php");

                exit();

            }else{
                header("Location: error.php?error=Incorect User name or password");
                exit();
            }

        }else{
            header("Location: error.php?error=Incorect User name or password");
            exit();
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="login">
    </div>
    <div class="form-group">
      <label for="pwd">password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
