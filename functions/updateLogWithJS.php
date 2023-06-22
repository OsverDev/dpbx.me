<?php
include_once 'globalFunctions.php';

if (!isset($_GET['identifier'])) {
  // 'identifier does NOT exists'
  exit(0);
}

// $columns = array('id');
$columns = array('id');
$conditions = array('identifier' => $_GET['identifier']);

echo json_encode(fetchDataFromDatabase("tlog", $columns, $conditions));


 ?>
