<?php
// Class Coffee Manager
// (c) 2025 Harpogma – Licensed under the MIT License
// See the LICENSE file in the project root for full license text.
session_start();
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginData = [
        'email' => trim($_POST['email']),
        'password' => $_POST['password']
    ];

    $errors = [];

    if (empty($loginData['email'])) {
        $errors[] = "L'adresse email est obligatoire.";
    }

    if (empty($loginData['password'])) {
        $errors[] = "Le mot de passe est obligatoire.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $loginData['email']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($loginData['password'], $user['password'])) {
                // Successful login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: ./dashboard.php");
                exit();
            } else {
                $errors[] = "Mot de passe incorrect.";
            }
        } else {
            $errors[] = "Aucun utilisateur trouvé avec cette adresse email.";
        }
    }

    // Display errors if any
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Café HEIG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="gradient h-screen grid grid-rows-7">

    <?php require './includes/navbar.php'; ?>
    <div class="grid min-h-full px-6 py-12 lg:px-8">
        <div class="flex justify-center row-start-2 row-end-3">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Se connecter</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm row-start-4 row-end-6">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Adresse email</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Mot de passe</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-black-600">Mot de passe oublié ?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="button" class="flex text-white bg-black rounded-4xl text-base px-5 py-1 justify-center">Se connecter</button>
                </div>
            </form>

        </div>
    </div>
    <?php require './includes/footer.php'; ?>

</body>

</html>