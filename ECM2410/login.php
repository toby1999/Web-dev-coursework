<?php
// Start the session
session_start();
require_once('include.php');
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  //Establish connection to the database
  $conn = new mysqli('localhost', 'root', 'root', 'game_database');
  $sql = "SELECT Username, Password, Salt FROM Users WHERE Username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);

  // This assumes the date and account_id parameters are integers `d` and the rest are strings `s`
  // So that's 5 consecutive string params and then 4 integer params
  $stmt->execute();

  $result = $stmt->get_result();
  if($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stored_password = $row['Password'];
    $stored_salt = $row['Salt'];

    $stmt->close();
    $conn->close();
    if (validate_password($username, $password, $stored_salt, $stored_password)) {
      header('Location: games.php');
      exit();
    }
  }

  $message = "incorrect username or password";
}
function validate_password($username, $password, $stored_salt, $stored_password) {
  $auth = new Authentication;
  if ($auth->isPasswordOk($password, $stored_salt, $stored_password)) {
    //sessions
    $_SESSION["username"] = $username;
    return true;
  }
  return false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="login.css" rel="stylesheet" type="text/css"/>
</head>
<body>
  <div id="container">
    <div id="form">

      <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <br /><input id="username" name="username" oninvalid="this.setCustomValidity('Enter username')" oninput="setCustomValidity('')" required="" >
        <br /><label for="password">Password:</label>
        <br /><input id="password" name="password" oninvalid="this.setCustomValidity('Enter password')" oninput="setCustomValidity('')" required="" type="password">
        <?php
        if ($message != "") {
          echo '<p class="message">' . $message . '</p>';
        }
        ?>
        <br /><input class="button" type="submit" value="Login">
      </form>
    </div>
  </div>
</body>
</html>
