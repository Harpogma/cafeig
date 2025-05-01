<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/style.css">
  <title>Café HEIG</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="gradient h-screen grid grid-rows-7">

  <?php require './includes/navbar.php'; ?>

  <div class="flex flex-col items-center justify-center h-80 pt-12 row-start-2 row-end-3">
    <div class="flex flex-col items-center px-6 width-full">
      <h1 class="text-5xl font-medium">Bienvenue sur le site du Café HEIG</h1>
      <div class=" text-gray-600 text-center py-5">
        <p>Ce site est en cours de développement. Il sera mis à jour régulièrement.</p>
        <p>Vous pouvez vous inscrire ou vous connecter pour accéder à toutes les fonctionnalités du site.</p>
        <p>Pour toute question ou suggestion, n'hésitez pas à me contacter.</p>
      </div>

    </div>
  </div>
  <div class="login-buttons-container flex flex-col items-center justify-center mt-6 row-start-4 row-end-6">
    <h2 class="text-2xl">Inscription et connexion</h2>
    <div class="login-buttons flex gap-4 py-4">
      <a href="./register.php">
        <button type="button" class="text-white bg-black rounded-4xl text-base px-5 py-1">S'inscrire</button>
      </a>
      <a href="./login.php">
        <button type="button" class="text-white bg-black rounded-4xl text-base px-5 py-1">Se connecter</button>
      </a>
    </div>
  </div>
  <?php require './includes/footer.php'; ?>
</body>

</html>