<?php
function connect() {
    /*
    $host = 'sql310.infinityfree.com';
    $dbname = 'if0_39651259_productsystem';
    $username = 'if0_39651259';
    $password = 'tfPQMbzpK04xsP8';
    */
    $host = 'localhost';
    $dbname = 'cre-productsystem';
    $username = 'root';
    $password = '';


    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }finally{
      $pdo = null;
    }
}

function insertProduct($productName, $productDescription) {
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("INSERT INTO products (product_name, product_description) VALUES (:productName, :productDescription)");
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':productDescription', $productDescription);
        $stmt->execute();
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo "Insertion failed: " . $e->getMessage();
    }finally{
      $pdo = null;
    }
}

function deleteProduct($productId) {
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("DELETE FROM products WHERE ID = :productId");
        $stmt->bindParam(":productId", $productId);
        $stmt->execute();
        echo "Product Deleted Successfully!";
    } catch (PDOException $e) {
        echo "Deletion failed: " . $e->getMessage();
    }finally{
      $pdo = null;
    }
}

function editProduct($productId, $newProductName) {
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("UPDATE products SET product_name = :newProductName WHERE ID = :productId");
        $stmt->bindParam(":newProductName", $newProductName);
        $stmt->bindParam(":productId", $productId);
        $stmt->execute();
        echo "Product Edited Successfully!";
    } catch (PDOException $e) {
        echo "Edit failed: " . $e->getMessage();
    }finally{
      $pdo = null;
    }
}

function getAllProducts() {
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    } catch (PDOException $e) {
        echo "Selection failed: " . $e->getMessage();
    }finally{
      $pdo = null;
    }
}

function getProductById($productId) {
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE ID = :productId");
        $stmt->bindParam(":productId", $productId);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage();
    }finally{
      $pdo = null;
    }
}


?>


