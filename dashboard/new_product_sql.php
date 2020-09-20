<?php
include('../includes/connect.php');
require('../includes/session.php');
date_default_timezone_set("America/Chicago");



/*if($exterior_uploadOk == 0 && $interior_uploadOk == 0){
  $sql = "INSERT INTO shops (`name`, `owner`, `icon_category`, `icon`) VALUES ('" . $_POST['name'] . "', '" . $_SESSION['username'] . "', '" . $_POST['icon_category'] . "','" . $_POST['icon'] . "')";
}
elseif($exterior_uploadOk == 1 && $interior_uploadOk == 0){
  $sql = "INSERT INTO shops (`name`, `owner`, `exterior_image`, `icon_category`, `icon`) VALUES ('" . $_POST['name'] . "', '" . $_SESSION['username'] . "', 'uploads/" . $_SESSION['username'] . '/' . $exterior_filename . "." . $exterior_extension . "','" . $_POST['icon_category'] . "', '" . $_POST['icon'] . "')";
}
elseif($exterior_uploadOk == 0 && $interior_uploadOk == 1){
  $sql = "INSERT INTO shops (`name`, `owner`, `interior_image`, `icon_category`, `icon`) VALUES ('" . $_POST['name'] . "', '" . $_SESSION['username'] . "', 'uploads/" . $_SESSION['username'] . '/' . $interior_filename . "." . $interior_extension . "','" . $_POST['icon_category'] . "', '" . $_POST['icon'] . "')";
  }
elseif ($exterior_uploadOk == 1 && $interior_uploadOk == 1){
  $sql = "INSERT INTO shops (`name`, `owner`, `exterior_image`, `interior_image`, `icon_category`, `icon`) VALUES ('" . $_POST['name'] . "', '" . $_SESSION['username'] . "', 'uploads/" . $_SESSION['username'] . '/' . $exterior_filename . "." . $exterior_extension . "', 'uploads/" . $_SESSION['username'] . '/' . $interior_filename . "." . $interior_extension . "', '" . $_POST['icon_category'] . "','" . $_POST['icon'] . "')";
}*/

$sql = "SELECT * FROM shops WHERE id = " . $_GET['id'];
$result = $conn->query($sql);
$row = $result->fetch();
$shop_name = $row['name'];

if($_POST['category'] == "") {
  $sql = "INSERT INTO `overhang_shops`.`" . $shop_name . "` (`product_name`, `price`) VALUES ('" . $_POST['product'] . "', '" . $_POST['price'] . "')";
} else {
  $sql = "INSERT INTO `overhang_shops`.`" . $shop_name . "` (`product_name`, `price`, `image`) VALUES ('" . $_POST['product'] . "', '" . $_POST['price'] . "', 'minecraft-textures/" . $_POST['category'] . "/" . $_POST['product_texture'] . "')";
}

try {
  include('../includes/shops_connect.php');
  $conn->query($sql);
  header('Location: ../shop.php?id=' . $_GET['id']);
  echo "Product added successfully!" . PHP_EOL;
} catch (Exception $e) {
  echo "Error adding product:" . $e->getMessage() . PHP_EOL;
}
?>
