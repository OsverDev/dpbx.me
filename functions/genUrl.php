<?php

include_once 'globalFunctions.php';

$username = "";
$tinyURL = strtoupper(generateRandomString(5));

if (!isset($_POST['username']) and !isset($_GET['username'])) {
  //we didnt reacieve a username
  exit(0);
}else{
  $username = $_GET['username'];
}

// $table is randomString
$keys = array("username","tinyURL");
$values = array($username,$tinyURL);
echo insertDataIntoDatabase("tusername", $keys, $values)? $tinyURL : '0';

 ?>
