<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $loginData = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
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

  // Check if username exists
  if (empty($errors)) {
    $sql = "SELECT * FROM users WHERE username = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $loginData['username']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) > 0) {
        $errors[] = "Le pseudo existe déjà.";
      }

      mysqli_stmt_close($stmt);
    }
  }

  // Check if email exists
  if (empty($errors)) {
    $sql = "SELECT * FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $loginData['email']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) > 0) {
        $errors[] = "L'adresse email existe déjà.";
      }

      mysqli_stmt_close($stmt);
    }
  }

  // Register user if no errors
  if (empty($errors)) {
    $hashed_password = password_hash($loginData['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $loginData['username'],
        $loginData['email'],
        $hashed_password
      );

      if (mysqli_stmt_execute($stmt)) {
        echo "Inscription réussie!";
      } else {
        echo "Erreur: " . mysqli_error($conn);
      }

      mysqli_stmt_close($stmt);
    }
  } else {
    // Display errors
    foreach ($errors as $error) {
      echo $error;
    }
    $errors = [];
  }
}

?>


<!DOCTYPE html>
<html lang="fr" class="h-full bg-white">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/style.css">
  <title>Café HEIG</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="h-full">

  <?php include './includes/navbar.php'; ?>

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
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

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
        </div>
      </form>

    </div>
  </div>

</body>

</html>