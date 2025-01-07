<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../login.html');
  exit();
}

$username = $_SESSION['username'];

$conn = new mysqli('localhost', 'root', '', 'tiktok');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM videos WHERE username='$username'";
$result = $conn->query($sql);

$videos = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $videos[] = $row;
  }
}

$conn->close();
echo json_encode($videos);
?>
