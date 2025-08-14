<?php 
if(session_status() === PHP_SESSION_NONE){
  session_start();
}

include_once('function.php');

//process
if(isset($_POST['submit'])){
  $row = login($_POST['email'], $_POST['password']);
  if($row){
    $_SESSION['LoginUser'] = array(
      "ID" => $row['ID'],
      "firstname" => $row['firstname'],
      "lastname" => $row['lastname'],
      "email" => $row['email']
    );
    header('Location: index.php');

    // echo "<div class = 'bg-success text-white p-2'> Login Success! </div>";
  }else{
    echo "<div class = 'bg-danger text-white p-2'> $status </div>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/css/bootstrap.min.css" integrity="sha512-fw7f+TcMjTb7bpbLJZlP8g2Y4XcCyFZW8uy8HsRZsH/SwbMw0plKHFHr99DN3l04VsYNwvzicUX/6qurvIxbxw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/js/bootstrap.min.js" integrity="sha512-zKeerWHHuP3ar7kX2WKBSENzb+GJytFSBL6HrR2nPSR1kOX1qjm+oHooQtbDpDBSITgyl7QXZApvDfDWvKjkUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <title>CRE- Product System</title>
</head>
<body>
  <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
    <form method="POST" class="d-flex flex-column gap-3 w-25 mx-auto border p-3">
      <h2 class="text-center">Login Form</h2>
        <!--email-->
        <div class="mb-3"> 
          <label class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" autocomplete="off" required>
        </div>
        <!--password-->
        <div class="mb-3"> 
          <label class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="bg-success btn btn-lg text-white">Login</button>
        <div class="text-center d-flex flex-column gap-2">
          <a href="register.php" class="text-decoration-none">Don't have a account? Resgister here! </a>
          <a href="forgot.php" class="text-decoration-none text-danger"> Forget Password</a>
        </div>
    </form>
  </div>
  
</body>
</html>