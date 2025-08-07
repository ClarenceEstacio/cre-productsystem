<?php
function connect (){
  $host = 'sql310.infinityfree.com';
  $dbname = 'if0_39651259_productsystem';
  $username = 'if0_39651259';
  $password = 'tfPQMbzpK04xsP8';

  try {
    $pdo = new PDO("msql:host= $host; dbname= $dbname", $username, $password);


    $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXECEPTION);

    

  } catch (\Throwable $th) {
    echo "Connection failed: " .$e->getMessage();
  }
  
}

connect();