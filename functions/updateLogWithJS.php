<?php
include_once 'globalFunctions.php';

if (!isset($_POST['identifier'])) {
  // 'identifier does NOT exists'
  exit(0);
}

// $columns = array('id');
$columns = array('id');
$conditions = array('identifier' => $_POST['identifier']);

if (count(fetchDataFromDatabase("tlog", $columns, $conditions))>0) {
  // the identifier was found in the db.

  if (updateDataInDatabase("tlog", $_POST, $conditions)) {
    exit(1);
  }
  else {
    //the identifier was not found in the db. User is doing something shady.
    //he changed the Javascirpt code on Cloudflare page.
    exit(-1);
  }
};


 ?>
