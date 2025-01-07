<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../login.html');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_SESSION['username'];
  $title = $_POST['video-title'];
  $file = $_FILES['video-file'];

  $uploadDir = '../uploads/';
  $filePath = $uploadDir . basename($file['name']);

  if (move_uploaded_file($file['tmp_name'], $filePath)) {
    $conn = new mysqli('localhost', 'root', '', 'tiktok');
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO videos (username, title, file_path) VALUES ('$username', '$title', '$filePath')";
    if ($conn->query($sql) === TRUE) {
      header('Location: ../profile.html');
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  } else {
    echo "Failed to upload file.";
  }
}
?>
