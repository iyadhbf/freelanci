<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'consulter') {
    header("Location: login.php");
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "Root";
$password = "";
$dbname = "freelanci";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to insert request details
        $stmt = $conn->prepare("INSERT INTO requests (user_id, nom, prenom, cin, date_naissance, lieu_naissance, adresse, status) VALUES (:user_id, :nom, :prenom, :cin, :date_naissance, :lieu_naissance, :adresse, 'Pending')");
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':prenom', $_POST['prenom']);
        $stmt->bindParam(':cin', $_POST['cin']);
        $stmt->bindParam(':date_naissance', $_POST['date_naissance']);
        $stmt->bindParam(':lieu_naissance', $_POST['lieu_naissance']);
        $stmt->bindParam(':adresse', $_POST['adresse']);
        $stmt->execute();

        echo "Request submitted successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Request Form</h2>
        <form action="request_form.php" method="post">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="cin">CIN:</label>
            <input type="text" id="cin" name="cin" required>

            <label for="date_naissance">Date de naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" required>

            <label for="lieu_naissance">Lieu de naissance:</label>
            <input type="text" id="lieu_naissance" name="lieu_naissance" required>

            <label for="adresse">Adresse:</label>
            <textarea id="adresse" name="adresse" rows="3" required></textarea>

            <input type="submit" value="Submit Request">
        </form>
    </div>
</body>
</html>
