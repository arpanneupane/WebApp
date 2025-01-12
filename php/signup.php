<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $query = "INSERT INTO users (username, name, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$username, $name, $password]);

        echo "Signup successful!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry
            echo "Username already exists!";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
