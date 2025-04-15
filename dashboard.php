<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
        .navbar {
            width: 200px;
            background-color: #333;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .dashboard {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h3>Menu</h3>
        <a href="#">Option 1</a>
        <a href="#">Option 2</a>
    </div>
    <div class="content">
        <div class="dashboard">
            <h1>Welcome to the Dashboard</h1>
            <p>You are logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </div>
</body>
</html>