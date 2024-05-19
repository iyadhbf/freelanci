<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "Username already taken!";
    } else {
        // Insert new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':role', $role);

        if ($role == 'consulter') {
            header("Location: home.php");
        } else {
            header("Location: requests.php");
        }

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css" />
</head>
<body>
<div class="form-container">
    <form action="register.php" method="post" id="form-container" class="form">
        <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required ><br>
        </div>

        <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        </div>

        <div class="input-group"></div>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="consulter">Consulter</option>
            <option value="RH">RH</option>
        </select><br>

        <input type="submit" value="Register" class="sign">
        </div>
    </form>
</body>
</html>
