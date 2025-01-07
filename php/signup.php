<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $name = $_POST['name'];

  $conn = new mysqli('localhost', 'root', '', 'tiktok');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO users (username, password, name) VALUES ('$username', '$password', '$name')";
  if ($conn->query($sql) === TRUE) {
    session_start();
    $_SESSION['username'] = $username;
    header('Location: ../profile.html');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
