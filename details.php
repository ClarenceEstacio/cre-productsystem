<?php
  error_reporting(E_ALL);
  include_once ('./function.php');
  $id = $_GET['ID'];
  if(isset($id)){
    $product = getProductById($id);
  }
?>
<?php include_once ('templates/header.php');?>

  <div class="container">
    <?php if($product): ?>
    <h1 class="mt-5"><?= $product['product_name'];?></h1>
    <div class="mt-2">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Description</th>
            <td></td>
          </tr>
          <tr>
            <th>Created at</th>
            <td><?= $product['createdAt'];?></td></tr>
          <tr>
            <th>Updated at</th>
            <td></td>
          </tr>  
        </thead>
      </table>
    </div>
    <?php else: ?>
      <h3 class="mt-5">Product does not exist.</h3>
    <?php endif; ?>

  </div>
<?php include_once('templates/footer.php')?>