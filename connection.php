 <?php
$servername = "sql308.infinityfree.com";
$username = "if0_39583760";
$password = "evanghel262001";

try {
  $connection = new PDO("mysql:host=$servername;dbname=if0_39583760_db_libreria", $username, $password);
  

  // set the PDO error mode to exception
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
 catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
catch (Exception $e){
     echo $e->getMessage();
}
?>