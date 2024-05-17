<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: green;
            padding: 10px 20px;
        }
        #logo img {
            height: 50px;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }
        nav ul li {
            margin: 0 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        nav ul li span {
            color: white;
            padding: 8px 15px;
        }
    </style>
</head>
<body>

<header>
    <a id="logo" href="index.php">
        <img src="img/freelance.png" alt="Logo" />
    </a>
    <?php
    if(isset($_SESSION["username"])){
        $navbar='<nav>
            <ul>
                <li><a href="">Our Institute</a></li>
                <li><a href="">Student Life</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><span>' . $_SESSION["username"] . '</span></li>
            </ul>
        </nav>';
    } else {
        $navbar='<nav>
            <ul>
                <li><a href="presentation.php">Our Institute</a></li>
                <li><a href="studentlife.php">Student Life</a></li>
                <li><a href="forum1.php">Forum</a></li>
                <li><a href="login.php">Sign in</a></li>
            </ul>
        </nav>';
    }
    echo $navbar;
    ?>
</header>

</body>
</html>
