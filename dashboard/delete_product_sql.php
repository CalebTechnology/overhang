<?php
require('../includes/session.php');
date_default_timezone_set("America/Chicago");

include('../includes/connect.php');
$sql = "SELECT * FROM shops WHERE id='" . $_GET['shop_id'] . "'";
try{
  $result = $conn->query($sql);
  $row = $result->fetch();
  $shop_name = $row['name'];
  $conn->query($sql);
  try {
    include('../includes/shops_connect.php');
      $sql = 'DELETE FROM `' . $shop_name . '` WHERE id=' . $_GET['product_id'];
      $conn->query($sql);
      header('Location: shops.php');
      echo "Shop deleted successfully!" . PHP_EOL;
    } catch (Exception $e) {
      echo "Error deleting product:" . $e->getMessage() . PHP_EOL;
    }
} catch (Exception $e) {
  echo "Error deleting product:" . $e->getMessage() . PHP_EOL;
}
?>
