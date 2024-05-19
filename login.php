<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Store user data in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on user role
        if ($user['role'] == 'consulter') {
            header("Location: request_form.php");
        } else {
            header("Location:home");
        }
        exit();
    } else {
        echo "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css" />
  </head> 
  <body>
  <div class="form-container">
	<p class="title">Login</p>
	<form class="form" method="post" action="login.php">
		<div class="input-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" placeholder="">
		</div>
		<div class="input-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="">
		</div>
		<input type="submit" class="sign" value="Login">
	</form>
	
	<p class="signup">Don't have an account?
		<a rel="noopener noreferrer" href="register.php" class="">Sign up</a>
	</p>
</div>
  </body>
</html>