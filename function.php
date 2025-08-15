<?php

error_reporting(E_ALL);
if(session_status() === PHP_SESSION_NONE){
  session_start();
}

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

function insertProduct($productName, $productDescription, $LogInUser) {
    try {
        $pdo = connect();
        
        $sqlSetTimezome = "SET time_zone = '+08:00'";
        $pdo->exec($sqlSetTimezome);

        
        $stmt = $pdo->prepare("INSERT INTO products (product_name, product_description, added_by, createdAt) VALUES (:productName, :productDescription, :addedBy, NOW())");
        $stmt->bindParam(':addedBy', $LogInUser['email']);
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

function editProduct($productId, $newProductName , $newProductDescription, $LogInUser) {
    try {
        $pdo = connect();
        $sqlSetTimezome = "SET time_zone = '+08:00'";
        $pdo->exec($sqlSetTimezome);

        $stmt = $pdo->prepare("UPDATE products SET product_name = :newProductName, product_description = :newProductDescription, update_by = :updatedBy, updatedAt = NOW() WHERE ID = :productId");
        $stmt->bindParam(":newProductName", $newProductName);
        $stmt->bindParam(":newProductDescription", $newProductDescription);
        $stmt->bindParam(":updatedBy", $LogInUser['email']);
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

function updateImageData($productId, $imageName){
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("UPDATE products SET product_image = :imageName WHERE ID = :productId");
        $stmt->bindParam(':imageName', $imageName);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        echo "Product images was updated successfully";
    } catch (PDOException $e) {
        echo "Image Edit filename Failed: ".$e->getMessage();
    }finally{
        $pdo = null;
    }

}

function uploadImage($fileInputName, $uploadDirectory, $newFileName){
    if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK){

        $tempFile = $_FILES[$fileInputName]['tmp_name'];
        $originalFileName = $_FILES[$fileInputName]['name'];

        // validate file type
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE); // kukuha ng details ng files
        $mineType = finfo_file($fileInfo, $tempFile);
        finfo_close($fileInfo);

        $allowedType = ['image/jpeg', 'image/png', 'image/gif'];

        if(!in_array($mineType, $allowedType)){
            return "Error: Invalid File type. Only JPG, PNG, and GIF images are allowed.";

        }
        // Rename the upload file
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $newFileNameWithExtension = $newFileName.'.'.$fileExtension;
        $destination = $uploadDirectory . '/' . $newFileNameWithExtension;
        
        if(!move_uploaded_file($tempFile, $destination)){
            return "Failed";
        }else{
            return $newFileNameWithExtension;
        }

        


    }else{
        return "Failed";

    }
}
function register($email, $password){
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email ");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO:: FETCH_ASSOC);
        if($row){
            return "User is already exist!";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUE (:email, :password)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->execute();
        return "Success";
        
    } catch (PDOException $e) {
        echo " Register Failed: ".$e->getMessage(); 
    }finally{
        $pdo = null;
    }

}

function login($email, $password){
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt ->bindParam(":email", $email);
        $stmt ->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            //verify password
            if(password_verify($password, $row['password'])){
                return $row;
                // return "Success";
            }else{
                return "Invalid credentials";
            }
        }else{
            return "User not found";
        }
    } catch (PDOException $e) {
        echo "Login Failed: ".$e->getMessage();
    }finally{
        $pdo = null;
    }
}
function getUserById($userId){
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT * from users WHERE ID = :userId");
        $stmt->bindParam('userId', $userId);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user;

    } catch (PDOException $e) {
        echo "Failed". $e->getMessage();
    }finally{
        $pdo = null;
    }
}

function updateUserInfo($userId, $firstname, $lastname){

    try {
        $pdo = connect();
        $stmt = $pdo->prepare("UPDATE users Set firstname = :firstname, lastname = :lastname WHERE ID = :userId");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname',$lastname);
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
        return "Success";

    } catch (PDOException $e) {
        echo "Update Failed". $e->getMessage() ;
    }finally{
        $pdo = null;
    }

}



