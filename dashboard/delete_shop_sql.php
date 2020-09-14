<?php
require('../includes/session.php');
date_default_timezone_set("America/Chicago");

include('../includes/connect.php');
$sql = "SELECT * FROM shops WHERE id='" . $_GET['id'] . "'";
try{
  $result = $conn->query($sql);
  $row = $result->fetch();
  $name = $row['name'];
  $conn->query($sql);
  try {
    include('../includes/shops_connect.php');
    $sql = "DROP TABLE `" . $name . "`";
    $conn->query($sql);
    try {
      include('../includes/connect.php');
      $sql = 'DELETE FROM shops WHERE id=' . $_GET['id'];
      $conn->query($sql);
      header('Location: shops.php');
      echo "Shop deleted successfully!" . PHP_EOL;
    } catch (Exception $e) {
      echo "Error deleting shop:" . $e->getMessage() . PHP_EOL;
    }
  } catch (Exception $e) {
    echo "Error deleting shop:" . $e->getMessage() . PHP_EOL;
  }
} catch (Exception $e) {
  echo "Error deleting shop:" . $e->getMessage() . PHP_EOL;
}
?>
