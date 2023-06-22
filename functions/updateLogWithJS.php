<?php
include_once 'globalFunctions.php';

if (!isset($_POST['identifier'])) {
  // 'identifier does NOT exists'
  exit(0);
}

// $columns = array('id');
$columns = array('id');
$results = fetchDataFromDatabase("tUsernames",$columns,$conditions);
echo count(fetchDataFromDatabase($table, $columns, $conditions = array()));


 ?>
