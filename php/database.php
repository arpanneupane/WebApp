<?php
$serverName = "your-database-server-name.database.windows.net";
$database = "your-database-name";
$username = "your-database-username";
$password = "your-database-password";

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
?>
