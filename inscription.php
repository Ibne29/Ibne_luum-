<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="entete">
<h1>PRIX NOBEL</h1>

<ol class="menu" id="menu">

        <li><a id = "accueil" href="index.php">Accueil</a></li>
        <li><a id = "recherche" href="recherche.php">Recherche</a></li>
        <li><a id = "graphique" href="graphique.php">Graphique</a></li>
        <li><a id = "connexion" href="connexion.php">Connexion</a></li>

</ol>
    <form action="traitement_inscription.php" method="post">
        <h2>Formulaire d'Inscription</h2>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="username">Pseudo :</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
