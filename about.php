<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Café HEIG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="gradient h-screen grid">

    <?php require './includes/navbar.php'; ?>

    <div class="about-me-container">
        <div class="about-profile-picture">
            <img src="./images/IMG_8326.jpeg" alt="Portrait du créateur du site">
        </div>
        <div class="about-me">
            <h2>À propos de moi</h2>
            <p>Je suis étudiant en Bachelor en Ingénierie des médias à la HEIG-VD.</p>
            <p>Ce site est et sera développé dans le cadre d'un projet en lien avec le cours ProgServ1.</p>
            <p>Je suis persuadé que c'est en faisant des projets concrets que l'on apprend de nouvelles choses, surtout dans un domaine comme le développement.</p>
        </div>
    </div>

    <div class="about-project-container">
        <div class="about-project">
            <h2>À propos du projet</h2>
            <p>Ce site a pour but de permettre aux étudiants de la M53-1 de gérer leur consommation de café en cours.</p>
            <p>Il est encore en cours de développement et sera mis à jour régulièrement.</p>
            <p>Je suis ouvert à toutes les suggestions et remarques.</p>
        </div>
        <div class="about-project-picture">
            <img src="./images/AdobeStock_159183621.jpeg" alt="Image du projet">
        </div>
    </div>
    <?php require './includes/footer.php'; ?>

</body>

</html>