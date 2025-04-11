<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginData = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'gender' => $_POST['gender'],
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ];
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Café HEIG</title>

</head>

<body>

    <nav class="nav">
        <div class="logo">Café HEIG</div>
        <div class="menu" id="menu">
            <a href="./index.html">Home</a>
            <a href="./register.php">Sign in</a>
            <a href="./login.php">Sign up</a>
        </div>
        <div class="toggle" id="toggle">☰</div>
    </nav>
    <h1>Page de connexion</h1>


    <form action="./login.php" method="POST">

        <label for="firstname">Prénom :</label><br />
        <input type="text" id="firstname[]" name="firstname" required />
        </br>

        <label for="lastname">Nom :</label><br />
        <input type="text" id="lastname[]" name="lastname" />
        </br>

        <label for="gender">Genre :</label>
        </br>
        <select name="gender">
            <option value="">Veuillez sélectionner…</option>
            <option value="female">Femme</option>
            <option value="male">Homme</option>
            <option value="non-binary">Non binaire</option>
            <option value="other">Autre</option>
            <option value="Prefer not to answer">Ne préfère pas répondre</option>
        </select>
        </br>

        <label for="username">Pseudo :</label><br />
        <input type="text" id="username" name="username" required />
        </br>

        <label for="password">Mot de passe :</label><br />
        <input type="password" id="password" name="password" required />
        <br />

        <button type="submit">Envoyer</button>
        <button type="reset">Réinitialiser</button>
    </form>

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