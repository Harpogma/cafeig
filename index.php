<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <!--<link rel="stylesheet" href="./css/style.css"> -->
  <title>Café HEIG</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

  <?php include './includes/navbar.php'; ?>

  <div class="container flex flex-col px-6 py-12 lg:px-8">
    <h1 class="text-3xl font-bold underline">Bienvenue sur le site du Café HEIG</h1>
    <p>Ce site est en cours de développement. Il sera mis à jour régulièrement.</p>
    <p>Vous pouvez vous inscrire ou vous connecter pour accéder à toutes les fonctionnalités du site.</p>
    <p>Pour toute question ou suggestion, n'hésitez pas à me contacter.</p>
  </div>

  <div class="login-buttons-container flex flex-col items-center justify-center mt-10">
    <h2>Inscription et connexion</h2>
    <div class="login-buttons flex gap-4">
      <a href=" ./register.php">
        <button type="button" class="text-white bg-blue-700 rounded-lg font-medium px-5 py-2.5">S'inscrire</button>
      </a>
      <a href="./login.php">
        <button type="button" class="text-white bg-blue-700 rounded-lg font-medium px-5 py-2.5">Se connecter</button>
      </a>
    </div>
  </div>
</body>

</html>