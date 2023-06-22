<?php

include_once 'globalFunctions.php';

$username = "";
$tinyURL = strtoupper(generateRandomString(5));

if (!isset($_POST['username']) and !isset($_GET['username'])) {
  //we didnt reacieve a username
  exit(0);
}else{
  $username = $_POST['username'].$_GET['username'];
}

// $table is randomString
$key = array {"username","tinyURL"};
$values = array {$username,$tinyURL};
echo insertDataIntoDatabase("tusernames", $keys, $values)? $tinyURL : '0';

 ?>
