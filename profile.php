<?php 
include_once('function.php');

if(!isset($_SESSION['LoginUser'])){
  header('Location: Login.php');
}

$user = getUserById($_SESSION['LoginUser']['ID']);


if(isset($_POST['submit'])){
  $status = updateUserInfo($_SESSION['LoginUser']['ID'], $_POST['firstname'], $_POST['lastname']);
if($status === "Success"){
  header("Location: profile.php");
}else{
  echo "<div class='bg-danger bg-gradient text-white p-2'>$status</div>";

}
}

?>


<?php include_once ('templates/header.php');?>

<div class="container">

  <?php if($user): ?>
  <h1 class="my-5">My Profile</h1>
  <form method="POST" enctype="multipart/form-data">
    <div class="my-2">
      <label class="form-label"> First Name</label>
      <input type="text" name="firstname" id="firstname" class="form-control form-control-lg" required value="<?= $user['firstname'];?>">
    </div>
    <div class="my-2">
      <label class="form-label"> Last Name</label>
      <input type="text" name="lastname" id="lastname" class="form-control form-control-lg" required value="<?= $user['lastname'];?>">
    </div>
    
    <input type="hidden" name="ID" value="<?=$user['ID'];?>">
    <button type="submit" name="submit" class="btn btn-primary my-2 btn-lg">Update Profile</button>
  
  </form>
  <?php else: ?>
    <h3 class="mt-5">User does not exist </h3>

  <?php endif; ?> 
</div>

<?php include_once('templates/footer.php')?>