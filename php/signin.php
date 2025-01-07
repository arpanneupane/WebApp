<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($users as $user) {
        list($storedUsername, $storedName, $storedPassword) = explode(',', $user);
        if ($storedUsername === $username && password_verify($password, $storedPassword)) {
            $_SESSION['username'] = $storedUsername;
            $_SESSION['name'] = $storedName;
            header('Location: profile.html');
            exit;
        }
    }
    header('Location: signin.html?error=invalid');
    exit;
}
?>
