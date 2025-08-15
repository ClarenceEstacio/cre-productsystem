  <?php 
    include_once('function.php');

    if(isset($_POST['submit'])){
      // confirm password
      if($_POST['password'] === $_POST['confirm_password']){
        //process
        $status = register($_POST['email'], $_POST['password']);
        if($status === "Success"){
          echo "<div class = 'bg-success text-white p-2'> Register Success. You can now login </div>";
        }else{
          echo "<div class = 'bg-danger text-white p-2'> $status </div>";
        }
        // store session


      }else{
        echo "<div class = 'bg-danger text-white p-2'> Password does not match </div>";
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
      <form method="POST" class="d-flex flex-column gap-3 w-25 mx-auto border p-3 rounded shadow" >
        <h2 class="text-center">Register Form</h2>
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
          <!--confirm password-->
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
          </div>
          <button type="submit" name="submit" class="bg-success btn btn-lg text-white">Register</button>
          <div class="text-center d-flex flex-column gap-2">
            <a href="login.php" class="text-decoration-none">Already have an Account? Login here! </a>
            <a href="forgot.php" class="text-decoration-none text-danger"> Forget Password</a>
          </div>
      </form>
    </div>
    
  </body>
  </html>