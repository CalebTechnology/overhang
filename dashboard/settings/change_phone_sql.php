<?php
include('../../includes/connect.php');
require('../../includes/session.php');
$sql = "UPDATE users SET phone_number='" . $_POST['phone_number'] . "', carrier='" . $_POST['carrier'] . "' WHERE username='" . $_SESSION['username'] . "'";
try {
  $conn->query($sql);
  header('Location: ../../dashboard');
  echo "Phone number updated successfully!";
} catch (Exception $e) {
  echo "Error updating phone nummber:" . $e->getMessage();
}
?>
