<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $conn = new mysqli('localhost', 'root', '', 'tiktok');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      header('Location: ../profile.html');
    } else {
      echo "Incorrect password.";
    }
  } else {
    echo "No user found.";
  }
  $conn->close();
}
?>
