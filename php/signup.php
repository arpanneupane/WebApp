<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Store user data
    $userData = "$username,$name,$password\n";
    file_put_contents('users.txt', $userData, FILE_APPEND);

    // Log in the user
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;

    // Create user upload directory
    mkdir("uploads/$username");

    header('Location: profile.html');
    exit;
}
?>
