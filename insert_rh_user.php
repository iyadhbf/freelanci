<?php
require_once 'config.php';

try {
    // Fixed credentials
    $username = 'RH1';
    $password = password_hash('RH1212', PASSWORD_DEFAULT);
    $role = 'RH';

    // Prepare SQL statement to insert RH user
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");

    // Bind parameters
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    // Execute statement
    $stmt->execute();
    echo "RH user inserted successfully!";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
