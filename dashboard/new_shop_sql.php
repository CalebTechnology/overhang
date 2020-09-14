<?php
include('../includes/connect.php');
require('../includes/session.php');
date_default_timezone_set("America/Chicago");

$target_dir = "../uploads/" . $_SESSION['username'] . "/";
$target_file = $target_dir . basename($_FILES["exterior_image"]["name"]);
$exterior_uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if($_FILES["exterior_image"]["name"] != '') {
  echo $exterior_uploadOk;
  $check = getimagesize($_FILES["exterior_image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $exterior_uploadOk = 1;
  } else {
    echo "File is not an image.";
    $exterior_uploadOk = 0;
  }
  echo $exterior_uploadOk;
  if($exterior_uploadOk == 1){
    $original_file = $target_dir . basename($_FILES["exterior_image"]["name"]);
    $append_num = 1;
    $exterior_extension =  pathinfo($original_file)['extension']; // "ext"
    $exterior_filename =  pathinfo($original_file)['filename']; // "file"
    $target_file = $target_dir . $exterior_filename . '_' . $append_num . '.' . $exterior_extension;
    while (file_exists($target_file)) {
      $target_file = $target_dir . $exterior_filename . '_' . $append_num . '.' . $exterior_extension;
      $append_num += 1;
    }
    $exterior_extension =  pathinfo($target_file)['extension']; // "ext"
    $exterior_filename =  pathinfo($target_file)['filename']; // "file"

    // Check file size
    if ($_FILES["exterior_image"]["size"] > 500000000) {
      echo "Sorry, your file is too large." . PHP_EOL;
      $exterior_uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $exterior_uploadOk = 0;
    }
    // Check if $exterior_uploadOk is set to 0 by an error
    if ($exterior_uploadOk == 0) {
      echo "Sorry, your file was not uploaded." . PHP_EOL;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["exterior_image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["exterior_image"]["name"]). " has been uploaded." . PHP_EOL;
      } else {
        echo "Sorry, there was an error uploading your file." . PHP_EOL;
      }
    }
  }
}

#$target_dir = "../uploads/" . $_SESSION['username'] . "/";
$target_file = $target_dir . basename($_FILES["interior_image"]["name"]);
$interior_uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if($_FILES["interior_image"]["name"] != '') {
  echo $interior_uploadOk;
  $check = getimagesize($_FILES["interior_image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $interior_uploadOk = 1;
  } else {
    echo "File is not an image.";
    $interior_uploadOk = 0;
  }
  echo $interior_uploadOk;
  if($interior_uploadOk == 1){
    $original_file = $target_dir . basename($_FILES["interior_image"]["name"]);
    $append_num = 1;
    $interior_extension =  pathinfo($original_file)['extension']; // "ext"
    $interior_filename =  pathinfo($original_file)['filename']; // "file"
    $target_file = $target_dir . $interior_filename . '_' . $append_num . '.' . $interior_extension;
    while (file_exists($target_file)) {
      $target_file = $target_dir . $interior_filename . '_' . $append_num . '.' . $interior_extension;
      $append_num += 1;
    }
    $interior_extension =  pathinfo($target_file)['extension']; // "ext"
    $interior_filename =  pathinfo($target_file)['filename']; // "file"

    // Check file size
    if ($_FILES["interior_image"]["size"] > 500000000) {
      echo "Sorry, your file is too large." . PHP_EOL;
      $interior_uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $interior_uploadOk = 0;
    }
    // Check if $interior_uploadOk is set to 0 by an error
    if ($interior_uploadOk == 0) {
      echo "Sorry, your file was not uploaded." . PHP_EOL;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["interior_image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["interior_image"]["name"]). " has been uploaded." . PHP_EOL;
      } else {
        echo "Sorry, there was an error uploading your file." . PHP_EOL;
      }
    }
  }
}

if($exterior_uploadOk == 0 && $interior_uploadOk == 0){
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
}

try {
  $conn->query($sql);
  include('../includes/shops_connect.php');
  $sql = "CREATE TABLE `overhang_shops`.`" . $_POST['name'] . "` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `product_name` VARCHAR(60) NOT NULL , `price` VARCHAR(30) NOT NULL , `image` TEXT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
  $conn->query($sql);
  header('Location: shops.php');
  echo "Shop created successfully!" . PHP_EOL;
} catch (Exception $e) {
  echo "Error creating shop:" . $e->getMessage() . PHP_EOL;
}
?>
