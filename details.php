<?php
  error_reporting(E_ALL);
  include_once ('./function.php');
  $id = $_GET['ID'];
  if(isset($id)){
    $product = getProductById($id);
  }

  if(isset($_POST['delete'])){
    deleteProduct($_POST['ID']);
    header('Location: index.php');
  }
?>
<?php include_once ('templates/header.php');?>

  <div class="container">
    <?php if($product): ?>
    <h1 class="mt-5"><?= $product['product_name'];?></h1>
    <div class="mt-2">


    <form method="POST">
      <div class="btn-group my-4 gap-1">
        <a href="editProduct.php?ID=<?= $product['ID'];?>" class="btn btn-primary">Edit Product</a>
        <button name="delete" class="btn btn-danger">Delete Product</button>
        <input type="hidden" name="ID" value="<?= $product['ID'];?>">
      </div>
    </form>

      

      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Description</th>
            <td> <?= $product['product_description'];?></td>
          </tr>
          <tr>
            <th>Created at</th>
            <td><?= $product['createdAt'];?></td></tr>
          <tr>
            <th>Updated at</th>
            <td></td>
          </tr> 
          <tr>
            <th >Product Images</th>
            <td class="text-center"><img src="uploads/<?= $product['product_image'];?>" alt="<?= $product['product_image'];?>"></td>
          </tr> 
        </thead>
      </table>
    </div>
    <?php else: ?>
      <h3 class="mt-5">Product does not exist.</h3>
    <?php endif; ?>

  </div>
<?php include_once('templates/footer.php')?>