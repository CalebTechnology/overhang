<?php
include('../includes/connect.php');
require('../includes/session.php');
date_default_timezone_set("America/Chicago");

$target_dir = "../uploads/" . $_SESSION['username'] . "/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if($_FILES["image"]["name"] != '') {
  echo $uploadOk;
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  echo $uploadOk;
  if($uploadOk == 1){
    $original_file = $target_dir . basename($_FILES["image"]["name"]);
    $append_num = 1;
    $extension =  pathinfo($original_file)['extension']; // "ext"
    $filename =  pathinfo($original_file)['filename']; // "file"
    $target_file = $target_dir . $filename . '_' . $append_num . '.' . $extension;
    while (file_exists($target_file)) {
      $target_file = $target_dir . $filename . '_' . $append_num . '.' . $extension;
      $append_num += 1;
    }
    $extension =  pathinfo($target_file)['extension']; // "ext"
    $filename =  pathinfo($target_file)['filename']; // "file"

    // Check file size
    if ($_FILES["image"]["size"] > 500000000) {
      echo "Sorry, your file is too large." . PHP_EOL;
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded." . PHP_EOL;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded." . PHP_EOL;
      } else {
        echo "Sorry, there was an error uploading your file." . PHP_EOL;
      }
    }
  }
}

if($uploadOk == 1){
  $sql = "INSERT INTO feed (`title`, `comment`, `image`, `username`, `uploaded`) VALUES ('" . $_POST['title'] . "','" .  $_POST['comment'] . "', 'uploads/" . $_SESSION['username'] . '/' . $filename . "." . $extension . "','" . $_SESSION['username'] . "','" . date("Y-m-d H:i:s") . "')";
}
else {
  $sql = "INSERT INTO feed (`title`, `comment`, `username`, `uploaded`) VALUES ('" . $_POST['title'] . "','" .  $_POST['comment'] . "','" . $_SESSION['username'] . "','" . date("Y-m-d H:i:s") . "')";
}
echo $sql . PHP_EOL;
try {
  $conn->query($sql);
  header('Location: feed_posts.php');
  echo "Feed post updated successfully!" . PHP_EOL;
} catch (Exception $e) {
  echo "Error updating feed post:" . $e->getMessage() . PHP_EOL;
}
?>
