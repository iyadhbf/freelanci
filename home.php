<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Request Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image:url(proj/img/background.jpg);
            background-size: cover;
            background-position: center;
           
        }
        .navbar {
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1;
            height: 70px;
        }
        .navbar a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 20px 16px;
            text-decoration: none;
            font-size: 17px;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        
        h1 {
            margin-bottom: 20px;
        }
        a.button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        a.button:hover {
            background-color: #45a049;
        }
        .home{
            float: left;
            margin-right: 80px;
            padding-top: 20px;
            
           
        }
    </style>
</head>
<body >  
        <a href="home.php" class="home">Home</a>
        <div class="navbar">
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['role'] == 'consulter'): ?>
                <a href="request_form.php">Submit a Request</a>
            <?php elseif ($_SESSION['role'] == 'RH'): ?>
                <a href="dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
    
</body>
</html>
