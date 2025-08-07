<?php
function connect (){
  $host = 'sql310.infinityfree.com';
  $dbname = 'if0_39651259_productsystem';
  $username = 'if0_39651259';
  $password = 'tfPQMbzpK04xsP8';

  try {
    $pdo = new PDO("msql:host= $host; dbname= $dbname", $username, $password);


    $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXECEPTION);

    return $pdo;
    

  } catch (PDOException $e) {
    echo "Connection failed: " .$e->getMessage();
  }
  
}

function insertProduct($productName){
    try {
      $pdo = connect();

      $stmt = $pdo-> prepare("INSERT INTO products (product_name) VALUES (:productName)");
      $stmt -> bindParam(':productName', $productName);

      $stmt ->execute();

      echo("New Product data was added successfully");

    } catch (PDOException $e) {
      echo "Insertion failed: ". $e->getMessage();
    }
}

function deleteProduct($productId){
  try {
    $pdo = connect();

    $stmt = $pdo->prepare("DELETE FROM products WHERE ID = :productId");

    $stmt = bindParam(":productId", $productId);

    $stmt->execute();

    echo "Product Deleted Successfully!";
  } catch (PDO exception $e) {
    echo "Deletion failed: " . $e->getMessage();
  }
}

function editProduct($productId, $newProductName){
  try {
    $pdo = connect();
    
    $stmt = $pdo->prepare("UPDATE products SET product_name = :newProductName WHERE ID = :productId");

    $stmt->bindParam(":newProductName", $newProductName);
    $stmt->bindParam(":productId", productId);
    $stmt->execute();

    echo "Product Edited Sucessfully!";
  } catch (PDOexception $e) {
    echo "Edit failed: " . $e->getMessage();
  }
}