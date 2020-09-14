<?php
include('../includes/connect.php');
require('../includes/session.php');
date_default_timezone_set("America/Chicago");


$sql = "DELETE FROM `feed` WHERE `feed`.`id` = " . $_GET['id'];
echo $sql . PHP_EOL;
try {
  $conn->query($sql);
  header('Location: feed_posts.php');
  echo "Feed post deleted successfully!" . PHP_EOL;
} catch (Exception $e) {
  echo "Error deleting feed post:" . $e->getMessage() . PHP_EOL;
}
?>
