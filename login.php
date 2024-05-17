<?php
require_once 'includes/config.php'; 


session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if (empty($username) || empty($password)) {
        $error = "All fields are required.";
    } else {
        try {
           
            $pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                
                if (password_verify($password, $row['password'])) {
                    
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];

                    
                    header("location: home.php");
                    exit;
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "No account found with that email.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
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
	<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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