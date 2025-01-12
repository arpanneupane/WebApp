<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    try {
        $sql = "INSERT INTO users (username, name, password) VALUES (:username, :name, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            echo "User created successfully!";
        } else {
            echo "Failed to create user.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
