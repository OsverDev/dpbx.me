<?php

/*
returns the inner body code of a url
*/
function getInnerHTML($url) {
  // Create a new DOM Document
  $dom = new DOMDocument();

  // Load the HTML from the URL
  $html = file_get_contents($url);

  // Suppress errors/warnings for invalid HTML
  libxml_use_internal_errors(true);

  // Load the HTML into the DOM Document
  $dom->loadHTML($html);

  // Create a new DOMXPath object
  $xpath = new DOMXPath($dom);

  // Query the DOM for the innerHTML of the body element
  $bodyInnerHTML = '';
  $bodyNodes = $xpath->query('//body');
  if ($bodyNodes->length > 0) {
    $body = $bodyNodes->item(0);
    foreach ($body->childNodes as $child) {
      $bodyInnerHTML .= $dom->saveHTML($child);
    }
  }

  // Clear errors
  libxml_clear_errors();

  // Return the innerHTML of the body
  return $bodyInnerHTML;
}

// Gets the output of a php file.
function getOutput($file) {
  // Start output buffering
  ob_start();

  // Include or require the PHP file
  include $file;

  // Get the contents of the output buffer
  $output = ob_get_contents();

  // Clear and end the output buffer
  ob_end_clean();

  // Return the output
  return $output;
}

//generates random string of desired length
function generateRandomString($maxCharacters) {
  $bytes = ceil($maxCharacters / 2);
  $randomString = bin2hex(random_bytes($bytes));
  return substr($randomString, 0, $maxCharacters);
}

function funGetConn(){
}

// safley insert into db.
// $table is randomString
// $key is array {"name","location","sex"}
// $values is array {"bob","miami","m"}
function insertDataIntoDatabase($table, $keys, $values) {
  // Database connection details
  include $_SERVER['DOCUMENT_ROOT'].'/db/creds.php';

  try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);

    // Prepare the SQL statement
    $placeholders = implode(',', array_fill(0, count($keys), '?'));
    $sql = "INSERT INTO $table (".implode(',', $keys).") VALUES ($placeholders)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    foreach ($values as $index => $value) {
      $stmt->bindValue($index + 1, $value);
    }

    // Execute the prepared statement
    return $stmt->execute();

    // Close the connection
    $conn = null;
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    return false;
  }
}

// example:
// $columns = array('id');
// $conditions = array('username' => $username);
// $results = fetchDataFromDatabase("tUsernames",$columns,$conditions);
function fetchDataFromDatabase($table, $columns, $conditions = array()) {
  // Database connection details
  include $_SERVER['DOCUMENT_ROOT'].'/db/creds.php';


  try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);

    // Prepare the SQL statement
    $sql = "SELECT `" . implode("`,`", $columns) . "` FROM `$table`";

    // Append conditions if provided
    if (!empty($conditions)) {
      $sql .= " WHERE ";
      $conditionsString = array();
      foreach ($conditions as $column => $value) {
        $conditionsString[] = ":$column = $column";
      }
      $sql .= implode(" AND ", $conditionsString);
    }

    $sql.=";";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters if conditions were provided
    if (!empty($conditions)) {
      foreach ($conditions as $column => &$value) {
        $stmt->bindParam(":$column", $value);
      }
    }

    // Execute the prepared statement
    $stmt->execute();

    // Fetch all rows as associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the connection
    $conn = null;

    return $result;
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    return false;
  }
}



function updateDataInDatabase($table, $set, $conditions = array()) {
  // Database connection details
  include $_SERVER['DOCUMENT_ROOT'].'/db/creds.php';

  try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);


    // Prepare the SQL statement
    $sql = "UPDATE $table SET ";

    $setString = array();
    foreach ($set as $column => $value) {
      $setString[] = "$column = :$column";
    }
    $sql .= implode(", ", $setString);

    // Append conditions if provided
    if (!empty($conditions)) {
      $sql .= " WHERE ";
      $conditionsString = array();
      foreach ($conditions as $column => $value) {
        $conditionsString[] = "$column = :$column";
      }
      $sql .= implode(" AND ", $conditionsString);
    }

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    foreach ($set as $column => &$value) {
      $stmt->bindParam(":$column", $value);
    }

    // Bind the condition parameters if conditions were provided
    if (!empty($conditions)) {
      foreach ($conditions as $column => &$value) {
        $stmt->bindParam(":$column", $value);
      }
    }

    // Execute the prepared statement
    return $stmt->execute();

    // Close the connection
    $conn = null;

  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

/**
   * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
   * array containing the HTTP server response header fields and content.
   */
  function get_web_page($url){
      $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

      $options = array(

          CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
          CURLOPT_POST           =>false,        //set to GET
          CURLOPT_USERAGENT      => $user_agent, //set user agent
          CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
          CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
          CURLOPT_RETURNTRANSFER => true,     // return web page
          CURLOPT_HEADER         => false,    // don't return headers
          CURLOPT_FOLLOWLOCATION => true,     // follow redirects
          CURLOPT_ENCODING       => "",       // handle all encodings
          CURLOPT_AUTOREFERER    => true,     // set referer on redirect
          CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
          CURLOPT_TIMEOUT        => 120,      // timeout on response
          CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
      );

      $ch      = curl_init( $url );
      curl_setopt_array( $ch, $options );
      $content = curl_exec( $ch );
      $err     = curl_errno( $ch );
      $errmsg  = curl_error( $ch );
      $header  = curl_getinfo( $ch );
      curl_close( $ch );

      $header['errno']   = $err;
      $header['errmsg']  = $errmsg;
      $header['content'] = $content;
      return $header;
  }

 ?>
