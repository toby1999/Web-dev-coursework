<?php
// Start the session
session_start();
require_once('include.php');
$auth = new Authentication;
if ($auth->isLoggedOn() == false) {
  echo "fail"; // The user isn't logged on so refuse the request
  exit();
}

$id = $_POST['id'];
$stock = $_POST['stock'];
if (is_numeric($id) && is_numeric($stock)) {
  //Establish connection to the database
  $conn = new mysqli('localhost', 'root', 'root', 'game_database');
  $sql = "UPDATE Games SET Stock=? WHERE ID=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $stock, $id);
  $stmt->execute();
  $stmt->close();
  $conn->close();

  echo "ok"; // Update succeded
} else {
  echo "fail";
}


?>
