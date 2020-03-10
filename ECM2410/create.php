<?php
// Start the session
session_start();
require_once('include.php');
//createPassword('password', 'test@test.com');
function createPassword($password, $username){
  $auth = new Authentication;
  $salt = $auth->generateRandomString(30);
  $hash = $auth->hashPassword($password, $salt);
  $conn = new mysqli('localhost', 'root', 'root', 'game_database');
  $sql = "REPLACE into Users (Username, Password, Salt) VALUES(?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $username, $hash, $salt);
  $stmt->execute();
  echo $salt;
  echo "<br />";
  echo $hash;
}
?>
<h1>created</h1>
