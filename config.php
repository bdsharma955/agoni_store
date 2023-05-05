
<?php 

$hostname = "localhost";
$database = "agoni_store";
$username = "root";
$password = "";

try {
  $connection = new PDO("mysql:host=$hostname;dbname=agoni_store", $username, $password);
  // set the PDO error mode to exception
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

require_once('function.php');

function APP_URL(){
  echo "http://localhost/agoni_Store";
}
function GET_APP_URL(){
  return "http://localhost/agoni_Store";
}

?>