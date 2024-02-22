<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
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
</div>
    <div>
    <form id="login-form">
        <h2>Formulaire de Connexion</h2>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Se Connecter">
    </form>
    <li><a id ="inscription" href="inscription.php">inscription</a></li>
    

</div>
<div id="response"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
