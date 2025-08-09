<?php
  error_reporting(E_ALL);
  include_once ('./function.php');
  $products = getAllProducts();

  ?>
<?php include_once ('templates/header.php');?>

  <div class="container">
    <h1 class="mt-5">Product</h1>
    <div class="mt-2">
      <a href="addProduct.php" class="btn btn-lg bg-success text-white mb-3"> Add New Product</a>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Product name</th>
            <th>Created At</th>
          </tr>
        
        </thead>
        <tbody>
        <?php foreach ($products as $product){?>
            <tr>
              <td width = 50px> <a href="details.php?ID=<?= $product['ID'];?>" class="btn btn-sm bg-primary text-white">View</a></td>
              <td><?= $product['product_name'];?></td>
              <td><?= $product['createdAt'];?></td>
            </tr>
        <?php } ?>    
        </tbody>
      </table>
    </div>
  </div>
<?php include_once('templates/footer.php')?>