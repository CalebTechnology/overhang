<?php
include('../../includes/connect.php');
require('../../includes/session.php');
date_default_timezone_set("America/Chicago");

$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$sql = "INSERT INTO users (`username`, `password`, `email`, `phone_number`, `carrier`) VALUES ('" . $_POST['username'] . "', '" . $hashed_password . "', '" . $_POST['email'] . "', '" . $_POST['phone_number'] . "', '" . $_POST['carrier'] . "')";

if(in_array('admin', $_POST['permissions'])){
  $admin = 1;
} else {
  $admin = 0;
}
if(in_array('lumbo_land', $_POST['permissions'])){
  $lumbo_land = 1;
} else {
  $lumbo_land = 0;
}

try {
  $conn->query($sql);
  $sql = "INSERT INTO permissions (`username`, `admin`, `lumbo_land`) VALUES ('" . $_POST['username'] . "', " . $admin . ", " . $lumbo_land . ")";
  $conn->query($sql);
  header('Location: ../../dashboard/');
  echo "User created successfully!" . PHP_EOL;
} catch (Exception $e) {
  echo $sql . PHP_EOL;
  echo "Error creating user:" . $e->getMessage() . PHP_EOL;
}
?>
