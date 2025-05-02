<?php
// Class Coffee Manager
// (c) 2025 Harpogma – Licensed under the MIT License
// See the LICENSE file in the project root for full license text.
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="gradient grid h-screen">
    <?php require './includes/navbar.php'; ?>

    <div class="grid grid-cols-6 py-6">
        <div class="sidebar grid col-span-1 justify-center bg-blue-200 h-full">
            <a href="#">Mes cafés</a>
            <a href="#">Paramètres</a>
        </div>
        <div class="content grid col-span-5 justify-center">
            <div class="dashboard">
                <h1>Welcome to your Dashboard</h1>
                <p>You are logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
        </div>
    </div>
    <?php require './includes/footer.php'; ?>

</body>

</html>