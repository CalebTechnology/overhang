<?php
////////////////
//PHP & MySQL//
//////////////

// PHP offers various functions for connecting to and accessing data from MySQL
//There are two main libraries to chose From
//MySQLi (improved)
//PDO (PHP Data Objects)

//My SQLi is specific for MySQL but has been deprecated in 2017.
//PDO works with 12 different database systems

//Connecting to MySQL
//We need to provide:
//1. Server
//2. Database we want to connect to
//3. username
//4. password

$server = "localhost";
$dbname = "overhang_behavior_packs";
$username = "root";
$password = "";

try {
  //Create a PDO object with host, dbname, username, and password
  $conn = new PDO("mysql:host=$server;dbname=$dbname;",$username,$password);
  //Changing the presentation of errors to exceptions using the setAttribute() method of the
  //PDO object.
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //Changing the default format of returning rows as an associative array
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  //echo "Connected to database succesfully";
} catch (PDOException $e) {
  echo "Connection to database failed: " . $e->getMessage();
}
