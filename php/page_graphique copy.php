<?php
$host = "db";
$user = "root";
$password = "password";
$database = "prix_nobel";
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}


// Exécutez la requête SQL pour récupérer le nombre de prix Nobel pour chaque catégorie
$queryCatCount = "SELECT c.Nom_catgorie, COUNT(p.id_category) as nbPrixNobel
                 FROM categorie c
                 LEFT JOIN prix_nobel p ON c.Id_catgorie = p.id_category
                 GROUP BY c.Nom_catgorie";

$resultCatCount = $mysqli->query($queryCatCount);
$catCountData = array();

while ($row = $resultCatCount->fetch_assoc()) {
    $catCountData[] = $row;
}

// Convertissez le tableau associatif pour les données de catégorie en format JSON
$jsonCatCountData = json_encode($catCountData);

// Exécutez la requête SQL pour récupérer les données de la table categorie
$queryCat = "SELECT Nom_catgorie FROM categorie";
$resultCat = $mysqli->query($queryCat);
$catData = array();
while ($row = $resultCat->fetch_assoc()) {
    $catData[] = $row;
}

// Convertissez le tableau associatif pour les données de catégorie en format JSON
$jsonCatData = json_encode($catData);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Graphique</title>
    <script type="text/javascript" src="../jquery-3.7.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=1.1" type="text/css" media="screen" />
</head>
<body>
    <!-- LE HEADER -->
    <div id="entete">
        <h1>PRIX NOBEL</h1>

        <ol class="menu" id="menu">
            <li><a id="accueil" href="accueil.html">Accueil</a></li>
            <li><a id="recherche" href="recherche.php">Recherche</a></li>
            <li><a id="graphique" href="graphique.html">Graphique</a></li>
            <li><a id="connexion" href="connexion.html">Connexion</a></li>
        </ol>
    </div>

    <div class="boite">
        <div class="topBar">
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Type de graphe
               </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="changerTypeGraphe('bar')">Barre</a>
                    <a class="dropdown-item" href="#" onclick="changerTypeGraphe('doughnut')">Circulaire</a>
                    <a class="dropdown-item" href="#" onclick="changerTypeGraphe('polarArea')">Histogramme</a>
                    <a class="dropdown-item" href="#" onclick="changerTypeGraphe('line')">Courbe</a>
                    <a class="dropdown-item" href="#" onclick="changerTypeGraphe('bubble')">Nuage de points</a>
                    <a class="dropdown-item" href="#" onclick="changerTypeGraphe('box-plot')">Box-plot</a>
                </div>
            </div>
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Sexe
               </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Masculin</a>
                    <a class="dropdown-item" href="#">Feminin</a>
                </div>
            </div>
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Nombre de prix nobel
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">0-50</a>
                    <a class="dropdown-item" href="#">50-100</a>
                    <a class="dropdown-item" href="#">100-150</a>
                    <a class="dropdown-item" href="#">150-200</a>
                    <a class="dropdown-item" href="#">200-250</a>

                </div>
            </div>
        </div>
        <div class="contenu">
            <ul>
                <div>
                    <p class="selected-graphe">Le graphe sélectionné</p>
                    <canvas id="graphs"></canvas>
                </div>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        var ctx = document.getElementById('graphs').getContext('2d');

        // Utilisation des données
        var jsonData = <?php echo $jsonCatCountData; ?>;
        var jsonCatData = <?php echo $jsonCatData; ?>;
        console.log(jsonCatData.map(item => item.Nom_catgorie));

        var labels = jsonCatData.map(item => item.Nom_catgorie);
        var colors = labels.map(getRandomColor);


                console.log(jsonData)

        var config = {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de prix nobels par catégorie',
                    data:jsonData.map(item => item.nbPrixNobel),
                    backgroundColor: colors
                }]
            },
            options: {
                // Configurations d'options
            }
        };

        var myChart = new Chart(ctx, config);

        // Fonction pour changer le type de graphe
        function changerTypeGraphe(type) {
            config.type = type;
            myChart.destroy(); // Détruire l'ancien graphique
            myChart = new Chart(ctx, config); // Recréer le graphique avec le nouveau type
        }

        // Fonction pour générer une couleur aléatoire
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
</body>
</html>
