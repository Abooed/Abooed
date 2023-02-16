<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    
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
    <a href="add.php">add</a>
    <a href="logout.php">logout</a>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">

<?php

    include_once('db.php');
    $sql = "SELECT * FROM user_tbl";
    $result = $conn->query($sql);

    // output data of each row
        echo'<table class="table table-hover" id="myTable">';
        echo' <thead>';
            echo' <tr>';
            echo'  <th>id</th>';
            echo' <th>username</th>';
            echo'  <th>Email</th>';
            echo'  <th>date</th>';
            echo'  <th>delete</th>';
            echo' </tr>';
            echo'</thead>';
            echo'<tbody>';  
    while($row = $result->fetch()) {
            echo' <tr id=>';
                echo' <td>'. $row["id"].'</td>';
                echo' <td>'. $row["user_name"].'</td>';
                echo' <td>'. $row["user_email"].'</td>';
                echo' <td>'. $row["creation_date"].'</td>';
                echo'<td><a OnClick="return confirm(\" هل أنت متأكد؟ \");" href=delete.php?id='.$row["id"].'>حذف</a> </td>';
                // echo'<td><a href=edit.php?id='.$row["id"].'>تعديل</a> </td>';
            echo' </tr>';
        }
        echo'</tbody>
        </table>';


}else{

     header("Location: login.php");

     exit();

}

?>
    </div>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
    </html>