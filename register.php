<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $loginData = [
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'gender' => $_POST['gender'],
    'username' => $_POST['username'],
    'password' => $_POST['password']
  ];

  $errors = [];

  if (empty($loginData['firstname'])) {
    array_push($errors, "Le prénom est obligatoire.");
  } elseif (empty($loginData['username'])) {
    array_push($errors, "Le pseudo est obligatoire.");
  } elseif (empty($loginData['password'])) {
    array_push($errors, "Le mot de passe est obligatoire.");
  }

  // If no errors, proceed with registration
  if (empty($errors)) {
    // Hash the password
    $hashed_password = password_hash($loginData['password'], PASSWORD_DEFAULT);

    // Prepare the insert statement
    $sql = "INSERT INTO users (firstname, lastname, gender, username, password) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $loginData['firstname'],
        $loginData['lastname'],
        $loginData['gender'],
        $loginData['username'],
        $hashed_password
      );

      if (mysqli_stmt_execute($stmt)) {
        echo "Inscription réussie!";
      } else {
        echo "Erreur: " . mysqli_error($conn);
      }

      mysqli_stmt_close($stmt);
    }
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

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "</br>";
    echo "Votre prénom est " . $loginData['firstname'] . "</br>";
    echo "Votre nom est " . $loginData['lastname'] . "</br>";
    echo "Votre genre est " . $loginData['gender'] . "</br>";
    echo "Votre pseudo est " . $loginData['username'] . "</br>";
    echo "Votre mot de passe est " . $loginData['password'] . "</br>";
  }
  ?>

</body>

</html>