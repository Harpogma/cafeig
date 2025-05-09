<?php
// Class Coffee Manager
// (c) 2025 Harpogma – Licensed under the MIT License
// See the LICENSE file in the project root for full license text.
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $loginData = [
    'username' => trim($_POST['username']),
    'email' => trim($_POST['email']),
    'password' => $_POST['password']
  ];

  $errors = [];

  // Validate input
  if (empty($loginData['username'])) {
    $errors[] = "Le pseudo est obligatoire.";
  }

  if (empty($loginData['email'])) {
    $errors[] = "Une adresse email est obligatoire.";
  }

  if (empty($loginData['password'])) {
    $errors[] = "Le mot de passe est obligatoire.";
  }

  // Check if username or email exist
  if (empty($errors)) {
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE username = :username OR email = :email");
    $stmt->execute([
      ':username' => $loginData['username'],
      ':email' => $loginData['email']
    ]);

    if ($stmt->fetch()) {
      $errors[] = "Le pseudo ou l'adresse email existe déjà.";
    }
  }

  // Register user if no errors
  if (empty($errors)) {
    $hashedPassword = password_hash($loginData['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $success = $stmt->execute([
      ':username' => $loginData['username'],
      ':email' => $loginData['email'],
      ':password' => $hashedPassword
    ]);

    if ($success) {
      echo "Inscription réussie!";
    } else {
      echo "Erreur lors de l'inscription.";
    }
  } else {
    // Display errors
    foreach ($errors as $error) {
      echo "<p style='color: red;'>$error</p>";
    }
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

  <?php require '../includes/navbar.php'; ?>

  <div class="grid min-h-full px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Créer un compte</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="#" method="POST">
        <div>
          <label for="username" class="block text-sm/6 font-medium text-gray-900">Pseudo</label>
          <div class="mt-2">
            <input type="username" name="username" id="username" autocomplete="username" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Adresse email</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Mot de passe</label>

          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div class="flex justify-center">
          <button type="button" class="flex text-white bg-black rounded-4xl text-base px-5 py-1 justify-center">S'inscrire</button>
        </div>
      </form>

    </div>
  </div>
  <?php require '../includes/footer.php'; ?>

</body>

</html>