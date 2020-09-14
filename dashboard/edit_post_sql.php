<?php
include('../includes/connect.php');
date_default_timezone_set("America/Chicago");
$sql = "UPDATE feed SET title='" . $_POST['title'] . "', comment='" . $_POST['comment'] . "', edited=True, uploaded='" . date('Y-m-d H:i:s') . "' WHERE id=" . (int)$_POST['id'];
try {
  $conn->query($sql);
  header('Location: feed_posts.php');
  echo "Feed post updated successfully!";
} catch (Exception $e) {
  echo "Error updating feed post:" . $e->getMessage();
}
?>
