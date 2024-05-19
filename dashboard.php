<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// You can also check for specific roles
if ($_SESSION['role'] != 'RH') {
    echo "Access denied!";
    exit();
}

// The rest of your protected page code
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
