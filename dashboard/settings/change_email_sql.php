<?php
include('../../includes/connect.php');
require('../../includes/session.php');
$sql = "UPDATE users SET email='" . $_POST['email'] . "' WHERE username='" . $_SESSION['username'] . "'";
try {
  $conn->query($sql);
  header('Location: ../../dashboard');
  echo "Email updated successfully!";
} catch (Exception $e) {
  echo "Error updating email:" . $e->getMessage();
}
?>
