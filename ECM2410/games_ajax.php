<?php
session_start();
require_once('include.php');
$auth = new Authentication;
if ($auth->isLoggedOn() == false) {
  exit();
}
//Establish connection to the database
$dbhandle = mysqli_connect('localhost', 'root', 'root', 'game_database')
or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
$sql = "SELECT * FROM Games";
$result = $dbhandle->query($sql);
$return_arr = array();


if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $row_array['ID'] = $row['ID'];
    $row_array['Title'] = $row['Title'];
    $row_array['Publisher'] = $row['Publisher'];
    $row_array['Stock'] = $row['Stock'];
    $row_array['Price'] = $row['Price'];

    array_push($return_arr,$row_array);
  }
}
echo json_encode($return_arr);
?>
